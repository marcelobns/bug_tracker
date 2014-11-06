<h4>Relacionado</h4>
<ul class="nav nav-pills nav-stacked" role="tablist">
    <li><?php echo $this->Html->link('<i class="fa fa-bug fa-lg pull-right"></i> '.__('List Bugs'), array('controller' => 'bugs', 'action' => 'index'), array('escape'=>false)); ?> </li>
    <li><?php echo $this->Html->link('<i class="fa fa-rocket fa-lg pull-right"></i> '.__('List Products'), array('controller' => 'products', 'action' => 'index'), array('escape'=>false)); ?> </li>
    <li><?php echo $this->Html->link('<i class="fa fa-sitemap fa-lg pull-right"></i> '.__('List Organizations'), array('controller' => 'organizations', 'action' => 'index'), array('escape'=>false)); ?> </li>
    <?php if($this->RenderControl->level(1)) : ?>
        <li><?php echo $this->Html->link('<i class="fa fa-puzzle-piece fa-lg pull-right"></i>'.__('List Situations'), array('controller' => 'situations', 'action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-users fa-lg pull-right"></i>'.__('List Users'), array('controller'=>'users', 'action' => 'index'), array('escape'=>false)); ?></li>
    <?php endif; ?>
</ul>