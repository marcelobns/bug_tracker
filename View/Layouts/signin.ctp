<?php
$cakeDescription = __d('cake_dev', 'Sign in');
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
    echo $this->Html->css('cake.generic');
    echo $this->Html->css('bootstrap');
    echo $this->Html->css('font-awesome');
    echo $this->Html->css('custom');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    ?>
</head>
<body style="background-color: #f5f5f5; font-size: 0.8em;">
<div id="container">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->fetch('content'); ?>
</div>
<?php
    echo $this->Html->script('modules/jquery_2-1-0');
    echo $this->fetch('script');
?>
</body>
</html>