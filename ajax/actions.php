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