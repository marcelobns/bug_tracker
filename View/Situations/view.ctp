<div class="situations view">
<h2><?php echo __('Situation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($situation['Situation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($situation['Situation']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo $this->Html->link($situation['Role']['name'], array('controller' => 'roles', 'action' => 'view', $situation['Role']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sort'); ?></dt>
		<dd>
			<?php echo h($situation['Situation']['sort']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Situation'), array('action' => 'edit', $situation['Situation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Situation'), array('action' => 'delete', $situation['Situation']['id']), null, __('Are you sure you want to delete # %s?', $situation['Situation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Situations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Situation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bug Trackers'), array('controller' => 'bug_trackers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bug Tracker'), array('controller' => 'bug_trackers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bugs'), array('controller' => 'bugs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bug'), array('controller' => 'bugs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Bug Trackers'); ?></h3>
	<?php if (!empty($situation['BugTracker'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Bug Id'); ?></th>
		<th><?php echo __('Situation Id'); ?></th>
		<th><?php echo __('Details'); ?></th>
		<th><?php echo __('Organization Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created By'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th><?php echo __('Updated By'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($situation['BugTracker'] as $bugTracker): ?>
		<tr>
			<td><?php echo $bugTracker['id']; ?></td>
			<td><?php echo $bugTracker['bug_id']; ?></td>
			<td><?php echo $bugTracker['situation_id']; ?></td>
			<td><?php echo $bugTracker['details']; ?></td>
			<td><?php echo $bugTracker['organization_id']; ?></td>
			<td><?php echo $bugTracker['created']; ?></td>
			<td><?php echo $bugTracker['created_by']; ?></td>
			<td><?php echo $bugTracker['updated']; ?></td>
			<td><?php echo $bugTracker['updated_by']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'bug_trackers', 'action' => 'view', $bugTracker['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'bug_trackers', 'action' => 'edit', $bugTracker['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'bug_trackers', 'action' => 'delete', $bugTracker['id']), null, __('Are you sure you want to delete # %s?', $bugTracker['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Bug Tracker'), array('controller' => 'bug_trackers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Bugs'); ?></h3>
	<?php if (!empty($situation['Bug'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Reporter'); ?></th>
		<th><?php echo __('Reporter Social'); ?></th>
		<th><?php echo __('Details'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Situation Id'); ?></th>
		<th><?php echo __('Priority Id'); ?></th>
		<th><?php echo __('Location Geo'); ?></th>
		<th><?php echo __('Location Group Id'); ?></th>
		<th><?php echo __('Location'); ?></th>
		<th><?php echo __('Points'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Created By'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th><?php echo __('Updated By'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($situation['Bug'] as $bug): ?>
		<tr>
			<td><?php echo $bug['id']; ?></td>
			<td><?php echo $bug['reporter']; ?></td>
			<td><?php echo $bug['reporter_social']; ?></td>
			<td><?php echo $bug['details']; ?></td>
			<td><?php echo $bug['product_id']; ?></td>
			<td><?php echo $bug['situation_id']; ?></td>
			<td><?php echo $bug['priority_id']; ?></td>
			<td><?php echo $bug['location_geo']; ?></td>
			<td><?php echo $bug['location_group_id']; ?></td>
			<td><?php echo $bug['location']; ?></td>
			<td><?php echo $bug['points']; ?></td>
			<td><?php echo $bug['created']; ?></td>
			<td><?php echo $bug['created_by']; ?></td>
			<td><?php echo $bug['updated']; ?></td>
			<td><?php echo $bug['updated_by']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'bugs', 'action' => 'view', $bug['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'bugs', 'action' => 'edit', $bug['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'bugs', 'action' => 'delete', $bug['id']), null, __('Are you sure you want to delete # %s?', $bug['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Bug'), array('controller' => 'bugs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
