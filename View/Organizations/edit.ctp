<div class="organizations form col-md-9">
<?php echo $this->Form->create('Organization'); ?>
	<fieldset>
		<legend>Editar Organização</legend>
	    <?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('class'=>'uppercase'));
		echo $this->Form->input('responsible');
		echo $this->Form->input('parent_id', array('empty'=>__('Select an Item...')));
		echo $this->Form->input('acronym');
        echo $this->Form->input('phone');
	    ?>
        <?php echo $this->Form->button(__('Submit'), array('type'=>'submit', 'class'=>'btn btn-success')); ?>
        <?php echo $this->Html->link(__('Cancel'), $this->request->referer(), array('class'=>'btn btn-default')); ?>
	</fieldset>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions col-md-3">
    <?=$this->element('side.generic');?>
</div>
