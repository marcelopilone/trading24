<div class="ips view">
<h2><?php echo __('Ip'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ip['Ip']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number'); ?></dt>
		<dd>
			<?php echo h($ip['Ip']['number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($ip['Ip']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($ip['Ip']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ip'), array('action' => 'edit', $ip['Ip']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Ip'), array('action' => 'delete', $ip['Ip']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $ip['Ip']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Ips'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ip'), array('action' => 'add')); ?> </li>
	</ul>
</div>
