<div class="bugTrackers form col-md-9">
    <?php echo $this->Form->create('BugTracker'); ?>
    <fieldset>
        <legend>Novo Rastro para <?=$this->request->data['Bug']['id'];?></legend>
        <?php echo $this->Form->hidden('bug_id', array('value'=>$this->request->data['Bug']['id'])); ?>
        <dl>
            <dt><?php echo __('Created'); ?></dt>
            <dd>
                <?php echo date('d/m/Y H:i:s', strtotime($this->request->data['Bug']['created'])); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Origin'); ?></dt>
            <dd>
                <?php echo h($this->request->data['Origin']['name']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Requestor'); ?></dt>
            <dd>
                <?php echo h($this->request->data['Bug']['requestor']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Phone'); ?></dt>
            <dd>
                <?php echo h($this->request->data['Bug']['phone']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Product'); ?></dt>
            <dd>
                <?php echo h($this->request->data['Product']['name']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Details'); ?></dt>
            <dd>
                <?php echo h($this->request->data['Bug']['details']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Deadline'); ?></dt>
            <dd style="color: darkred;">
                <?php if($this->request->data['Bug']['deadline']) echo date('d/m/Y', strtotime($this->request->data['Bug']['deadline'])); ?>
                &nbsp;
            </dd>
            <dt>Situação Atual</dt>
            <dd style="color:<?=$this->request->data['Situation']['color'];?>">
                <?php echo h($this->request->data['Situation']['name']); ?>
                &nbsp;
            </dd>
        </dl>
        <?php
        if($this->request->data['Situation']['deadline_edit'] && $this->RenderControl->level(2))
            echo $this->Form->input('Bug.deadline', array('type'=>'text', 'class'=>'date', 'label'=>__('New Deadline'))); ?>
        <?php echo $this->Form->input('situation_id', array('value'=>$next_situation_id, 'label'=>__('Next Situation'))); ?>
        <?php echo $this->Form->input('details', array('type'=>'text')); ?>
        <a id="btn_change" class="help-block"><?=__('Change target');?> <i class="caret"></i></a>
        <section id="change_target" hidden="hidden">
            <?php echo $this->Form->input('organization_id', array('value'=>$this->request->data['Product']['organization_id'])); ?>
        </section>
        <?php $technician_id = $this->request->data['BugTracker']['technician_id'][0] ? $this->request->data['BugTracker']['technician_id'] : $this->Session->read('Auth.User.id'); ?>
        <?php echo $this->Form->input('technician_id', array('multiple'=>true, 'label'=>__('Technician'), 'value'=>$technician_id)); ?>
        <?php echo $this->Form->button(__('Submit'), array('type'=>'submit', 'class'=>'btn btn-success')); ?>
        <?php echo $this->Html->link(__('Cancel'), array('controller'=>'bugs', 'action'=>'index'), array('class'=>'btn btn-default')); ?>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions col-md-3">
    <h4>Relacionado</h4>
    <ul class="nav nav-pills nav-stacked" role="tablist">
        <li><?php echo $this->Html->link('<i class="fa fa-file fa-lg pull-right"></i> '.'Incluir Organização', array('controller' => 'organizations', 'action' => 'add'), array('target'=>'_blank', 'escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-sitemap fa-lg pull-right"></i> '.__('List Organizations'), array('controller' => 'organizations', 'action' => 'index'), array('target'=>'_blank', 'escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-rocket fa-lg pull-right"></i> '.'Incluir Produto', array('controller' => 'products', 'action' => 'add'), array('target'=>'_blank', 'escape'=>false)); ?> </li>
        <?php if($this->RenderControl->level(1)) : ?>
            <li><?php echo $this->Html->link('<i class="fa fa-users fa-lg pull-right"></i>'.'Incluir Técnico', array('controller'=>'users', 'action' => 'add'), array('target'=>'_blank', 'escape'=>false)); ?> </li>
        <?php endif; ?>

    </ul>
</div>
<?php $this->start('script'); ?>
<script type="text/javascript">
    $('#btn_change').on('click', function(){
        $('#change_target').slideToggle(600);
    });
</script>
<?php $this->end(); ?>
