<div class="index">
    <div class="row">
        <div id="chart1" class="col-lg-6">CHART</div>
        <div id="table1" class="col-lg-4">DATA</div>
    </div>
    <div class="row">
        <div id="chart2" class="col-lg-10">EVOLUTION</div>
    </div>
</div>
<div class="actions">
    <ul>
        <li><?php echo $this->Html->link('<i class="fa fa-plus fa-lg pull-right"></i> '.__('New Bug'), array('controller' => 'bugs', 'action' => 'add'), array('escape'=>false)); ?></li>
        <li><?php echo $this->Html->link('<i class="fa fa-bug fa-lg pull-right"></i> '.__('List Bugs'), array('controller' => 'bugs', 'action' => 'index'), array('escape'=>false)); ?></li>
        <li><?php echo $this->Html->link('<i class="fa fa-building-o fa-lg pull-right"></i> '.__('List Organizations'), array('controller' => 'organizations', 'action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-map-marker fa-lg pull-right"></i> '.__('List Location Groups'), array('controller' => 'location_groups', 'action' => 'index'), array('escape'=>false)); ?> </li>
        <?php if($this->RenderControl->level(2)) : ?>
        <li><?php echo $this->Html->link('<i class="fa fa-user fa-lg pull-right"></i> '.__('New User'), array('controller'=>'users','action' => 'add'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-users fa-lg pull-right"></i> '.__('List Users'), array('controller'=>'users','action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-puzzle-piece fa-lg pull-right"></i> '.__('List Situations'), array('controller' => 'situations', 'action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-sort-amount-asc fa-lg pull-right"></i> '.__('List Priorities'), array('controller' => 'priorities', 'action' => 'index'), array('escape'=>false)); ?> </li>
        <?php endif; ?>
    </ul>
</div>