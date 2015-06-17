
<?php echo $this->Form->create('User', array('url'=>array('action'=>'login'))); ?>
<fieldset style="max-width: 300px; margin: auto;">
    <legend><?=__('Bugs');?></legend>
        <div class="input text required form-group">
            <input class="form-control" name="data[User][username]" placeholder="Usuário" autofocus="1" maxlength="128" id="UserUsername" required="required" type="text">
        </div>
        <div class="input password required form-group">
            <input class="form-control" name="data[User][password]" placeholder="Senha" id="UserPassword" required="required" type="password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
</fieldset>
<?php echo $this->Form->end(); ?>
