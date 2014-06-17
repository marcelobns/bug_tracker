<div class="organizations form">
<?php echo $this->Form->create('Organization'); ?>
	<fieldset>
		<legend><?php echo __('Edit Organization'); ?></legend>
	    <?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('responsible');
		echo $this->Form->input('parent_id', array('class'=>'select2', 'empty'=>__('Select an Item...')));
		echo $this->Form->input('acronym');
        echo $this->Form->input('phone');
	    ?>
        <?php echo $this->Form->button(__('Submit'), array('type'=>'submit', 'class'=>'btn btn-success')); ?>
        <?php echo $this->Html->link(__('Cancel'), $this->request->referer(), array('class'=>'btn btn-default')); ?>
	</fieldset>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <?=$this->element('side.generic');?>
</div>
