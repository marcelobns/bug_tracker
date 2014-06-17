<div class="bugs form">
<?php echo $this->Form->create('Bug'); ?>
	<fieldset>
		<legend><?php echo __('Edit Bug'); ?><span class="pull-right"><?=$this->request->data['Bug']['id']?></span></legend>
	<?php
		echo $this->Form->input('Bug.id');
        echo $this->Form->input('BugTracker.id');
        echo $this->Form->input('origin_id', array('class'=>'select2', 'empty'=>__('Select an Item...')));
        echo $this->Form->input('requestor');
        echo $this->Form->input('phone');
        echo $this->Form->input('product_id', array('class'=>'select2', 'empty'=>__('Select an Item...')));
        echo $this->Form->input('details');
        echo $this->Form->input('technician_id', array('multiple'=>true,'label'=>__('Technician'),'class'=>'select2'));
//        echo $this->Form->input('deadline_alert', array('options' => array(false=>__('NO'), true=>__('YES'))));
	?>
    <?php echo $this->Form->button(__('Submit'), array('type'=>'submit', 'class'=>'btn btn-success')); ?>
    <?php echo $this->Html->link(__('Cancel'), $this->request->referer(), array('class'=>'btn btn-default')); ?>
	</fieldset>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <?=$this->element('side.bugs');?>
</div>