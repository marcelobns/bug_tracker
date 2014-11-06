<div class="products index">
	<legend><?php echo __('Products'); ?></legend>
	<table  class="table table-condensed table-hover">
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('name'); ?></th>
            <th><?php echo $this->Paginator->sort('organization_id'); ?></th>
            <th><?php echo $this->Paginator->sort('deadline'); ?></th>
            <th class="actions">
                <?php echo $this->Html->link(__('New Product'), array('action' => 'add'), array('escape'=>false)); ?>
            </th>
        </tr>
        </thead>
	<?php foreach ($products as $product): ?>
	<tr>
		<td><?php echo h($product['Product']['id']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($product['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $product['Organization']['id'])); ?>
		</td>
        <td><?php echo h($product['Product']['deadline']); ?>&nbsp;</td>
		<td class="actions">
            <?php echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i>', array('action' => 'view', $product['Product']['id']), array('escape'=>false)); ?>
            <?php echo $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', array('action' => 'edit', $product['Product']['id']), array('escape'=>false)); ?>
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