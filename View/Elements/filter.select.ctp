<div id="<?=$field?>Filter" class="btn-group">
    <button type="button" class="btn btn-link"><?=$label;?></button>
    <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
        &nbsp;<span style="font-size: 0.9em;" class="fa fa-filter"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li style="padding-left: 7px">
            <button style="background-color:#E4E4E4" class="Apply btn btn-default btn-xs">
                <i class="fa fa-check-square-o"></i> <b><?=__('Apply');?></b>
            </button>
            <button id="<?=$field?>Clear" style="background-color:#E4E4E4" class="btn btn-default btn-xs">
                <i class="fa fa-minus-square-o"></i> <b><?=__('Clear');?></b>
            </button>
        </li>
        <li>
            <?php echo $this->Form->input($field, array('type'=>'select', 'options'=>$options,'class'=>'select2-open', 'multiple'=>true, 'label'=>false)); ?>
        </li>
    </ul>
</div>
<?php $this->start('script'); ?>
<script type="text/javascript">
    //TODO: Generalizar e escrever somente uma vez
    $('#<?=$field?>Filter').on('shown.bs.dropdown', function (e) {
        $('#<?=$field?>Filter .select2-search-field input').focus();
    });
    $('#<?=$field?>Filter').on('hide.bs.dropdown', function (e) {
        $("#<?=$field?>Filter .select2-open").select2("close");
    });
    $('#<?=$field?>Clear').on('click', function (e) {
        $('.btn-group').hasClass('open');
        $("#<?=$field?>Filter :input").val('');
        if($('.formFilter').data('changed'))
            $('.formFilter').submit();
    });
</script>
<?php $this->end(); ?>