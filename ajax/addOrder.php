<?require($_SERVER["DOCUMENT_ROOT"]."/include/prolog.php");
if (userGetGroup()!=2 || !check_sessid())
{
    echo getMessage("WRONG_USER");    
    exit;
}
?>
<h4><?=getMessage("ADD_ORDER2")?></h4>
<form>
    <input type="hidden" name="action" value="add_order" />
    <input type="text" name="name" class="input" placeholder="<?=getMessage("ORDER_NAME")?>" required="required"/>
    <input type="text" name="price" class="input small" placeholder="<?=getMessage("ORDER_PRICE")?>" required="required"/> руб.
    <div><input type="submit" class="btn btn-primary" value="<?=getMessage("ORDER_ADD")?>" /></div>
</form>