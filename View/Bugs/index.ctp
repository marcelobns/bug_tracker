<?php $this->start('css'); ?>
<style>
    .select2-results{
        font-size: 0.9em;
    }
    .ui-widget{
        font-size: 0.9em;
    }
    .dropdown-menu ul, li {
        margin-bottom: 5px;
        margin-left: 1px;
        margin-right: 2px;
    }
    .dropdown-menu .filter-date {
        padding-bottom: 10px;
        margin-left: 5px;
        margin-right: 10px;
    }
    .filter-date label{
        font-size: 0.7em;
    }
</style>
<?php $this->end(); ?>
<div style="position: absolute; width: 20%">
    <div id="actions-hide">
        <a><i class="fa fa-angle-double-left fa-2x"></i></a>
    </div>
    <div id="actions-show">
        <a><i class="fa fa-ellipsis-v fa-2x"></i></a>
    </div>
</div>
<div class="bugs index">
    <legend>
        <?php echo __('Bugs'); ?>
        <?php echo $this->Html->link('<i class="filter fa fa-refresh" ></i>',
            array('controller' => 'bugs', 'action' => 'index'),
            array('escape'=>false)); ?>
    </legend>
	<table cellpadding="0" cellspacing="0" class="table-hover">
    <?php echo $this->Form->create('Bug', array('action'=>'filter', 'type'=>'GET', 'class'=>'formFilter')); ?>
        <thead>
        <tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th>
                <?php echo $this->element('filter.select', array(
                    'label' => $this->Paginator->sort('product_id'),
                    'field' => 'product',
                    'options' => $products
                    )); ?>
            <th>
                <?php echo $this->element('filter.select', array(
                        'label' => $this->Paginator->sort('situation_id'),
                        'field' => 'situation',
                        'options' => $situations
                    )); ?>
            </th>
            <th>
                <?php echo $this->element('filter.select', array(
                        'label' => $this->Paginator->sort('location_group_id'),
                        'field' => 'locationGroup',
                        'options' => $locationGroups
                    )); ?>
            </th>
            <th>
                <?php echo $this->element('filter.select', array(
                        'label' => $this->Paginator->sort('created_by'),
                        'field' => 'creator',
                        'options' => $creators
                    )); ?>
            </th>
			<th>
                <?php echo $this->element('filter.date', array(
                        'id' => 'created',
                        'label' => $this->Paginator->sort('created'),
                        'fields' => array('created_begin', 'created_end'),
                    )); ?>
			<th>
                <?php echo $this->element('filter.date', array(
                        'id' => 'updated',
                        'label' => $this->Paginator->sort('updated'),
                        'fields' => array('updated_begin', 'updated_end'),
                    )); ?>
            </th>
			<th>
                <?php echo $this->element('filter.select', array(
                        'label' => $this->Paginator->sort('technician_id'),
                        'field' => 'technician',
                        'options' => $technicians
                    )); ?>
            </th>
			<th class="action-add">
                <?php echo $this->Html->link('<i class="fa fa-plus fa-lg"></i> '.__('New Bug'), array('action' => 'add'), array('escape'=>false)); ?>
            </th>
        </tr>
	</thead>
    <?php echo $this->Form->end(); ?>

    <?php $opacity = 1; $row_id = 0;?>
    <?php foreach ($bugs as $bug): ?>
    <?php $opacity = $opacity-0.04; $row_id++;?>
	<tr id="<?=$row_id;?>" style="opacity: <?=$opacity;?>; font-size: 0.9em">
		<td><b style="font-size: 1.1em; color: #e32;"><?php echo h($bug['Bug']['id']); ?>&nbsp;<b></td>
		<td>
			<?php echo $this->Html->link($bug['Product']['name'], array('controller' => 'products', 'action' => 'view', $bug['Bug']['product_id'])); ?>
		</td>
		<td style="color:<?=$bug['Situation']['color'];?>;">
			<?php echo h($bug['Situation']['name']); ?>
		</td>
		<td>
			<?php echo h($bug['LocationGroup']['name']); ?>
		</td>
        <td>
            <?php echo $this->Html->link($bug['User']['username'], array('controller' => 'users', 'action' => 'view', $bug['Bug']['created_by'])); ?>
        </td>
		<td><?php echo $this->Time->format(h($bug['Bug']['created']),'%Y-%m-%d') ; ?>&nbsp;</td>
		<td><?php echo h($bug['Bug']['updated']); ?>&nbsp;</td>
        <td>
            <?php echo $this->Html->link($bug['Technician']['username'], array('controller' => 'users', 'action' => 'view', $bug['Technician']['id'])); ?>
        </td>
		<td class="actions" style="font-size: 1.3em;">
            <?php echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i>', array('controller' => 'bugs', 'action' => 'view', $bug['Bug']['id']), array('title'=>__('View'),'data-toggle'=>'modal', 'data-target'=>'#modal', 'escape'=>false)); ?>
            <?php echo $this->Html->link('<i class="fa fa-exchange fa-lg"></i>', array('controller' => 'bug_trackers', 'action' => 'add', $bug['Bug']['id']), array('title'=>__('Move'),'escape'=>false)); ?>
            <?php echo $this->Html->link('<i class="fa fa-warning fa-lg"></i>', array('controller' => 'bug_trackers', 'action' => 'report', $bug['Bug']['id']), array('title'=>__('Report Problem'), 'escape'=>false)); ?>
            <?php if($this->RenderControl->level(2)) : ?>
			<?php echo $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', array('action' => 'edit', $bug['Bug']['id']), array('title'=>__('Edit'),'escape'=>false)); ?>
			<?php echo $this->Form->postLink('<i class="fa fa-trash-o fa-lg"></i>', array('action' => 'delete', $bug['Bug']['id']), array('title'=>__('Delete'),'escape'=>false), __('Are you sure you want to delete # %s?', $bug['Bug']['id'])); ?>
            <?php endif; ?>
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
    <?=$this->element('side.bugs');?>
</div>