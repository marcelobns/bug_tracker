<div class="bugTrackers form">
<?php echo $this->Form->create('BugTracker'); ?>
	<fieldset>
		<legend><?php echo __('Edit Bug Tracker'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('bug_id');
		echo $this->Form->input('situation_id');
		echo $this->Form->input('details');
		echo $this->Form->input('organization_id');
		echo $this->Form->input('created_by');
		echo $this->Form->input('updated_by');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">


</div>
