<div class="locationGroups index">
	<h2><?php echo __('Location Groups'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
        <th class="action-add">
            <?php echo $this->Html->link('<i class="fa fa-plus fa-lg"></i> '.__('New Location Group'), array('action' => 'add'), array('escape'=>false)); ?>
        </th>
	</tr>
	<?php foreach ($locationGroups as $locationGroup): ?>
	<tr>
		<td><?php echo h($locationGroup['LocationGroup']['id']); ?>&nbsp;</td>
		<td><?php echo h($locationGroup['LocationGroup']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php// echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i>', array('action' => 'view', $locationGroup['LocationGroup']['id']), array('escape'=>false)); ?>
			<?php echo $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', array('action' => 'edit', $locationGroup['LocationGroup']['id']), array('escape'=>false)); ?>
			<?php echo $this->Form->postLink('<i class="fa fa-trash-o fa-lg"></i>', array('action' => 'delete', $locationGroup['LocationGroup']['id']), array('escape'=>false), __('Are you sure you want to delete # %s?', $locationGroup['LocationGroup']['id'])); ?>
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
    <?=$this->element('side.generic');?>
</div>
