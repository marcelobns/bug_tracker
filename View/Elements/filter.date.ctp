<div id="<?=$fields[0];?>Filter" class="date-filter btn-group">
    <button type="button" class="btn btn-link"><?=$label;?></button>
    <button type="button" class="btn btn-link dropdown-toggle sr-only" data-toggle="dropdown">
        &nbsp;<span style="font-size: 0.9em" class="fa fa-filter"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li style="padding-left: 7px">
            <button style="background-color:#E4E4E4" class="Apply btn btn-default btn-xs">
                <i class="fa fa-check-square-o"></i> <b><?=__('Apply');?></b>
            </button>
            <button id="<?=$fields[0]?>Clear" style="background-color:#E4E4E4" class="btn btn-default btn-xs">
                <i class="fa fa-minus-square-o"></i> <b><?=__('Clear');?></b>
            </button>
        </li>
        <li class="filter-date">
            <label><?=__('Begin')?></label>
            <?php echo $this->Form->input($fields[0], array('label'=>false,'class'=>'date filter-normalized'));?>
            <label><?=__('End')?></label>
            <?php echo $this->Form->input($fields[1], array('label'=>false,'class'=>'date filter-normalized'));?>
        </li>
    </ul>
</div>
<?php $this->start('script');?>
<script type="text/javascript">
    $('#<?=$fields[0]?>Clear').on('click', function (e) {
        $('.btn-group').hasClass('open');
        $("#<?=$fields[0]?>Filter :input").val('');
        if($('.formFilter').data('changed'))
            $('.formFilter').submit();
    });
</script>
<?php $this->end(); ?>