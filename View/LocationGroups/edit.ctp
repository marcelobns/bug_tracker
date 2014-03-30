<div class="locationGroups form">
<?php echo $this->Form->create('LocationGroup'); ?>
	<fieldset>
		<legend><?php echo __('Edit Location Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
    <?php echo $this->Form->button(__('Submit'), array('type'=>'submit', 'class'=>'btn btn-success btn-lg')); ?>
    <?php echo $this->Html->link(__('Cancel'), $this->request->referer(), array('class'=>'btn btn-default btn-lg')); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <?=$this->element('side.generic');?>
</div>
