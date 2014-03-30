<div style="position: absolute; width: 20%">
    <div id="actions-hide">
        <a><i class="fa fa-angle-double-left fa-2x"></i></a>
    </div>
    <div id="actions-show">
        <a><i class="fa fa-ellipsis-v fa-2x"></i></a>
    </div>
</div>
<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	    <?php
		echo $this->Form->input('id');
        echo $this->Form->input('name');
        echo $this->Form->input('email');
        echo $this->Form->input('phone');

        if($isUser){
            echo $this->Form->input('username', array('disabled'));
            echo $this->Form->input('password', array('value'=>'', 'section'=>'password', 'label'=>'New Password'));
            echo '<span class="help-block 1"><a href="#password" id="editPassword">'.__('edit password').'</a></span>';
            echo '<span class="help-block 2" style="display: none;"><a href="#password" id="closePassword">'.__('close password').'</a></span>';
            echo $this->Form->input('confirm_password', array('type'=>'password', 'label'=>'Current Password'));
        }
        if($isUser || $this->Session->read('Auth.User.Role.sort') < $role_sort){
            echo $this->Form->input('organization_id', array('class'=>'select2', 'empty'=>__('Select an Item...')));
            echo $this->Form->input('role_id', array('class'=>'select2', 'empty'=>__('Select an Item...')));
        }
	    ?>
	</fieldset>
    <?php echo $this->Form->button(__('Submit'), array('type'=>'submit', 'class'=>'btn btn-success btn-lg')); ?>
    <?php echo $this->Html->link(__('Cancel'), $this->request->referer(), array('class'=>'btn btn-default btn-lg')); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions actions-toggle">
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