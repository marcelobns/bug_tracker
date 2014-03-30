<div class="bugTrackers form">
<?php echo $this->Form->create('BugTracker'); ?>
	<fieldset>
		<legend><?php echo __('Edit Bug Tracker'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('bug_id');
		echo $this->Form->input('situation_id');
		echo $this->Form->input('details');
		echo $this->Form->input('organization_id');
		echo $this->Form->input('created_by');
		echo $this->Form->input('updated_by');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('BugTracker.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('BugTracker.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Bug Trackers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Bugs'), array('controller' => 'bugs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bug'), array('controller' => 'bugs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Situations'), array('controller' => 'situations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Situation'), array('controller' => 'situations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
	</ul>
</div>
