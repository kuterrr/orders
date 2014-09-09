<?
/**	
 * Подключение к БД
 *
 * @param int $db
 */
function db_connect($db)
{
    global $db_conn;     
    if ($db_conn[$db]['handler'] === null) 
    {
        $db_conn[$db]['handler'] = mysql_connect($db_conn[$db]['host'], $db_conn[$db]['user'], $db_conn[$db]['pass']);       
        if (!$db_conn[$db]['handler']) {
            trigger_error(mysql_errno($db_conn[$db]['handler']).' '.mysql_error($db_conn[$db]['handler']), ERROR);
            die();
        }
        if(!mysql_select_db($db_conn[$db]['dbname'],$db_conn[$db]['handler'])) 
        {
            trigger_error(mysql_errno($db_conn[$db]['handler']).' '.mysql_error($db_conn[$db]['handler']), ERROR);
            die();
        }
        else 
        {
            mysql_query("SET NAMES 'utf8';");
        }        
    }
    return $db_conn[$db]['handler'];
}
/**	
 * Поиск необходимой БД
 *
 * @param query $sql
 * @param replace_arr $repl_arr
 * @return int
 */
function db_search($table)
{
    if (count($db_conn)>1 && $table)
    {
        $db = array_search($table, $db_tables);
        if ($db === null)
            return false;
        $handler = db_connect($db);
    }
    else 
    {            
        $handler = db_connect(0);
    }
    return $handler;
}
/**	
 * Заменяет $ в запросе на значения из массива, если перед ним не стоит \
 *
 * @param query $sql
 * @param replace_arr $repl_arr
 */
function db_query_replase($sql,$repl_arr=null)
{
        if($repl_arr===null or $repl_arr==array()) 
        {
            return $sql;
        }
        else {
            $sql_out='';
            $start=0;
            preg_match_all('/([^\\\\]{1}\\$)/',$sql,$math,PREG_OFFSET_CAPTURE);            
            foreach ($math[1] as $key=>$val)
            {
                $sql_out.=substr($sql,$start,$val[1]-$start+1);
                if(is_array($repl_arr))
                {
                        $sql_out.="'".addslashes($repl_arr[$key])."'";
                }
                elseif($key==0)
                {
                        $sql_out.="'".addslashes($repl_arr)."'";
                }
                $start=$val[1]+2;
            }
            $sql_out.=substr($sql,$start);
            return str_replace('\\$', '$', $sql_out);
        }
}
/**
 * Выполняет sql запрос 
 * 
 * @param string $sql
 * @param string $table
 * @param unknown_type $repl_arr
 * @return int
 */
function db_query ($sql, $table, $repl_arr=null)
{
    $handler = db_search($table);
    $sql = db_query_replase($sql, $repl_arr);    
    if(!$res = mysql_query($sql,$handler))
    {
        trigger_error(mysql_errno($handler).' '.mysql_error($handler), ERROR);            
        return false;
    }
    return $res;
}
/**
 * Выполняет sql запрос и возвращает ID, сгенерированный INSERT-запросом
 * возвращает 0, если запрос не работал с AUTO_INCREMENT полями
 * 
 * @param string $sql
 * @param string $table
 * @param unknown_type $repl_arr
 * @return int
 */
function db_query_insert($sql, $table, $repl_arr=null)
{
    $handler = db_search($table);
    db_query($sql, $repl_arr);
    return mysql_insert_id($handler);
}
/**
 * Выполняет sql запрос и возвращает число затронуиых операцией рядов
 *
 * @param string $sql
 * @param string $table 
 * @param unknown_type $repl_arr
 * @return int
 */
function db_query_affected_rows($sql, $table, $repl_arr=null)
{
    $handler = db_search($table);
    db_query($sql, $repl_arr);
    return mysql_affected_rows($handler);
}

/**
 * Возвращает ответ на запрос в виде двумерного массива
 *
 * @param string $sql
 * @param string $table
 * @param unknown_type $repl_arr
 * @return array
 */
function db_query_array_list($sql, $table, $repl_arr=null)
{    
    $handler = db_search($table);
    if(!$res = db_query($sql, $table, $repl_arr))	
        return false;
    
    $array = Array();
    while ($row = mysql_fetch_assoc($res)) {
            $array[] = $row;
    }

    return $array;
}
?>