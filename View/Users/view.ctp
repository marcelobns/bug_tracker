<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($user['User']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Role']['name'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organization'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $user['Organization']['id'])); ?>
			&nbsp;
		</dd>
        <dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
        <dt><?php echo __('Created By'); ?></dt>
        <dd>
            <?php echo h($user['User']['created_by']); ?>
            &nbsp;
        </dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($user['User']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
    <?=$this->element('side.generic');?>
</div>
