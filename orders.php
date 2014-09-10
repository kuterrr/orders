<?require($_SERVER["DOCUMENT_ROOT"]."/include/header.php");?>
<?
if (userGetGroup()!=3 || !check_sessid())
{
    echo getMessage("WRONG_USER");    
    exit;
}
?>
<h2>Текущие заказы</h2>
<?
$orders = orderList();
if (is_array($orders)&&count($orders)>0):?>
    <div class="orders">
        <div class="order head clear">
            <div class="left">Наименование</div>                    
            <div class="right">Стоимость</div>
        </div>
    <?foreach($orders as $order):?>
        <div class="order clear" id="order<?=$order["id"]?>">
            <div class="left"><?=$order["name"]?></div>                    
            <div class="right"><?=$order["price"]?> руб. <span class="divider">|</span> <a href="#" class="execute" data-id="<?=$order["id"]?>">Выполнить</a></div>
        </div>
    <?endforeach;?>
    </div>
<?else:?>
    <p class="text-muted"><?=getMessage("NO_EXECUTOR_ORDERS")?></p>
<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/include/footer.php");?>