<?php
/**
 *   ============================================================================
 *  Copyright (c) 2017. ������ϵͳ�ɱ����Ŷ���������Ŷӹ�ͬ���������ڷ���ҵ��;
 *  �Ĵ���ʹ����ȫ��ѣ�������ҵ�û������ҷ���Ȩ��Ҳ�����ʹ�ã��������û����������ƻ�
 *  ������ƵĲ�Ʒ�ṹ��Ҳ����ʹ�ø�������Ϊ�Ƿ���;.�����ҵ�û�ϣ�����һЩƽ̨�͵�֧
 *  �֣��Լ�����ҷ�����ӿڵ�֧�֣�Ҳ����ϵ�ҷ�������ḻ��֧��.
 *   ============================================================================
 */

/**
 * User: Huangbt
 * Date: 2017/9/25 0025
 * Time: ���� 0:22
 */
define('IN_BOX', true);
define('BOXID', 1);
define('INIT_NO_SMARTY', true);

//define('BIND_MODULE', 'index');
//define('APP_NAME', 'pc');
require './includes/init.php';

//$smarty->assign('page_title','');
$smarty->display('index.html', $cache_id);