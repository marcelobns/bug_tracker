<div class="bugs index no-table">
    <legend class="row">
        <?=__('Bugs'); ?>
        <?=$this->element('form.search', array('model'=>'Bug'));?>
    </legend>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Origem</th>
            <th>Produto</th>
            <th>Prazo</th>
            <th>Técnico</th>
            <th>Situação</th>
            <th class="actions">
                <?php echo $this->Html->link('Nova Demanda', array('action' => 'add')); ?>
            </th>
        </tr>
        </thead>
        <?php foreach ($bugs as $bug): ?>
            <?php
            $deadline = (strtotime($bug['Bug']['deadline'])-strtotime(date('Y/m/d')))/86400;
            $deadline_color = $deadline <= 1 ? 'text-danger' : ($deadline <= 2 ? 'text-warning' : '');
            ?>
            <tr>
                <td class="text-primary"><?php echo h($bug['Bug']['id']); ?></td>
                <td><b><?php echo (@$bug['Origin']['acronym'] ? '<u>'.$bug['Origin']['acronym'].'</u>'.' - ' : '').substr($bug['Origin']['name'], 0, 38); ?></b></td>
                <td><?php echo h($bug['Product']['name']); ?></td>
                <td class="<?=@$deadline_color;?>"><?php echo $bug['Bug']['deadline'] ? $this->Time->format($bug['Bug']['deadline'],'%d/%m/%Y') : ''; ?>&nbsp;</td>
                <td><?php echo h($bug['Technician']['username']); ?></td>
                <td style="color:<?=$bug['Situation']['color'];?>;"><strong><?php echo h($bug['Situation']['name']); ?></strong></td>
                <td class="actions">
                    <?php echo $this->Html->link('<i class="fa fa-file-text-o fa-lg"></i>', array('controller' => 'bugs', 'action' => 'view', $bug['Bug']['id']), array('title'=>__('View'),'data-toggle'=>'modal', 'data-target'=>'#modal', 'escape'=>false)); ?>
                    <?php echo $this->Html->link('<i class="fa fa-exchange fa-lg"></i>', array('controller' => 'bug_tracks', 'action' => 'add', $bug['Bug']['id']), array('title'=>__('Move'),'escape'=>false)); ?>
                    <?php if($this->RenderControl->level(2)) : ?>
                        <?php echo $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', array('action' => 'edit', $bug['Bug']['id']), array('title'=>__('Edit'),'escape'=>false)); ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p><?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>
    </p>
    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>
<script>
//reload 4min
setInterval(function(){
    window.location = window.location.href
}, 240000);
</script>
