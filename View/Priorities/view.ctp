<div class="priorities view">
<h2><?php echo __('Priority'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($priority['Priority']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($priority['Priority']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sort'); ?></dt>
		<dd>
			<?php echo h($priority['Priority']['sort']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Priority'), array('action' => 'edit', $priority['Priority']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Priority'), array('action' => 'delete', $priority['Priority']['id']), null, __('Are you sure you want to delete # %s?', $priority['Priority']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Priorities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Priority'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bugs'), array('controller' => 'bugs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bug'), array('controller' => 'bugs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Bugs'); ?></h3>
	<?php if (!empty($priority['Bug'])): ?>
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
	<?php foreach ($priority['Bug'] as $bug): ?>
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
