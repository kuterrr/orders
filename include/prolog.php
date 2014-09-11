<?
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/main.php');
session_start();
userCookieAuth();
if ($_REQUEST["logout"]=="yes")
    userLogout();
?>