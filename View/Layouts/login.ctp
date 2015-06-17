<?php
$cakeDescription = __d('cake_dev', 'Login');
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $cakeDescription ?>:
        BugTracker
    </title>
    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('modules/font-awesome');
    echo $this->Html->css('build');
    echo $this->Html->css('custom');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    ?>
</head>
<body>
<div class="container">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->fetch('content'); ?>
</div>
<?php
    echo $this->Html->script('http://localhost:35729/livereload.js');

    echo $this->Html->script('modules/jquery-1.11.1.min');
    echo $this->Html->script('modules/jquery-ui.js');
    echo $this->Html->script('modules/bootstrap.min');
    echo $this->Html->script('modules/selectize');
    echo $this->Html->script('custom');
    echo $this->fetch('script');
?>
</body>
</html>
