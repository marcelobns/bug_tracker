<div class="bugs view container">
    <div class="col-md-8">
        <dl>
            <dt><?php echo __('Origin'); ?></dt>
            <dd>
                <strong style="font-size: 1.2em;"><?php echo h($bug['Origin']['name']); ?></strong>
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
            <dt><?php echo __('Product'); ?></dt>
            <dd>
                <strong style="font-size: 1.25em;"><?php echo h($bug['Product']['name']); ?></strong>
                &nbsp;
            </dd>
            <dt><?php echo __('Details'); ?></dt>
            <dd>
                <strong style="font-size: 1.25em;"><?php echo h($bug['Bug']['details']); ?></strong>
                &nbsp;
            </dd>
            <dt><?php echo __('Situation'); ?></dt>
            <dd style="color:<?=$bug['Situation']['color'];?>">
                <strong style="font-size: 1.2em;"><?php echo h($bug['Situation']['name']); ?></strong>
                &nbsp;
            </dd>
            <dt><?php echo __('Deadline'); ?></dt>
            <dd style="color: darkred;">
                <strong style="font-size: 1.2em;"><?php if($bug['Bug']['deadline']) echo date('d/m/Y', strtotime($bug['Bug']['deadline'])); ?></strong>
                &nbsp;
            </dd>
            <dt><?php echo __('Created By'); ?></dt>
            <dd>
                <?php echo h($bug['Creator']['name']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Created'); ?></dt>
            <dd>
                <?php echo h($bug['Bug']['created']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Updated'); ?></dt>
            <dd>
                <?php echo h($bug['Bug']['updated']); ?>
                &nbsp;
            </dd>
        </dl>
    </div>
    <div class="actions col-md-3">
        <ul class="nav nav-pills nav-stacked" role="tablist">
            <li><?php echo $this->Html->link('<i class="fa fa-print fa-lg pull-right"></i> '.__('Print Bug'), array('controller' => 'bugs', 'action' => 'view_print', $bug['Bug']['id']), array('target'=>'_blank', 'escape'=>false)); ?> </li>
            <li><?php echo $this->Html->link('<i class="fa fa-exchange fa-lg pull-right"></i> Novo Rastro', array('controller' => 'bug_Tracks', 'action' => 'add', $bug['Bug']['id']), array('escape'=>false)); ?> </li>
            <li><?php echo $this->Html->link('<i class="fa fa-pencil fa-lg pull-right"></i> '.__('Edit Bug'), array('action' => 'edit', $bug['Bug']['id']), array('escape'=>false)); ?> </li>
        </ul>
    </div>
    <div class="related col-md-11">
        <?php if (!empty($bugTracks)): ?>
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th class="col-lg-2"><?php echo __('Created'); ?></th>
                    <th class="col-lg-1"><?php echo __('Situation'); ?></th>
                    <th class="col-lg-5"><?php echo __('Details'); ?></th>
                    <th class="col-lg-2"><?php echo __('Technicians'); ?></th>
                    <th class="col-lg-2"><?php echo __('Created By'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($bugTracks as $bugTrack): ?>
                    <tr>
                        <td class="col-lg-2"><?php echo $bugTrack['BugTrack']['created']; ?></td>
                        <td class="col-lg-1"><?php echo $bugTrack['Situation']['name']; ?></td>
                        <td class="col-lg-5"><?php echo $bugTrack['BugTrack']['details']; ?></td>
                        <td class="col-lg-2"><?php echo str_replace(array('{', '}'), '', $bugTrack['Technician']['array']); ?></td>
                        <td class="col-lg-2"><?php echo $bugTrack['Creator']['username']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
