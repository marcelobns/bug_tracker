<div class="bugTrackers view">
<h2><?php echo __('Bug Tracker'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($bugTracker['BugTracker']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bug'); ?></dt>
		<dd>
			<?php echo $this->Html->link($bugTracker['Bug']['id'], array('controller' => 'bugs', 'action' => 'view', $bugTracker['Bug']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Situation'); ?></dt>
		<dd>
			<?php echo $this->Html->link($bugTracker['Situation']['name'], array('controller' => 'situations', 'action' => 'view', $bugTracker['Situation']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Details'); ?></dt>
		<dd>
			<?php echo h($bugTracker['BugTracker']['details']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization'); ?></dt>
		<dd>
			<?php echo $this->Html->link($bugTracker['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $bugTracker['Organization']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($bugTracker['BugTracker']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo h($bugTracker['BugTracker']['created_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($bugTracker['BugTracker']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated By'); ?></dt>
		<dd>
			<?php echo h($bugTracker['BugTracker']['updated_by']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">

</div>
