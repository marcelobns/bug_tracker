<div class="bugs form col-md-9">
<?php echo $this->Form->create('Bug'); ?>
	<fieldset>
		<legend><?php echo __('Edit Bug'); ?> <?=$this->request->data['Bug']['id']?></legend>
	<?php
		echo $this->Form->input('Bug.id');
        echo $this->Form->input('BugTracker.id');
        echo $this->Form->input('origin_id', array('empty'=>__('Select an Item...')));
        echo $this->Form->input('requestor');
        echo $this->Form->input('phone');
        echo $this->Form->input('product_id', array('empty'=>__('Select an Item...')));
        echo $this->Form->input('details', array('type'=>'text'));
        echo $this->Form->input('technician_id', array('multiple'=>true,'label'=>__('Technician')));
	?>
    <?php echo $this->Form->button(__('Submit'), array('type'=>'submit', 'class'=>'btn btn-success')); ?>
    <?php echo $this->Html->link(__('Cancel'), $this->request->referer(), array('class'=>'btn btn-default')); ?>
	</fieldset>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions col-md-3">
    <?php echo $this->Element('side.bugs');?>
</div>