<h4>Relacionado</h4>
<ul class="nav nav-pills nav-stacked" role="tablist">
    <li><?php echo $this->Html->link('<i class="fa fa-file fa-lg pull-right"></i> '.'Incluir Organização', array('controller' => 'organizations', 'action' => 'add'), array('target'=>'_blank', 'escape'=>false)); ?> </li>
    <li><?php echo $this->Html->link('<i class="fa fa-sitemap fa-lg pull-right"></i> '.__('List Organizations'), array('controller' => 'organizations', 'action' => 'index'), array('target'=>'_blank', 'escape'=>false)); ?> </li>
    <li><?php echo $this->Html->link('<i class="fa fa-rocket fa-lg pull-right"></i> '.'Incluir Produto', array('controller' => 'products', 'action' => 'add'), array('target'=>'_blank', 'escape'=>false)); ?> </li>
    <?php if($this->RenderControl->level(1)) : ?>
        <li><?php echo $this->Html->link('<i class="fa fa-users fa-lg pull-right"></i>'.'Incluir Técnico', array('controller'=>'users', 'action' => 'add'), array('target'=>'_blank', 'escape'=>false)); ?> </li>
    <?php endif; ?>
</ul>