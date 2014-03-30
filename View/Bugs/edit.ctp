<div style="position: absolute; width: 20%">
    <div id="actions-hide">
        <a><i class="fa fa-angle-double-left fa-2x"></i></a>
    </div>
    <div id="actions-show">
        <a><i class="fa fa-ellipsis-v fa-2x"></i></a>
    </div>
</div>
<div class="bugs form">
<?php echo $this->Form->create('Bug'); ?>
	<fieldset>
		<legend><?php echo __('Edit Bug'); ?></legend>
	<?php
		echo $this->Form->input('id');
        echo $this->Form->input('reporter');
        echo $this->Form->input('phone');
        echo $this->Form->input('details');
        echo $this->Form->input('product_id', array('class'=>'select2', 'empty'=>__('Select an Item...')));
        echo $this->Form->input('location_group_id', array('class'=>'select2', 'empty'=>__('Select an Item...')));
        echo $this->Form->input('location', array('type'=>'text'));
        echo $this->Form->input('priority_id', array('class'=>'select2'));
	?>
	</fieldset>
    <?php echo $this->Form->button(__('Submit'), array('type'=>'submit', 'class'=>'btn btn-success btn-lg')); ?>
    <?php echo $this->Html->link(__('Cancel'), $this->request->referer(), array('class'=>'btn btn-default btn-lg')); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions actions-toggle">
    <?=$this->element('side.bugs');?>
</div>