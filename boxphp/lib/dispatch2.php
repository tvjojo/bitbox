<?php
/**
 *   ============================================================================
 *  Copyright (c) 2017. 本软件系统由北天团队与投缘互联共同开发，对于非商业用途
 *  的代码使用完全免费，而对商业用户经过我方授权后也可免费使用，但所有用户不得任意破坏
 *  我们设计的产品结构，也不得使用该软件做为非法用途.如果商业用户希望获得一些平台型的支
 *  持，以及获得我方各类接口的支持，也可联系我方购买更丰富的支持.
 *  ** http://bitbox.5viv.com    EMAIL:tvjojo@5viv.com   QQ群：229487894
 *   ============================================================================
 */

/**
 * Created by PhpStorm.
 * User: tvjojo
 * Date: 2017-08-11
 * Time: 19:59
 */

# @author noodlehaus
# @license MIT

# returns by ref the route stack singleton
class dispatch2 {
function &context() {
    static $context = [];
    return $context;
}

# dispatch sapi request against routes context
function dispatch(...$args) {

    $verb = strtoupper($_SERVER['REQUEST_METHOD']);
    $path = '/'.trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

    # post method override
    if ($verb === 'POST') {
        if (isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])) {
            $verb = strtoupper($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']);
        } else {
            $verb = isset($_POST['_method']) ? strtoupper($_POST['_method']) : $verb;
        }
    }

    $responder = serve(context(), $verb, $path, ...$args);
    $responder();
}

# creates an action and puts it into the routes stack
function route($verb, $path, callable $func) {
    $context = &context();
    array_push($context, action($verb, $path, $func));
}

# creates a route handler
function action($verb, $path, callable $func) {
    return function ($rverb, $rpath) use ($verb, $path, $func) {
        $rexp = preg_replace('@:(\w+)@', '(?<\1>[^/]+)', $path);
        if (
            strtoupper($rverb) !== strtoupper($verb) ||
            !preg_match("@^{$rexp}$@", $rpath, $caps)
        ) {
            return [];
        }
        return [$func, array_slice($caps, 1)];
    };
}

# performs a lookup against actions for verb + path
function match(array $actions, $verb, $path) {

    $cverb = strtoupper(trim($verb));
    $cpath = '/'.trim(rawurldecode(parse_url($path, PHP_URL_PATH)), '/');

    # test verb + path against route handlers
    foreach ($actions as $test) {
        $match = $test($cverb, $cpath);
        if (!empty($match)) {
            return $match;
        }
    }

    return [];
}

# creates standard response
function response($body, $code = 200, array $headers = []) {
    return function () use ($body, $code, $headers) {
        render($body, $code, $headers);
    };
}

# creates redirect response
function redirect($location, $code = 302) {
    return function () use ($location, $code) {
        render('', $code, ['location' => $location]);
    };
}

# dispatches method + path against route stack
function serve(array $actions, $verb, $path, ...$args) {
    $pair = match($actions, $verb, $path);
    $func = array_shift($pair) ?: function () { return response('', 404, []); };
    $caps = array_shift($pair) ?: null;
    return empty($caps) ? $func(...$args) : $func($caps, ...$args);
}

# renders request response to the output buffer (ref: zend-diactoros)
function render($body, $code = 200, $headers = []) {
    http_response_code($code);
    array_walk($headers, function ($value, $key) {
        if (! preg_match('/^[a-zA-Z0-9\'`#$%&*+.^_|~!-]+$/', $key)) {
            throw new InvalidArgumentException("Invalid header name - {$key}");
        }
        $values = is_array($value) ? $value : [$value];
        foreach ($values as $val) {
            if (
                preg_match("#(?:(?:(?<!\r)\n)|(?:\r(?!\n))|(?:\r\n(?![ \t])))#", $val) ||
                preg_match('/[^\x09\x0a\x0d\x20-\x7E\x80-\xFE]/', $val)
            ) {
                throw new InvalidArgumentException("Invalid header value - {$val}");
            }
        }
        header($key.': '.implode(',', $values));
    });
    print $body;
}

# creates an page-rendering action
function page($path, array $vars = []) {
    return function () use ($path, $vars) {
        return response(phtml($path, $vars));
    };
}

# renders and returns the content of a template
function phtml($path, array $vars = []) {
    ob_start();
    extract($vars, EXTR_SKIP);
    require "{$path}.phtml";
    return trim(ob_get_clean());
}
}