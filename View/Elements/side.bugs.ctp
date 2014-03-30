<h3><?php echo __('Actions'); ?></h3>
<ul>
    <li>
        <?php echo $this->Form->create('Bug', array('action'=>'index', 'type'=>'GET')); ?>
        <div class="input-group">
            <input autofocus="autofocus" name="q" type="text" class="input-search" placeholder="<?=__('Search');?>" required="required" value="<?=isset($_GET['q'])?$_GET['q']:null;?>">
            <div class="input-group-btn">
                <button class="btn-search" type="submit"><i class="fa fa-search fa-lg"></i></button>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </li>
    <li><?php echo $this->Html->link('<i class="fa fa-bug fa-lg pull-right"></i> '.__('List Bugs'), array('controller' => 'bugs', 'action' => 'index'), array('escape'=>false)); ?> </li>
    <li><?php echo $this->Html->link('<i class="fa fa-rocket fa-lg pull-right"></i> '.__('List Products'), array('controller' => 'products', 'action' => 'index'), array('escape'=>false)); ?> </li>
    <li><?php echo $this->Html->link('<i class="fa fa-building-o fa-lg pull-right"></i> '.__('List Organizations'), array('controller' => 'organizations', 'action' => 'index'), array('escape'=>false)); ?> </li>
    <li><?php echo $this->Html->link('<i class="fa fa-map-marker fa-lg pull-right"></i> '.__('List Location Groups'), array('controller' => 'location_groups', 'action' => 'index'), array('escape'=>false)); ?> </li>
    <?php if($this->RenderControl->level(1)) : ?>
        <li><?php echo $this->Html->link(__('List Situations'), array('controller' => 'situations', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('List Priorities'), array('controller' => 'priorities', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
    <?php endif; ?>
</ul>