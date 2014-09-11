<?require($_SERVER["DOCUMENT_ROOT"]."/include/header.php");
if ($_REQUEST["action"]=="auth"&&check_sessid())
{    
    if (userLogin($_REQUEST["login"], $_REQUEST["pass"]))
    {        
        LocalRedirect('/auth.php');
    }
    else 
    {
        echo getMessage("WRONG_PASS");
    }
}
?>
<h1><?=getMessage("AUTHORIZATION")?></h1>
<form class="auth_form" action="" method="post">       
    <input type="hidden" name="action" value="auth" />    
    <input type="text" name="login" class="input" placeholder="Логин"/>
    <input type="password" name="pass" class="input" placeholder="Пароль"/>
    <input type="checkbox" id="cookie" name="cookie" value="true" />
    <label for="cookie"><?=getMessage("REMEMBER_ME")?></label><br />
    <input type="submit" class="btn btn-primary" value="Войти">                                            
    <a href='/ajax/register.php' class="btn right" data-toggle="modal" data-target="#modal"><?=getMessage("REGISTRATION")?></a>   
</form>  
<?require($_SERVER["DOCUMENT_ROOT"]."/include/footer.php");?>