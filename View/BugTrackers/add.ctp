<div class="bugTrackers form">
<?php echo $this->Form->create('BugTracker'); ?>
	<fieldset>
	<?php echo $this->Form->input('bug_id', array('type'=>'text', 'label'=>false, 'value'=>$bug['Bug']['id'], 'hidden')); ?>
        <dl style="margin-top: -25px;">
            <dt><?php echo __('Id'); ?></dt>
            <dd style="color: #e32;">
                <?php echo h($bug['Bug']['id']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Reporter'); ?></dt>
            <dd>
                <?php echo h($bug['Bug']['reporter']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Phone'); ?></dt>
            <dd>
                <?php echo h($bug['Bug']['phone']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Details'); ?></dt>
            <dd>
                <?php echo h($bug['Bug']['details']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Product'); ?></dt>
            <dd>
                <?php echo h($bug['Product']['name']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Situation'); ?></dt>
            <dd>
                <?php echo h($bug['Situation']['name']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Location Group'); ?></dt>
            <dd>
                <?php echo h($bug['LocationGroup']['name']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Location'); ?></dt>
            <dd>
                <?php echo h($bug['Bug']['location']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Created'); ?></dt>
            <dd>
                <?php echo h($bug['Bug']['created']); ?>
                &nbsp;
            </dd>
            <dt></dt>
            <dd>
                &nbsp;
            </dd>
        </dl>
    <?php echo $this->Form->input('situation_id', array('class'=>'select2', 'value'=>$next_track)); ?>
    <?php echo $this->Form->input('details'); ?>
        <a id="btn_change" class="help-block"><?=__('Change target');?> <i class="caret"></i></a>
        <section id="change_target" hidden="hidden">
        <?php echo $this->Form->input('organization_id', array('class'=>'select2', 'value'=>$bug['Product']['organization_id'])); ?>
        </section>
    <?php echo $this->Form->input('technician_id', array('multiple'=>true,'label'=>__('Technician'),'class'=>'select2','empty'=>__('Select...'), 'value'=>$this->Session->read('Auth.User.id'))); ?>
	</fieldset>
    <?php echo $this->Form->button(__('Submit'), array('type'=>'submit', 'class'=>'btn btn-success btn-lg')); ?>
    <?php echo $this->Html->link(__('Cancel'), $this->request->referer(), array('class'=>'btn btn-default btn-lg')); ?>

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
