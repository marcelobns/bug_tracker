<div class="container">
    <div id="content">
        <div class="form-signin">
            <div class="signin-top"></div>
            <div class="signin-inputs">
                <span style="
                        color: #868686;
                        text-shadow: 1px 1px #b9b9b9,
                                    -1px -1px #696969;
                        float: right;
                        margin-top: -60px;
                        margin-right: 15px; opacity: 0.7" >
                    <i class="fa fa-bug fa-3x"></i>
                    <i class="fa fa-map-marker fa-3x"></i>
                </span>
                <?php echo $this->Form->create('User', array('url'=>array('action'=>'signin'))); ?>
                <section class="user-box">
                    <i class="fa fa-user fa-5x"></i>
                </section>
                <section class="input-box">
                <?php echo $this->Form->input('username', array('placeholder'=>__('Username'), 'autofocus', 'label'=>false)); ?>
                <?php echo $this->Form->input('password', array('type'=>'password', 'placeholder'=>__('Password'), 'label'=>false)); ?>
                </section>
                <?php echo $this->Form->button('<b>'.__('Enter').'</b>', array('type'=>'submit', 'class'=>'btn btn-primary btn-lg btn-block')); ?>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>