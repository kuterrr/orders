<?
define("SITE_TEMPLATE","main");
define("SITE_TEMPLATE_PATH","/templates/".SITE_TEMPLATE."/");
define("SITE_LANG","ru");
define("SITE_LANG_PATH","/include/lang/".SITE_LANG."/");

/*
 * Массив с параметрами подлючения к БД
 */
$db_conn = Array();
$db_conn[0] = Array(
    'host' => 'localhost:31006',
    'user' => 'root',
    'pass' => '',
    'dbname' => 'orders',
    'handler' => null    
);
$db_conn[1] = Array(
    'host' => 'localhost:31006',
    'user' => 'root',
    'pass' => '',
    'dbname' => 'orders2',
    'handler' => null
);
/*
 * Для каждой из БД перечислим таблицы, ключ соответствует ключу параметров подключения
 */
$db_tables = Array();
$db_tables[0] = "accounts,orders";
$db_tables[1] = "users";
?>