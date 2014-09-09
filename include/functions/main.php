<?
function v_dump($ar)
{
    echo '<pre>';
    var_dump($ar);
    echo '</pre>';    
}
function getFunctionsMessage($str) {
    include_once($_SERVER['DOCUMENT_ROOT'].SITE_LANG_PATH.'functions.php');
    return $lang[$str];
}
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/database.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/users.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/accounts.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/orders.php');

$res = userLogin("admin","12345",true);
v_dump($res);
?>
