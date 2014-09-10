<?require($_SERVER["DOCUMENT_ROOT"]."/include/header.php");?>
<h2>Ваши заказы</h2>
<a class="btn btn-primary">Добавить заказ</a>            
<?
$orders = orderListByUserID(userGetId());
if (is_array($orders)&&count($res)>0):?>
    <div class="orders">
        <div class="order head clear">
            <div class="left">Наименование</div>                    
            <div class="right">Стоимость</div>
        </div>
    <?foreach($orders as $order):?>
        <div class="order clear">
            <div class="left"><?=$order["name"]?></div>                    
            <div class="right"><?=$order["price"]?> руб. <span class="divider">|</span> <a href="#" class="execute">Выполнить</a></div>
        </div>
    <?endforeach;?>
    </div>
<?else:?>
    <p class="text-muted"><?=getMessage("NO_USER_ORDERS")?></p>
<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/include/footer.php");?>