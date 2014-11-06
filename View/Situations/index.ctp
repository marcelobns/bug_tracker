<div class="situations index">
    <legend>Situações</legend>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('name'); ?></th>
            <th><?php echo $this->Paginator->sort('role_id'); ?></th>
            <th><?php echo $this->Paginator->sort('sort'); ?></th>
            <th class="actions">
                <?php echo $this->Html->link(__('New Situation'), array('action' => 'add')); ?>
            </th>
        </tr>
        </thead>
        <?php foreach ($situations as $situation): ?>
        <tbody>
        <tr>
            <td><?php echo h($situation['Situation']['id']); ?>&nbsp;</td>
            <td><?php echo h($situation['Situation']['name']); ?>&nbsp;</td>
            <td>
                <?php echo $this->Html->link($situation['Role']['name'], array('controller' => 'roles', 'action' => 'view', $situation['Role']['id'])); ?>
            </td>
            <td><?php echo h($situation['Situation']['sort']); ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->link(__('View'), array('action' => 'view', $situation['Situation']['id'])); ?>
                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $situation['Situation']['id'])); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $situation['Situation']['id']), null, __('Are you sure you want to delete # %s?', $situation['Situation']['id'])); ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
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