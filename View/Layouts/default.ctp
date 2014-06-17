<?php
$cakeDescription = __d('cake_dev', 'BugTracker');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
        echo $this->Html->css('bootstrap');
        echo $this->Html->css('cake.generic');
        echo $this->Html->css('font-awesome');
        echo $this->Html->css('select2/select2');
        echo $this->Html->css('smoothness/jquery-ui-1.10.4.custom.min');
        echo $this->Html->css('custom');

		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
</head>
<body>
    <div id="container">
        <div id="header" class="navbar navbar-static-top" role="navigation">
            <div class="navbar-header">
                <?php echo $this->Html->link('<i class="fa fa-bug fa-2x" style="line-height: 0.5;"></i><i class="fa fa-map-marker fa-2x" style="line-height: 0.5;"></i>',
                    array('controller'=>'pages', 'action' => 'home'),
                    array('escape'=>false, 'class'=>'navbar-brand', 'style'=>'height: 0; color: #404040; text-shadow: 1px 1px darkgray, -1px -1px black;')); ?>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav"></ul>
                <ul class="nav navbar-nav navbar-right" style="margin-right: 0px;">
                    <li><?php echo $this->Html->link($this->Session->read('Auth.User.name'), array('controller' => 'users', 'action' => 'edit', $this->Session->read('Auth.User.id')), array('escape'=>false)); ?></li>
                    <li><?php echo $this->Html->link('<i style="color: darkorange;" class="fa fa-power-off fa-lg"></i> ', array('controller' => 'users', 'action' => 'logout'), array('escape'=>false)); ?></li>
                </ul>
            </div>
        </div>
        <div id="content">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
        </div>
<!--        --><?php //echo $this->element('sql_dump'); ?>
        <div id="footer">
            <?php echo $this->Html->link($this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),'#',array('escape' => false, 'class'=>'pull-right'));?>
        </div>
    </div>
    <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 85%">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <div id="loading-indicator" tabindex="-1" class="modal">
        <i class="fa fa-spinner fa-spin fa-4x"></i>
    </div>
    <?php
        echo $this->Html->script('modules/jquery_2-1-0');
        echo $this->Html->script('modules/jquery-ui-1.10.4.custom.min');
        echo $this->Html->script('modules/jquery.maskedinput');
        echo $this->Html->script('modules/select2');
        echo $this->Html->script('modules/bootstrap');
        echo $this->Html->script('modules/modernizr.custom');
        echo $this->Html->script('app/_main');
        echo $this->fetch('script');
    ?>
</body>
</html>
