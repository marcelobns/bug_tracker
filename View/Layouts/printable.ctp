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
    echo $this->Html->css('cake.generic');
    echo $this->Html->css('bootstrap');
    echo $this->Html->css('font-awesome');
    echo $this->Html->css('custom');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    ?>
</head>
<body>
<div id="content" class="container">
    <?php echo $this->fetch('content'); ?>
</div>
<?php echo $this->fetch('script');?>
</body>
</html>
