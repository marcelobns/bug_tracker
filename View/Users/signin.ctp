<div style="width: 300px; margin: auto;">
        <?php echo $this->Form->create('User', array('url'=>array('action'=>'signin'))); ?>
        <fieldset>
            <legend>
                <?=__('Bugs');?>
            </legend>
            <?php echo $this->Form->input('username', array('class'=>'form-control', 'placeholder'=>__('Username'), 'autofocus'=>true, 'label'=>false)); ?>
            <?php echo $this->Form->input('password', array('type'=>'password', 'class'=>'form-control', 'placeholder'=>__('Password'), 'label'=>false)); ?>
            <?php echo $this->Form->button(__('Enter'), array('type'=>'submit', 'class'=>'btn btn-primary btn-block')); ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>
</div>