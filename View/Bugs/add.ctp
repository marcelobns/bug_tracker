<div class="bugs form">
    <?php echo $this->Form->create('Bug'); ?>
    <fieldset>
        <legend><?php echo __('Add Bug'); ?></legend>
        <?php
        if($this->Session->read('Auth.User.requestor')){
            $origin_id = $this->Session->read('Auth.User.organization_id');
            $requestor = $this->Session->read('Auth.User.name');
            $phone = $this->Session->read('Auth.User.Organization.phone');
        }
        echo $this->Form->input('origin_id', array('value'=>@$origin_id, 'class'=>'select2', 'empty'=>__('Select an Item...')));
        echo $this->Form->input('requestor', array('value'=>@$requestor));
        echo $this->Form->input('phone', array('value'=>@$phone));
        echo $this->Form->input('product_id', array('class'=>'select2', 'empty'=>__('Select an Item...')));
        echo $this->Form->input('details');
        echo $this->Form->input('technician_id', array('multiple'=>true,'label'=>__('Technician'),'class'=>'select2'));
        echo $this->Form->input('deadline', array('type'=>'text', 'class'=>'date'));
        echo $this->Form->input('BugTracker.situation_id', array('hidden', 'label'=>false));
        ?>
        <?php echo $this->Form->button(__('Submit'), array('type'=>'submit', 'class'=>'btn btn-success')); ?>
        <?php echo $this->Html->link(__('Cancel'), array('action'=>'index'), array('class'=>'btn btn-default')); ?>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <?=$this->element('side.bugs');?>
</div>
<?php $this->start('script'); ?>
<script type="text/javascript">
    function getDeadline(){
        var product_id = $("#BugProductId").val();
        var technician_array = $("#BugTechnicianId").val();
        if(product_id != '')
        $.ajax({
            url: '<?php echo Router::url(array('controller' => 'products', 'action' => 'deadline')); ?>'+'/'+product_id+'/'+technician_array
        }).done(function(r){
            $('#BugDeadline').val(JSON.parse(r));
            if(!Modernizr.inputtypes.date){
                if($('input[type=date]').val() != undefined){
                    var dt = $('input[type=date]').val().split('-');
                    $('input[type=date]').val(dt[2]+'/'+dt[1]+'/'+dt[0])
                }
            }
        });
    }
    $('#BugProductId, #BugTechnicianId').on('change', function(){
        getDeadline();
    });
</script>
<?php $this->end(); ?>