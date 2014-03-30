<div class="bugTrackers index">
	<h2><?php echo __('Bug Trackers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('bug_id'); ?></th>
			<th><?php echo $this->Paginator->sort('situation_id'); ?></th>
			<th><?php echo $this->Paginator->sort('details'); ?></th>
			<th><?php echo $this->Paginator->sort('organization_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('created_by'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th><?php echo $this->Paginator->sort('updated_by'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($bugTrackers as $bugTracker): ?>
	<tr>
		<td><?php echo h($bugTracker['BugTracker']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($bugTracker['Bug']['id'], array('controller' => 'bugs', 'action' => 'view', $bugTracker['Bug']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($bugTracker['Situation']['name'], array('controller' => 'situations', 'action' => 'view', $bugTracker['Situation']['id'])); ?>
		</td>
		<td><?php echo h($bugTracker['BugTracker']['details']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($bugTracker['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $bugTracker['Organization']['id'])); ?>
		</td>
		<td><?php echo h($bugTracker['BugTracker']['created']); ?>&nbsp;</td>
		<td><?php echo h($bugTracker['BugTracker']['created_by']); ?>&nbsp;</td>
		<td><?php echo h($bugTracker['BugTracker']['updated']); ?>&nbsp;</td>
		<td><?php echo h($bugTracker['BugTracker']['updated_by']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $bugTracker['BugTracker']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $bugTracker['BugTracker']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $bugTracker['BugTracker']['id']), null, __('Are you sure you want to delete # %s?', $bugTracker['BugTracker']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Bug Tracker'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Bugs'), array('controller' => 'bugs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bug'), array('controller' => 'bugs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Situations'), array('controller' => 'situations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Situation'), array('controller' => 'situations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Organizations'), array('controller' => 'organizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Organization'), array('controller' => 'organizations', 'action' => 'add')); ?> </li>
	</ul>
</div>
