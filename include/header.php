<?
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/main.php');
session_start();
ob_start();
userCookieAuth();
if ($_REQUEST["logout"]=="yes")
    userLogout();
if (!isLogin() && getCurPage() != '/auth.php')
    LocalRedirect('/auth.php');
elseif (isLogin() && getCurPage() == '/auth.php')
{
    $group = userGetGroup();
    if ($group == 2 || $group == 1)
        LocalRedirect('/index.php');
    else
        LocalRedirect('/orders.php');
}
include_once($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'header.php');
?>