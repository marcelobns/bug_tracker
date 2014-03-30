<?php
$cakeDescription = __d('cake_dev', 'Tracker');
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

        echo $this->Html->css('select2/select2');
		echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('font-awesome');
		echo $this->Html->css('smoothness/jquery-ui-1.10.4.custom.min');
		echo $this->Html->css('custom');

		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
</head>
<body>
    <div id="header">
        <?php echo $this->Html->link('<i class="fa fa-bug fa-3x"></i><i class="fa fa-map-marker fa-3x"></i>', array('controller' => 'pages', 'action' => 'home'), array('escape'=>false, 'style'=>'color: #001f2d; text-shadow: 1px 1px #00586e, -1px -1px #001219;')); ?>
        <div class="pull-right" style="margin-top: 10px; margin-right: 10px;">
            <?php echo $this->Html->link($this->Session->read('Auth.User.name'), array('controller' => 'users', 'action' => 'edit', $this->Session->read('Auth.User.id')), array('escape'=>false)); ?>
            <?php echo $this->Html->link('<i class="fa fa-power-off fa-lg"></i> ', array('controller' => 'users', 'action' => 'logout'), array('escape'=>false)); ?>
        </div>
    </div>
    <div id="content">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
    </div>
    <?php echo $this->element('sql_dump'); ?>
    <div id="footer">
        <?php echo $this->Html->link($this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),'#',array('escape' => false, 'class'=>'pull-right'));?>
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
        echo $this->Html->script('jquery_2-1-0');
        echo $this->Html->script('jquery-ui-1.10.4.custom.min');
        echo $this->Html->script('jquery.maskedinput');
        echo $this->Html->script('select2');
        echo $this->Html->script('bootstrap');
        echo $this->Html->script('modernizr.custom');
        echo $this->Html->script('default');
        echo $this->fetch('script');
    ?>
</body>
</html>
