<div class="users index">
    <legend>
        <?php echo __('Users'); ?>
        <?=$this->element('form.search', array('model'=>'User'));?>
    </legend>
    <table>
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('name'); ?></th>
            <th><?php echo $this->Paginator->sort('role_id'); ?></th>
            <th><?php echo $this->Paginator->sort('organization_id'); ?></th>
            <th><?php echo $this->Paginator->sort('last_signin'); ?></th>
            <th class="actions">
                <?php echo $this->Html->link(__('New User'), array('action' => 'add'), array('escape'=>false)); ?>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo h($user['User']['id']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['name']); ?>&nbsp;</td>
                <td><?php echo h($user['Role']['name']); ?></td>
                <td><?php echo h($user['Organization']['name']); ?></td>
                <td><?php echo h($user['User']['last_signin']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i>', array('action' => 'view', $user['User']['id']), array('escape'=>false)); ?>
                    <?php echo $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', array('action' => 'edit', $user['User']['id']), array('escape'=>false)); ?>
                    <?php echo $this->Html->link('<i class="fa fa-minus-square-o fa-lg"></i>', array('action' => 'reset', $user['User']['id']), array('escape'=>false)); ?>
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