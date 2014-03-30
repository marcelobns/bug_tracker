<div class="bugTrackers view">
<h2><?php echo __('Bug Tracker'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($bugTracker['BugTracker']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bug'); ?></dt>
		<dd>
			<?php echo $this->Html->link($bugTracker['Bug']['id'], array('controller' => 'bugs', 'action' => 'view', $bugTracker['Bug']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Situation'); ?></dt>
		<dd>
			<?php echo $this->Html->link($bugTracker['Situation']['name'], array('controller' => 'situations', 'action' => 'view', $bugTracker['Situation']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Details'); ?></dt>
		<dd>
			<?php echo h($bugTracker['BugTracker']['details']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization'); ?></dt>
		<dd>
			<?php echo $this->Html->link($bugTracker['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $bugTracker['Organization']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($bugTracker['BugTracker']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo h($bugTracker['BugTracker']['created_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($bugTracker['BugTracker']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated By'); ?></dt>
		<dd>
			<?php echo h($bugTracker['BugTracker']['updated_by']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Bug Tracker'), array('action' => 'edit', $bugTracker['BugTracker']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Bug Tracker'), array('action' => 'delete', $bugTracker['BugTracker']['id']), null, __('Are you sure you want to delete # %s?', $bugTracker['BugTracker']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Bug Trackers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bug Tracker'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bugs'), array('controller' => 'bugs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bug'), array('controller' => 'bugs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Situations'), array('controller' => 'situations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Situation'), array('controller' => 'situations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
	</ul>
</div>
