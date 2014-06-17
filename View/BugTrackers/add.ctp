<div class="bugTrackers form">
<?php echo $this->Form->create('BugTracker'); ?>
	<fieldset>
	<?php echo $this->Form->input('bug_id', array('type'=>'text', 'label'=>false, 'value'=>$this->request->data['Bug']['id'], 'hidden')); ?>
        <dl style="margin-top: -25px;">
            <dt><?php echo __('Id'); ?></dt>
            <dd style="color: #e32;">
                <?php echo h($this->request->data['Bug']['id']); ?>
                &nbsp;
            </dd>
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
            <dt><?php echo __('Situation'); ?></dt>
            <dd style="color:<?=$this->request->data['Situation']['color'];?>">
                <?php echo h($this->request->data['Situation']['name']); ?>
                &nbsp;
            </dd>
        </dl>
        <?php
            if($this->request->data['Situation']['deadline_edit'] && $this->RenderControl->level(2))
                echo $this->Form->input('Bug.deadline', array('type'=>'text', 'class'=>'date', 'label'=>__('New Deadline'))); ?>
        <?php echo $this->Form->input('situation_id', array('class'=>'select2', 'value'=>$next_situation_id, 'label'=>__('Next Situation'))); ?>
        <?php echo $this->Form->input('details'); ?>
        <a id="btn_change" class="help-block"><?=__('Change target');?> <i class="caret"></i></a>
        <section id="change_target" hidden="hidden">
        <?php echo $this->Form->input('organization_id', array('class'=>'select2', 'value'=>$this->request->data['Product']['organization_id'])); ?>
        </section>
        <?php $technician_id = $this->request->data['BugTracker']['technician_id'][0] ? $this->request->data['BugTracker']['technician_id'] : $this->Session->read('Auth.User.id'); ?>
        <?php echo $this->Form->input('technician_id', array('multiple'=>true,'label'=>__('Technician'),'class'=>'select2', 'value'=>$technician_id)); ?>
        <?php echo $this->Form->button(__('Submit'), array('type'=>'submit', 'class'=>'btn btn-success')); ?>
        <?php echo $this->Html->link(__('Cancel'), array('controller'=>'bugs', 'action'=>'index'), array('class'=>'btn btn-default')); ?>
	</fieldset>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <?=$this->element('side.bugs');?>
</div>
<?php $this->start('script'); ?>
<script type="text/javascript">
    $('#btn_change').on('click', function(){
        $('#change_target').slideToggle(600);
    });
</script>
<?php $this->end(); ?>
