<?
function v_dump($ar)
{
    echo '<pre>';
    var_dump($ar);
    echo '</pre>';    
}
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/config.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/database.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/users.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/accounts.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/include/functions/orders.php');

$res = db_query_array_list("SELECT * FROM users", 'users', 1);
v_dump($res);
/**
 * comment
 *
 * @param $a
 * @return string
 */

?>
