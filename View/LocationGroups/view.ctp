<div class="locationGroups view">
<h2><?php echo __('Location Group'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($locationGroup['LocationGroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($locationGroup['LocationGroup']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Location Group'), array('action' => 'edit', $locationGroup['LocationGroup']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Location Group'), array('action' => 'delete', $locationGroup['LocationGroup']['id']), null, __('Are you sure you want to delete # %s?', $locationGroup['LocationGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Location Groups'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location Group'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bugs'), array('controller' => 'bugs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bug'), array('controller' => 'bugs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Bugs'); ?></h3>
	<?php if (!empty($locationGroup['Bug'])): ?>
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
	<?php foreach ($locationGroup['Bug'] as $bug): ?>
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
        <?=$this->element('side.generic');?>
	</div>
</div>
