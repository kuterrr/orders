<?
/**
 * Получает id пользователя по его логину
 *
 * @param str $login
 * @return int
 */
function userGetIdByLogin($login)
{
    return db_query_get_value('SELECT id FROM users WHERE login = $', 'users', $login);
}
/**
 * Получаем информацию о пользователе по его id (по умолчанию пользователь под которым осуществлен вход)
 *
 * @param int $id
 * @return array
 */
function userGetFullName($id = null)
{
    if($id === null)
    {
        $id = userGetId();
    }    
    return db_query_one_line('SELECT CONCAT(name," ",lastname) FROM users WHERE id=$', 'users', (int)$id);
    return false;
}
/**
 * Получаем группу пользователя
 *
 * @param int $UsId
 * @return int
 */
function userGetGroup($id = null)
{
    if($id === null)
    {
        $id = userGetId();
    }       
    return db_query_get_value('SELECT group_id FROM users WHERE id=$', 'users', $id);        
    return false;
}
/**
 * Проверка, залогинен ли пользователь
 *
 * @return bool
 */
function isLogin()
{
    if(isset($_SESSION['UsrId']) && $_SESSION['UsrId']>0)    
        return true;    
    return false;
}
/**
 * Возвращаем id текущего пользователя
 *
 * @return int
 */
function userGetId()
{
    if(isset($_SESSION['UsrId']) && $_SESSION['UsrId']>0)    
        return $_SESSION['UsrId'];    
    return false;
}
/**
 * Проверяем пароль для пользователя с логином $login
 *
 * @param int $login
 * @param str $pass
 * @return bool
 */
function userCheckPassByLogin($login, $pass)
{
    if(strrpos($login,'%')!==false)    
        return false;  
    
    if(db_query_get_value('SELECT if(pass = $, 1 , 0 ) FROM users WHERE login = $',  'users', array(md5($pass),$login)))    
        return true;    
    return false;
}		
/**
 * Залогиниваем пользователя если пароль введен верно
 *
 * @param str $login
 * @param str $pass
 * @param bool $cookie
 * @return bool
 */
function userLogin($login, $pass, $cookie = false)
{
    if(userCheckPassByLogin($login, $pass))
    {
        if($cookie)
        {
            $_SESSION['UsrId'] = userGetIdByLogin($login);
            $str = sha1(md5($login).md5($pass).rand(0,1000000));
            setcookie('AuthCode', $str, time()+60*60*24*30);
            setcookie('AuthUser', $_SESSION['UsrId'], time()+60*60*24*30);
            db_query('UPDATE users SET cookie=$ WHERE login = $', 'users', array($str, $login));
        }
        else
        {
            userClearCookie();
            $_SESSION['UsrId'] = userGetIdByLogin($login);
        }        
        return true;
    }
    return false;
}
/**
 * Залогиниваем пользователя из cookies
 *
 * @return bool
 */
function userCookieAuth()
{
    if(isset($_COOKIE['AuthUser']) && isset($_COOKIE['AuthCode']))
    {
        $user = db_query_get_value('SELECT id FROM users WHERE id = $ AND cookie= $', 'users', array($_COOKIE['AuthUser'], $_COOKIE['AuthCode']));
        if($user)
        {
            $_SESSION['UsrId']=$user;
            return true;
        }
    }
    return false;
}
/**
 * Очищаем куки для автологина
 *
 */
function userClearCookie()
{
    setcookie ("AuthUser", "", time() - 3600);
    setcookie ("AuthCode", "", time() - 3600);
}
function userLogout()
{
    unset($_SESSION['UsrId']);
    userClearCookie();
}	
/**
 * Добавляем нового пользователя
 *
 * @param логин $login
 * @param пароль $pass
 * @param повтор пароля $pass2	 
 * @param е-мейл $mail
 * @param группа(по умолчанию юзер) $group_id
 * 
 * @return Массив ошибок или true при успешном добавлении
 */
function userAdd ($login, $pass, $pass2, $name, $group_id = 2)
{
    $return=array();
    if(userGetIdByLogin($login)){
        $return[] = getFunctionsMessage('EX_LOGIN');
    }
    if(!ereg('^([a-zA-Z0-9_-]{3,})$',$login))
    {
        $return[] = getFunctionsMessage('WRONG_LOGIN');
    }
    if(strlen($pass)<3)
    {
        $return[] = getFunctionsMessage('WRONG_PASS');
    }
    if($pass != $pass2)
    {
        $return[] = getFunctionsMessage('WRONG_2PASS');
    }
    if(htmlspecialchars($name)!=$name || $name=='')
    {
        $return[] = getFunctionsMessage('WRONG_NAME');
    }
    if(count($return)==0)
    {
        if($db->query_insert('INSERT INTO users (login,pass,name,group_id,cookie) VALUES($,$,$,$,$,$);', 'users', array($login,md5($pass),$name,$mail,$group_id,'')))        
            return true;
        else
            return false;        
    }
    return $return;
}
/**
 * Удаляет запись о пользователе
 *
 * @param int $id
 */
function userDelete($id)
{    
    if($id != userGetId())
    {
        if($db->get_value_query('SELECT count(*) FROM `users` WHERE `group_id` = \'1\'', 'users')>0)
        {
            $db->query('DELETE FROM users WHERE id = $', 'users', $id);
            $db->query('DELETE FROM user_prop_value WHERE user_id = $', 'users', $id);
            return true;
        }        
        return getFunctionsMessage("LAST_ADMIN");
    }
    return getFunctionsMessage("YOURSELF_DELETE");
}
?>