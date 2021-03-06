<div class="roles form col-md-8">
<?php echo $this->Form->create('Role'); ?>
	<fieldset>
		<legend><?php echo __('Edit Role'); ?></legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('name');
			echo $this->Form->input('sort');
			echo $this->AuthView->input_rules($this->request->data['Rule'], 'Role');
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions col-md-4">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Role.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Role.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Roles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Situations'), array('controller' => 'situations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Situation'), array('controller' => 'situations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
