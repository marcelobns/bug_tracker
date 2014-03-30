<div class="organizations view">
<h2><?php echo __('Organization'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Responsible'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['responsible']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Organization'); ?></dt>
		<dd>
			<?php echo $this->Html->link($organization['ParentOrganization']['name'], array('controller' => 'organizations', 'action' => 'view', $organization['ParentOrganization']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Array'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['parent_array']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Acronym'); ?></dt>
		<dd>
			<?php echo h($organization['Organization']['acronym']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
    <?=$this->element('side.generic');?>
</div>
