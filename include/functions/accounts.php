<?
/**
 * Добавляем сумму на счет
 *
 * @param array $ar
 * @return int
 */
function accountAdd($ar)
{
    $ar["executor_id"] = (int)$ar["executor_id"];   
    if (!$ar["amount"])
    {
        $return[] = getFunctionsMessage('O_WRONG_PRICE');
    }
    if(count($return)==0)
    {
        if(db_query_insert('INSERT INTO accounts (executor_id, amount) VALUES($,$);', 'accounts', array($ar["executor_id"],$ar["amount"])))        
            return true;
        else
            return false;        
    }
    return $return;
}

/**
 * Удаляем сумму со счета
 *
 * @param int $id - номер заказа
 * @return int
 */
function accountDelete($id)
{  
    if (!$id)
    {
        $return[] = getFunctionsMessage('O_WRONG_ID');
    }
    
    if(count($return)==0)
    {
        db_query('DELETE FROM accounts WHERE id = $', 'accounts', $id);         
        return true;   
    }
    return $return;
}

/**
 * Сумма по счету
 * 
 * @param int $user_id
 * @return array
 */
function accountSum($executor_id)
{  
    if (!$executor_id)
    {
        $return[] = getFunctionsMessage('O_WRONG_USER_ID');
    }
    
    if(count($return)==0)
    {
        $sum = db_query_get_value('SELECT if(SUM(amount), SUM(amount) , 0 ) FROM accounts WHERE executor_id=$', 'accounts', $executor_id);                 
        return round($sum,2);
    }
    return $return;
}
?>