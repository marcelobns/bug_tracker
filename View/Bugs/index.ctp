<div class="bugs index">
    <legend>
        <?=__('Bugs'); ?> <?php echo $this->Html->link(' <i class="fa fa-refresh refresh"></i>', array('action' => 'index'), array('escape'=>false)); ?>
        <div class="pull-right">
            <?=$this->element('form.search', array('model'=>'Bug'));?>
        </div>
    </legend>
	<table cellpadding="0" cellspacing="0" class="table-hover">
    <?php echo $this->Form->create('Bug', array('action'=>'filter', 'type'=>'GET', 'class'=>'formFilter')); ?>
        <thead>
        <tr>
			<th><?php echo __('id'); ?></th>
			<th><?php echo $this->element('filter.select', array(
                    'label' => $this->Paginator->sort('product_id'),
                    'field' => 'product',
                    'options' => @$products
                    )); ?>
            </th>
            <th><?php echo $this->element('filter.select', array(
                        'label' => $this->Paginator->sort('origin_id'),
                        'field' => 'origin',
                        'options' => @$origins
                    )); ?>
            </th>
            <th><?php echo $this->element('filter.date', array(
                    'id' => 'deadline',
                    'label' => $this->Paginator->sort('deadline'),
                    'fields' => array('deadline_begin', 'deadline_end'),
                )); ?>
            </th>
            <th><?php echo $this->element('filter.select', array(
                    'label' => $this->Paginator->sort('technician_id'),
                    'field' => 'technician',
                    'options' => @$technicians
                )); ?>
            </th>
            <th><?php echo $this->element('filter.select', array(
                    'label' => $this->Paginator->sort('situation_id'),
                    'field' => 'situation',
                    'options' => @$situations
                )); ?>
            </th>
            <th><?php echo $this->element('filter.date', array(
                    'id' => 'updated',
                    'label' => $this->Paginator->sort('updated'),
                    'fields' => array('updated_begin', 'updated_end'),
                )); ?>
            </th>
			<th class="action-add">
                <?php echo $this->Html->link('<i class="fa fa-plus-square-o"></i> '.__('New Bug'), array('action' => 'add'), array('escape'=>false)); ?>
            </th>
        </tr>
	</thead>
    <?php echo $this->Form->end(); ?>

    <?php foreach ($bugs as $bug): ?>
    <?php
        $deadline = (strtotime($bug['Bug']['deadline'])-strtotime(date('Y/m/d')))/86400;
        $deadline_color = $deadline <= 1 ? '#e32' : ($deadline <= 2 ? 'darkred' : '#333');
        $deadline_color = $bug['Situation']['progress_order'] >= 3 ? $bug['Situation']['color'] : $deadline_color;
        ?>
	<tr>
		<td><b style="color: #e32;"><?php echo h($bug['Bug']['id']); ?>&nbsp;<b></td>
		<td><?php echo h($bug['Product']['name']); ?></td>
		<td><?php echo (@$bug['Origin']['acronym'] ? '<u>'.$bug['Origin']['acronym'].'</u>'.' - ' : '').substr($bug['Origin']['name'], 0, 30); ?></td>
        <td><b style="color: <?=@$deadline_color;?>"><?php echo $bug['Bug']['deadline'] ? $this->Time->format($bug['Bug']['deadline'],'%d/%m/%Y') : ''; ?>&nbsp;</b></td>
        <td><?php echo h($bug['Technician']['username']); ?></td>
        <td style="color:<?=$bug['Situation']['color'];?>;"><?php echo h($bug['Situation']['name']); ?></td>
        <td><?php echo $this->Time->format(h($bug['Bug']['updated']),'%d/%m/%Y %H:%M'); ?>&nbsp;</td>
		<td class="actions" style="font-size: 1.2em;">
            <?php echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i>', array('controller' => 'bugs', 'action' => 'view', $bug['Bug']['id']), array('title'=>__('View'),'data-toggle'=>'modal', 'data-target'=>'#modal', 'escape'=>false)); ?>
            <?php echo $this->Html->link('<i class="fa fa-exchange fa-lg"></i>', array('controller' => 'bug_trackers', 'action' => 'add', $bug['Bug']['id']), array('title'=>__('Move'),'escape'=>false)); ?>
            <?php if($this->RenderControl->level(2)) : ?>
			<?php echo $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', array('action' => 'edit', $bug['Bug']['id']), array('title'=>__('Edit'),'escape'=>false)); ?>
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
<div class="actions">
    <?=$this->element('side.bugs');?>
</div>