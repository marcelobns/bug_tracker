<div class="bugs index">
    <legend>
        <?=__('Bugs'); ?>
        <?=$this->element('form.search', array('model'=>'Bug'));?>
    </legend>
    <table>
        <thead>
        <tr>
            <?php echo $this->Form->create('Bug', array('action'=>'filter', 'type'=>'GET')); ?>
            <th>#</th>
            <th><?php echo $this->element('filter.select', array(
                    'label' => __('Product'),
                    'field' => 'product',
                    'options' => @$products
                )); ?>
            </th>
            <th><?php echo $this->element('filter.select', array(
                    'label' => __('Origin'),
                    'field' => 'origin',
                    'options' => @$origins
                )); ?>
            </th>
            <th><?php echo $this->element('filter.date', array(
                    'id' => 'deadline',
                    'label' => __('Deadline'),
                    'fields' => array('deadline_begin', 'deadline_end'),
                )); ?>
            </th>
            <th><?php echo $this->element('filter.select', array(
                    'label' => __('Technician'),
                    'field' => 'technician',
                    'options' => @$technicians
                )); ?>
            </th>
            <th><?php echo $this->element('filter.select', array(
                    'label' => __('Situation'),
                    'field' => 'situation',
                    'options' => @$situations
                )); ?>
            </th>
            <th><?php echo $this->element('filter.date', array(
                    'id' => 'updated',
                    'label' => __('Updated'),
                    'fields' => array('updated_begin', 'updated_end'),
                )); ?>
            </th>
            <th class="actions">
                <?php echo $this->Html->link(__('New Bug'), array('action' => 'add'), array('escape'=>false)); ?>
            </th>
            <?php echo $this->Form->end(); ?>
        </tr>
        </thead>
        <?php foreach ($bugs as $bug): ?>
            <?php
            $deadline = (strtotime($bug['Bug']['deadline'])-strtotime(date('Y/m/d')))/86400;
            $deadline_color = $deadline <= 1 ? 'text-danger' : ($deadline <= 2 ? 'text-warning' : '#333');
            $deadline_color = $bug['Situation']['progress_order'] >= 3 ? $bug['Situation']['color'] : $deadline_color;
            ?>
            <tr>
                <td><b><?php echo h($bug['Bug']['id']); ?>&nbsp;<b></td>
                <td><?php echo h($bug['Product']['name']); ?></td>
                <td><?php echo (@$bug['Origin']['acronym'] ? '<u>'.$bug['Origin']['acronym'].'</u>'.' - ' : '').substr($bug['Origin']['name'], 0, 30); ?></td>
                <td class="<?=@$deadline_color;?>"><?php echo $bug['Bug']['deadline'] ? $this->Time->format($bug['Bug']['deadline'],'%d/%m/%Y') : ''; ?>&nbsp;</b></td>
                <td><?php echo h($bug['Technician']['username']); ?></td>
                <td class="color:<?=$bug['Situation']['color'];?>;"><?php echo h($bug['Situation']['name']); ?></td>
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