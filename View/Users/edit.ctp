<div class="users form col-md-9">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend>Editar Usuário</legend>
	    <?php
		echo $this->Form->input('id');
        echo $this->Form->input('name');
        echo $this->Form->input('email');
        echo $this->Form->input('phone');
        if($isUser){
            echo $this->Form->input('username', array('disabled'));
            echo $this->Form->input('confirm_password', array('type'=>'password', 'label'=>'Senha Atual'));
            echo $this->Form->input('password', array('value'=>'', 'section'=>'password', 'label'=>'Nova Senha'));
            echo '<span class="help-block 1"><a href="#password" id="editPassword">Editar Senha</a></span>';
            echo '<span class="help-block 2" style="display: none;"><a href="#password" id="closePassword">Fechar</a></span>';
        }
        if($isUser || $this->Session->read('Auth.User.Role.sort') < $role_sort){
            echo $this->Form->input('organization_id', array('empty'=>__('Select an Item...')));
            echo $this->Form->input('role_id', array('empty'=>__('Select an Item...')));
            echo $this->Form->input('requestor', array('options' => array(false=>__('NO'), true=>__('YES'))));
        }
	    ?>
        <?php echo $this->Form->button(__('Submit'), array('type'=>'submit', 'class'=>'btn btn-success')); ?>
        <?php echo $this->Html->link(__('Cancel'), $this->request->referer(), array('class'=>'btn btn-default')); ?>
	</fieldset>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions col-md-3">
    <?=$this->element('side.generic');?>
</div>
<?php $this->start('script'); ?>
<script type="text/javascript">
    $(function(){
        $('#UserPassword').val('');
        $('#UserConfirmPassword').val('');

        $('#UserPassword').attr('disabled', true)
    })

    $('#UserConfirmPassword').blur(function(){
        if($('#UserPassword').isDisabled){
            if($('#UserConfirmPassword').val() != $('#UserPassword').val()){
                $('#UserPassword').css('border-color', 'red');
                $('#UserConfirmPassword').css('border-color', 'red');
                $('#UserConfirmPassword').val('');
            } else {
                $('#UserPassword').css('border-color', 'green');
                $('#UserConfirmPassword').css('border-color', 'green');
            }
        }
    });
    $('#editPassword').on('click', function(){
        $('#UserPassword').attr('disabled', false)
        $('#UserPassword').focus();
        $('.help-block.1').hide();
        $('.help-block.2').show();
    });
    $('#closePassword').on('click', function(){
        $('#UserPassword').attr('disabled', true)
        $('.help-block.2').hide();
        $('.help-block.1').show();
    });

</script>
<?php $this->end(); ?>