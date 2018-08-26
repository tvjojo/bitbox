<?php
/**
 *   ============================================================================
 *  Copyright (c) 2017. 本软件系统由北天团队与投缘互联团队共同开发，对于非商业用途
 *  的代码使用完全免费，而对商业用户经过我方授权后也可免费使用，但所有用户不得任意破坏
 *  我们设计的产品结构，也不得使用该软件做为非法用途.如果商业用户希望获得一些平台型的支
 *  持，以及获得我方各类接口的支持，也可联系我方购买更丰富的支持.
 *   ============================================================================
 */

/**   // 主要用于针对于MOD的数据库支持， 未来独立个体APP之间也可以独立于此之外使用其它SQL支持。需要BitMod的支持
 * User: Huangbt
 * Date: 2017/10/16 0016
 * Time: 上午 11:34
 */

echo "BASEMODBASEMODBASEMODBASEMODBASEMODBASEMODBASEMOD 底层BASEMOD</br>";

class BaseMod extends Mod {

    public $model = NULL;
    protected $db = NULL;
    protected $pre = NULL;
    protected $table = "";
    protected $ignoreTablePrefix = false;



    public function __construct($database = 'DB', $force = false) {
        $this->model = self::connect(C($database), $force);
       $this->db = $this->model->db;
         $this->pre = $this->model->pre;
    }

    static public function connect($config, $force = false) {
        static $model = NULL;
        if ($force == true || empty($model)) {

            $model = new BitMod($config);
        }
        return $model;
    }



    public function query($sql) {
         return $this->model->query($sql);
    }

    public function row($sql) {
        $data = $this->query($sql);
        return isset($data[0]) ? $data[0] : false;
    }

    public function gecol($condition = '', $field = '', $order = '') {
        return $this->model->table($this->table, $this->ignoreTablePrefix)->field($field)->where($condition)->order($order)->getCol();
    }

    public function find($condition = '', $field = '', $order = '') {
        return $this->model->table($this->table, $this->ignoreTablePrefix)->field($field)->where($condition)->order($order)->find();
    }

    public function field($field = '', $condition = '', $order = '') {
        $result = $this->model->table($this->table, $this->ignoreTablePrefix)->field($field)->where($condition)->order($order)->find();
        return $result[$field];
    }

    public function select($condition = '', $field = '', $order = '', $limit = '') {
        return $this->model->table($this->table, $this->ignoreTablePrefix)->field($field)->where($condition)->order($order)->limit($limit)->select();
    }

    public function count($condition = '') {
        return $this->model->table($this->table, $this->ignoreTablePrefix)->where($condition)->count();
    }

    public function insert($data = array()) {
        return $this->model->table($this->table, $this->ignoreTablePrefix)->data($data)->insert();
    }

    public function update($condition, $data = array()) {
        return $this->model->table($this->table, $this->ignoreTablePrefix)->data($data)->where($condition)->update();
    }

    public function delete($condition) {
        return $this->model->table($this->table, $this->ignoreTablePrefix)->where($condition)->delete();
    }

    public function getFields() {
        return $this->model->table($this->table, $this->ignoreTablePrefix)->getFields();
    }

    public function getSql() {
        return $this->model->getSql();
    }

    public function escape($value) {
        return $this->model->escape($value);
    }

    public function cache($time = 0) {
        $this->model->cache($time);
        return $this;
    }

}
