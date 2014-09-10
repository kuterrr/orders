<?
/**
 * Добавляем новый заказ
 *
 * @param array $ar
 * @return int
 */
function orderAdd($ar)
{
    $ar["user_id"] = (int)$ar["user_id"];   
    if(htmlspecialchars($ar["name"])!=$ar["name"] || $ar["name"]=='')
    {
        $return[] = getFunctionsMessage('O_WRONG_NAME');
    }
    if (!$ar["price"]||$ar["price"]<0)
    {
        $return[] = getFunctionsMessage('O_WRONG_PRICE');
    }
    if(count($return)==0)
    {
        if(db_query_insert('INSERT INTO orders (user_id, date_created, name, price, status) VALUES($,NOW(),$,$,0);', 'orders', array($ar["user_id"],$ar["name"],$ar["price"])))        
            return true;
        else
            return false;        
    }
    return $return;
}
/**
 * Добавляем исполнителя
 *
 * @param int $id - номер заказа
 * @param int $executor_id
 * @return array - заказ
 */
function orderAddExecuter($id, $executor_id)
{  
    if (!$id)
    {
        $return[] = getFunctionsMessage('O_WRONG_ID');
    }
    if (!$executor_id)
    {
        $return[] = getFunctionsMessage('O_WRONG_EXECUTOR');
    }
    if(count($return)==0)
    {
        if (db_query('UPDATE orders SET executor_id=$, status = 1 WHERE id = $', 'orders', array($executor_id, $id)))
        
            return db_query_one_line("SELECT * FROM orders WHERE id=$","orders",$id);
                   
        return false;
    }
    return $return;
}
/**
 * Удаляем заказ
 *
 * @param int $id - номер заказа
 * @return int
 */
function orderDelete($id)
{  
    if (!$id)
    {
        $return[] = getFunctionsMessage('O_WRONG_ID');
    }
    
    if(count($return)==0)
    {
        db_query('DELETE FROM orders WHERE id = $', 'orders', $id);         
        return true;   
    }
    return $return;
}

/**
 * Список заказов добавленных заказчиком
 * 
 * @param int $user_id
 * @return array
 */
function orderListByUserID($user_id)
{  
    if (!$user_id)
    {
        $return[] = getFunctionsMessage('O_WRONG_USER_ID');
    }
    
    if(count($return)==0)
    {
        return db_query_array_list('SELECT id, user_id, executor_id, name, price, date_created, timestamp FROM orders WHERE user_id=$ ORDER BY id DESC', 'orders', $user_id);                 
    }
    return $return;
}
/**
 * Список заказов обработанных исполнителем
 * 
 * @param int $user_id
 * @return array
 */
function orderList()
{  
    if(count($return)==0)
    {
        return db_query_array_list('SELECT id, user_id, executor_id, name, price, date_created, timestamp FROM orders WHERE status=0', 'orders');                 
    }
    return $return;
}
?>