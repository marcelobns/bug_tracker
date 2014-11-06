<?php echo $this->Html->link(' <i class="fa fa-refresh refresh"></i>', array('action' => 'index'), array('escape'=>false)); ?>
<div class="pull-right">
    <?php echo $this->Form->create(@$model, array('action'=>'index/'.@$url_params, 'type'=>'GET', 'class'=>'form-inline', 'div'=>false)); ?>
    <div class="col-md-12">
        <div class="input-group">
            <input type="text" class="form-control" name="q" placeholder="Localizar" required="required" value="<?=@$_GET['q'];?>">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">
                    <i class="fa fa-search fa-lg"></i>
                </button>
            </span>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
