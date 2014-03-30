<div style="position: absolute; width: 20%">
    <div id="actions-hide">
        <a><i class="fa fa-angle-double-left fa-2x"></i></a>
    </div>
    <div id="actions-show">
        <a><i class="fa fa-ellipsis-v fa-2x"></i></a>
    </div>
</div>
<div class="users index">
	<h2><?php echo __('Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('role_id'); ?></th>
			<th><?php echo $this->Paginator->sort('organization_id'); ?></th>
            <th><?php echo $this->Paginator->sort('last_signin'); ?></th>
			<th class="action-add">
                <?php echo $this->Html->link('<i class="fa fa-plus fa-lg"></i> '.__('New User'), array('action' => 'add'), array('escape'=>false)); ?>
            </th>
	</tr>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($user['Role']['name'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($user['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $user['Organization']['id'])); ?>
		</td>
		<td><?php echo h($user['User']['last_signin']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i>', array('action' => 'view', $user['User']['id']), array('escape'=>false)); ?>
			<?php echo $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', array('action' => 'edit', $user['User']['id']), array('escape'=>false)); ?>
			<?php echo $this->Html->link('<i class="fa fa-minus-square-o fa-lg"></i>', array('action' => 'reset', $user['User']['id']), array('escape'=>false)); ?>
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
<div class="actions actions-toggle">
    <?=$this->element('side.generic');?>
</div>
