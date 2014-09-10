<?require($_SERVER["DOCUMENT_ROOT"]."/include/prolog.php");?>
<?
if (userGetGroup()!=2 || !check_sessid())
{
    echo getMessage("WRONG_USER");    
    exit;
}
$orders = orderListByUserID(userGetId());
if (is_array($orders)&&count($orders)>0):?>
    <div class="orders">
        <div class="order head clear">
            <div class="left"><?=getMessage("ORDER_NAME")?></div>                    
            <div class="right"><?=getMessage("ORDER_PRICE")?></div>
        </div>
    <?foreach($orders as $order):?>
        <div class="order clear">
            <div class="left"><?=$order["name"]?></div>                    
            <div class="right"><?=$order["price"]?> <?=getMessage("ORDER_CURRENCY")?></div>
        </div>
    <?endforeach;?>
    </div>
<?else:?>
    <p class="text-muted"><?=getMessage("NO_USER_ORDERS")?></p>
<?endif;?>