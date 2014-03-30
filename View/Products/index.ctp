<div class="products index">
	<h2><?php echo __('Products'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('organization_id'); ?></th>
			<th class="action-add">
                <?php echo $this->Html->link('<i class="fa fa-plus fa-lg"></i> '.__('New Product'), array('action' => 'add'), array('escape'=>false)); ?>
            </th>
	</tr>
	<?php foreach ($products as $product): ?>
	<tr>
		<td><?php echo h($product['Product']['id']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($product['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $product['Organization']['id'])); ?>
		</td>
		<td class="actions">
            <?php echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i>', array('action' => 'view', $product['Product']['id']), array('escape'=>false)); ?>
            <?php echo $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', array('action' => 'edit', $product['Product']['id']), array('escape'=>false)); ?>
            <?php echo $this->Form->postLink('<i class="fa fa-trash-o fa-lg"></i>', array('action' => 'delete', $product['Product']['id']), array('escape'=>false), __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?>
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
