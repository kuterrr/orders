<?require($_SERVER["DOCUMENT_ROOT"]."/include/header.php");
if ($_REQUEST["action"]=="auth"&&check_sessid())
{    
    if (userLogin($_REQUEST["login"], $_REQUEST["pass"]))
    {        
        LocalRedirect('/auth.php');
    }
    else 
    {
        echo "Неверный логин/пароль";
    }
}
?>
<h1>Авторизация</h1>
<form class="auth_form" action="" method="post">
    <input type="hidden" name="sessid" value="<?=$_COOKIE["PHPSESSID"]?>" />    
    <input type="hidden" name="action" value="auth" />    
    <input type="text" name="login" class="input" placeholder="Логин"/>
    <input type="password" name="pass" class="input" placeholder="Пароль"/>
    <input type="checkbox" id="cookie" name="cookie" value="true" />
    <label for="cookie">Запомнить меня</label><br />
    <input type="submit" class="btn btn-primary" value="Войти">                                            
</form>  
<?require($_SERVER["DOCUMENT_ROOT"]."/include/footer.php");?>