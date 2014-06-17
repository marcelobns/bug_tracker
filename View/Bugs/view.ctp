<div class="bugs view">
	<dl>
        <dt><?php echo __('Origin'); ?></dt>
        <dd>
            <?php echo h($bug['Origin']['name']); ?>
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
            <?php echo h($bug['Product']['name']); ?>
			&nbsp;
		</dd>
        <dt><?php echo __('Details'); ?></dt>
        <dd>
            <?php echo h($bug['Bug']['details']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Situation'); ?></dt>
        <dd style="color:<?=$bug['Situation']['color'];?>">
            <?php echo h($bug['Situation']['name']); ?>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link('<i class="fa fa-print fa-lg pull-right"></i> '.__('Print Bug'), array('controller' => 'bugs', 'action' => 'view_print', $bug['Bug']['id']), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-exchange fa-lg pull-right"></i> '.__('New Bug Tracker'), array('controller' => 'bug_trackers', 'action' => 'add', $bug['Bug']['id']), array('escape'=>false)); ?> </li>
		<li><?php echo $this->Html->link('<i class="fa fa-pencil fa-lg pull-right"></i> '.__('Edit Bug'), array('action' => 'edit', $bug['Bug']['id']), array('escape'=>false)); ?> </li>
<!--		<li>--><?php //echo $this->Form->postLink('<i class="fa fa-trash-o fa-lg pull-right"></i> '.__('Delete Bug'), array('action' => 'delete', $bug['Bug']['id']), array('escape'=>false), __('Are you sure you want to delete # %s?', $bug['Bug']['id'])); ?><!-- </li>-->
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Bug Trackers'); ?></h3>
	<?php if (!empty($bugTrackers)): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
        <th class="col-lg-2"><?php echo __('Created'); ?></th>
		<th class="col-lg-1"><?php echo __('Situation'); ?></th>
		<th class="col-lg-5"><?php echo __('Details'); ?></th>
		<th class="col-lg-2"><?php echo __('Technicians'); ?></th>
		<th class="col-lg-2"><?php echo __('Created By'); ?></th>
	</tr>
	<?php foreach ($bugTrackers as $bugTracker): ?>
		<tr>
            <td class="col-lg-2"><?php echo $bugTracker['BugTracker']['created']; ?></td>
			<td class="col-lg-1"><?php echo $bugTracker['Situation']['name']; ?></td>
			<td class="col-lg-5"><?php echo $bugTracker['BugTracker']['details']; ?></td>
			<td class="col-lg-2"><?php echo str_replace(array('{', '}'), '', $bugTracker['Technician']['array']); ?></td>
			<td class="col-lg-2"><?php echo $bugTracker['Creator']['username']; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
