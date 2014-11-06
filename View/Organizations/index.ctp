<div class="organizations index">
    <legend>
        <?php echo __('Organizations'); ?>
        <?=$this->element('form.search', array('model'=>'Organization'));?>
    </legend>
    <table class="table table-condensed table-hover">
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('name'); ?></th>
            <th><?php echo $this->Paginator->sort('parent_id'); ?></th>
            <th class="actions">
                <?php echo $this->Html->link(__('New Organization'), array('action' => 'add'), array('escape'=>false)); ?>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($organizations as $organization): ?>
            <tr>
                <td><?php echo h($organization['Organization']['id']); ?>&nbsp;</td>
                <td><?php echo h($organization['Organization']['name']); ?>&nbsp;</td>
                <td><?php echo h($organization['ParentOrganization']['name']); ?></td>
                <td class="actions">
                    <?php echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i>', array('action' => 'view', $organization['Organization']['id']), array('escape'=>false)); ?>
                    <?php echo $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', array('action' => 'edit', $organization['Organization']['id']), array('escape'=>false)); ?>
                    <?php echo $this->Form->postLink('<i class="fa fa-trash-o fa-lg"></i>', array('action' => 'delete', $organization['Organization']['id']), array('escape'=>false), __('Are you sure you want to delete # %s?', $organization['Organization']['id'])); ?>
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