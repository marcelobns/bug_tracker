<?php
$cakeDescription = __d('cake_dev', 'Demandas');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>:
		<?php echo $cakeDescription ?>
	</title>
	<?php
	echo $this->Html->meta('icon');
	echo $this->Html->css('modules/jquery-ui/jquery-ui');
	echo $this->Html->css('modules/font-awesome');
	echo $this->Html->css('build');
	echo $this->Html->css('custom');

	echo $this->fetch('meta');
	echo $this->fetch('css');
	?>
</head>
<body>
	<header class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-header">
			<?php echo $this->Html->link($title_for_layout,
			array('action' => 'index'),
			array('escape'=>false, 'class'=>'navbar-brand', 'style'=>'color: #444;')); ?>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" style="color: #444;">
				<i class="fa fa-bug fa-lg"></i><i class="fa fa-map-marker fa-lg"></i>
			</button>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><?php echo $this->Html->link('Demandas',
				array('controller'=>'bugs', 'action' => 'index')); ?></li>
				<li><?php echo $this->Html->link('Organizações',
				array('controller'=>'organizations', 'action' => 'index')); ?></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Relatórios<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><?php echo $this->Html->link('Produção por Técnico',
						array('controller'=>'bugs', 'action' => 'producao_tecnico')); ?></li>
						<li><?php echo $this->Html->link('Resumo de Demandas',
						array('controller'=>'bugs', 'action' => 'resumo_demanda')); ?></li>
						<li><?php echo $this->Html->link('Resumo por Organização',
						array('controller'=>'bugs', 'action' => 'resumo_organizacao')); ?></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Mais... <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><?php echo $this->Html->link('Produtos',
						array('controller'=>'products', 'action' => 'index')); ?></li>
						<li><?php echo $this->Html->link('Situações',
						array('controller'=>'situations', 'action' => 'index')); ?></li>
						<li><?php echo $this->Html->link('Usuários',
						array('controller'=>'users', 'action' => 'index')); ?></li>
						<li><?php echo $this->Html->link('Perfis',
						array('controller'=>'roles', 'action' => 'index')); ?></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right" style="margin-right: 0px;">
				<li><?php echo $this->Html->link($this->Session->read('Auth.User.name'), array('controller' => 'users', 'action' => 'edit', $this->Session->read('Auth.User.id')), array('escape'=>false)); ?></li>
				<li><?php echo $this->Html->link('<i style="color: darkorange;" class="fa fa-power-off fa-lg"></i> ', array('controller' => 'users', 'action' => 'logout'), array('escape'=>false)); ?></li>
			</ul>
		</div>
	</header>
	<main class="container">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
		<!-- <?php echo $this->element('sql_dump'); ?> -->
	</main>
	<footer class="no-print">
		<?php echo $this->Html->link($this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),'#',array('escape' => false, 'class'=>'pull-right'));?>
	</footer>
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
	// echo $this->Html->script('http://localhost:35729/livereload.js');

	echo $this->Html->script('modules/jquery-1.11.1.min');
	echo $this->Html->script('modules/jquery-ui.js');
	echo $this->Html->script('modules/bootstrap.min');
	echo $this->Html->script('modules/selectize');
	echo $this->Html->script('custom');
	echo $this->fetch('script');
	?>
</body>
</html>
