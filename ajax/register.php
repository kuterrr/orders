<?require($_SERVER["DOCUMENT_ROOT"]."/include/prolog.php");?>
<h4><?=getMessage("REGISTER")?></h4>
<form>
    <input type="hidden" name="action" value="register" />
    
    <input type="text" name="login" class="input"  required="required" placeholder="<?=getMessage("REGISTER_LOGIN")?>"/>    
    <input type="password" name="pass" class="input" placeholder="<?=getMessage("REGISTER_PASS")?>" required="required"/>
    
    <input type="text" name="name" class="input"  required="required" placeholder="<?=getMessage("REGISTER_NAME")?>"/>
    
    <input type="text" name="lastname" class="input"  required="required" placeholder="<?=getMessage("REGISTER_LASTNAME")?>"/>
    
    <select class="input" name="group_id" required="required">
        <option><?=getMessage("REGISTER_GROUP")?></option>
        <option value="2"><?=getMessage("REGISTER_USER")?></option>
        <option value="3"><?=getMessage("REGISTER_EXECUTOR")?></option>
    </select>    
    <div><input type="submit" class="btn btn-primary" value="<?=getMessage("ORDER_ADD")?>" /></div>
</form>