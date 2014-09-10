<?
function v_dump($ar)
{
    echo '<pre>';
    var_dump($ar);
    echo '</pre>';    
}
function getFunctionsMessage($str) 
{
    global $lang_func;
    return $lang_func[$str];
}
function getMessage($str) 
{
    global $lang;
    return $lang[$str];
}
function getCurPage() 
{
    return $_SERVER["SCRIPT_NAME"];
}
function LocalRedirect($url)
{
	header('Location: http://'.$_SERVER['HTTP_HOST'].$url);
}
function check_sessid() 
{
    if (session_id() == $_COOKIE["PHPSESSID"])
        return true;
    return false;
}
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].SITE_LANG_PATH.'functions.php');
include_once($_SERVER['DOCUMENT_ROOT'].SITE_LANG_PATH.'template.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/database.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/users.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/accounts.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/orders.php');
?>