<?
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/main.php');
session_start();
userCookieAuth();
if ($_REQUEST["logout"]=="yes")
    userLogout();
if (!isLogin() && getCurPage() != '/auth.php')
    LocalRedirect('/auth.php');
?>