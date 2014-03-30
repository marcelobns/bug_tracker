<div class="situations form">
<?php echo $this->Form->create('Situation'); ?>
	<fieldset>
		<legend><?php echo __('Add Situation'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('role_id');
		echo $this->Form->input('sort');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Situations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bug Trackers'), array('controller' => 'bug_trackers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bug Tracker'), array('controller' => 'bug_trackers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bugs'), array('controller' => 'bugs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bug'), array('controller' => 'bugs', 'action' => 'add')); ?> </li>
	</ul>
</div>
