<div class="products form">
<?php echo $this->Form->create('Product'); ?>
	<fieldset>
		<legend><?php echo __('Edit Product'); ?></legend>
	    <?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('class'=>'uppercase'));
		echo $this->Form->input('description');
		echo $this->Form->input('keywords');
		echo $this->Form->input('organization_id');
        echo $this->Form->input('deadline', array('min'=>1));
	    ?>
        <?php echo $this->Form->button(__('Submit'), array('type'=>'submit', 'class'=>'btn btn-success')); ?>
        <?php echo $this->Html->link(__('Cancel'), $this->request->referer(), array('class'=>'btn btn-default')); ?>
	</fieldset>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <?=$this->element('side.generic');?>
</div>
