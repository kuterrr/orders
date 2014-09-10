<?require($_SERVER["DOCUMENT_ROOT"]."/include/prolog.php");
if ($_REQUEST["action"]=="add_order")
{
    if (userGetGroup()!=2 || !check_sessid())
    {
        echo getMessage("WRONG_USER");    
        exit;
    }
    $ar = Array(
        "user_id" => userGetId(),
        "name" => $_REQUEST["name"],
        "price" => $_REQUEST["price"],        
    );
    $result = orderAdd($ar);
    if ($result!==true)
        echo implode("<br />",$result);
}
if ($_REQUEST["action"]=="execute")
{
    if (userGetGroup()!=3 || !check_sessid())
    {
        echo getMessage("WRONG_USER");    
        exit;
    }
    $order = orderAddExecuter($_REQUEST["id"],userGetId());
    $ar = Array(
        "executor_id" => userGetId(),
        "amount" => round(($order["price"] - ($order["price"]*COMISSION/100)),2)//округляем до второго знака после запятой
        
    );
    accountAdd($ar);
    //добавляем системе комиссию    
    $ar = Array(
        "executor_id" => 0,
        "amount" => round($order["price"]*COMISSION/100,2)//округляем до второго знака после запятой
        
    );
    accountAdd($ar);
    echo accountSum(userGetId());    
}