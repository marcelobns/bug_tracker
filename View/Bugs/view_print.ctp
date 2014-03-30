<section class="report-header">
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <td style="width: 5%;"></td>
            <td style="width: 95%;"></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <?php echo $this->Html->image('brasao_boavista.png', array('width'=>'45px')) ?>
            </td>
            <td style="text-align: center; padding-top: 15px">
                <p>Prefeitura Municipal de Boa Vista - Roraima<br/>
                    Secretaria de Inclusão Digital</p>
            </td>
        </tr>
        </tbody>
    </table>
</section>
<dl>
    <dt><?php echo __('Number'); ?></dt>
    <dd>
        <?php echo h($bug['Bug']['id']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Reporter'); ?></dt>
    <dd>
        <?php echo h($bug['Bug']['reporter']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Phone'); ?></dt>
    <dd>
        <?php echo h($bug['Bug']['phone']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Details'); ?></dt>
    <dd>
        <?php echo h($bug['Bug']['details']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Product'); ?></dt>
    <dd>
        <?php echo h($bug['Product']['name']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Priority'); ?></dt>
    <dd>
        <?php echo h($bug['Priority']['name']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Location Group'); ?></dt>
    <dd>
        <?php echo h($bug['LocationGroup']['name']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Location'); ?></dt>
    <dd>
        <?php echo h($bug['Bug']['location']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Created'); ?></dt>
    <dd>
        <?php echo h($bug['Bug']['created']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Created By'); ?></dt>
    <dd>
        <?php echo h($bug['User']['name']); ?>
        &nbsp;
    </dd>
</dl>