<div class="bugs form col-md-9">
    <?php echo $this->Form->create('Bug'); ?>
    <fieldset>
        <legend>Nova Demanda</legend>
        <?php
        if($this->Session->read('Auth.User.requestor')){
            $origin_id = $this->Session->read('Auth.User.organization_id');
            $requestor = $this->Session->read('Auth.User.name');
            $phone = $this->Session->read('Auth.User.Organization.phone');
        }
        echo $this->Form->input('origin_id', array('value'=>@$origin_id, 'empty'=>__('Select an Item...'), 'class'=>'selectize'));
        echo $this->Form->input('requestor', array('value'=>@$requestor));
        echo $this->Form->input('phone', array('value'=>@$phone));
        echo $this->Form->input('product_id', array('empty'=>__('Select an Item...'), 'class'=>'selectize'));
        echo $this->Form->input('details', array('type'=>'text'));
        echo $this->Form->input('technician_id', array('multiple'=>true, 'label'=>__('Technician'), 'class'=>'selectize'));
        echo $this->Form->input('deadline', array('type'=>'text', 'class'=>'date_picker'));
        echo $this->Form->hidden('BugTrack.situation_id', array('value'=>$situation_open));
        ?>
        <?php echo $this->Form->button(__('Submit'), array('type'=>'submit', 'class'=>'btn btn-success')); ?>
        <?php echo $this->Html->link(__('Cancel'), array('action'=>'index'), array('class'=>'btn btn-default')); ?>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions col-md-3">
    <?php echo $this->Element('side.bugs');?>
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
            Normalize.date();
        });
    }
    $('#BugProductId, #BugTechnicianId').on('change', function(){
        getDeadline();
    });
</script>
<?php $this->end(); ?>
