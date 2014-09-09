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
function getCurPage() {
    return $_SERVER["SCRIPT_NAME"];
}
function check_sessid($sess_id) {
    if (session_id() == $sess_id)
        return true;
    return false;
}
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/database.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/users.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/accounts.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/orders.php');

if (!isLogin() && getCurPage() != '/auth.php')
    header('Location: /auth.php');
?>
