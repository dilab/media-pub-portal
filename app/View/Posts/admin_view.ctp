<div class="posts view">
<h2><?php echo __('Post'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($post['Post']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($post['Post']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Des'); ?></dt>
		<dd>
			<?php echo h($post['Post']['des']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($post['Post']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Views'); ?></dt>
		<dd>
			<?php echo h($post['Post']['views']); ?>
			&nbsp;
		</dd>
		
		<dt><?php echo __('Source'); ?></dt>
		<dd>
			<?php echo h($post['Post']['source']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Video Url'); ?></dt>
		<dd>
			<?php echo h($post['Post']['video_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Picture Url'); ?></dt>
		<dd>
			<?php echo h($post['Post']['picture_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Picture Upload'); ?></dt>
		<dd>
			<?php echo h($post['Post']['picture_upload']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Picture Upload Thumb'); ?></dt>
		<dd>
			<?php echo h($post['Post']['picture_upload_thumb']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($post['Post']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($post['Post']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($post['Post']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($post['Post']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category Id'); ?></dt>
		<dd>
			<?php echo h($post['Post']['category_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Post'), array('action' => 'edit', $post['Post']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Post'), array('action' => 'delete', $post['Post']['id']), null, __('Are you sure you want to delete # %s?', $post['Post']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post'), array('action' => 'add')); ?> </li>
	</ul>
</div>
