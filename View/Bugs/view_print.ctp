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
    <dt><?php echo __('Requestor'); ?></dt>
    <dd>
        <?php echo h($bug['Bug']['requestor']); ?>
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
    <dt><?php echo __('Origin'); ?></dt>
    <dd>
        <?php echo h($bug['Origin']['name']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Created'); ?></dt>
    <dd>
        <?php echo h($bug['Bug']['created']); ?>
        &nbsp;
    </dd>
    <dt><?php echo __('Created By'); ?></dt>
    <dd>
        <?php echo h($bug['Creator']['name']); ?>
        &nbsp;
    </dd>
</dl>