<?php if(isset($category['Category']['name'])):?>
    <ol class="breadcrumb">
        <li class="active"><?php echo $category['Category']['name'];?></li>
    </ol>
<?php endif;?>
<p>
<?php
if (!empty($category['Category'])) {
    echo $this->Html->link(__('Add'),
                                        array('action'=>'add',$categoryId),
                                        array('class'=>'btn btn-primary'));
}
?>
</p>

<ul class="nav nav-tabs nav-justified">
	<li class=<?php echo -1==$status?'active':'';?>>
		<?php echo $this->Html->link(__('All <span class="badge">'.$stats['total'].'</span>'),
									array('action'=>'index',$categoryId,-1),
									array('escape'=>false));?>
	</li>
	<li class=<?php echo 1==$status?'active':'';?>>
		<?php echo $this->Html->link(__('Appproved <span class="badge">'.$stats['approved'].'</span>'),
									array('action'=>'index',$categoryId,1),
									array('escape'=>false));?>
	</li>
	<li class=<?php echo 0==$status?'active':'';?>>
		<?php echo $this->Html->link(__('Pending <span class="badge">'.$stats['pending'].'</span>'),
										array('action'=>'index',$categoryId,0),
										array('escape'=>false));?>
	</li>
</ul>

<div class="tab-content">
	<div class="tab-pane active">
	    <p>&nbsp;</p>
		<table class="table table-bordered">
			<tr>
				<th><?php echo $this->Paginator->sort('title'); ?></th>
				<th><?php echo $this->Paginator->sort('views'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php foreach ($posts as $post): ?>
			<tr>
				<td><?php echo h($post['Post']['title']); ?>&nbsp;</td>
				<td><?php echo h($post['Post']['views']); ?>&nbsp;</td>
				<td class="actions">
                    <?php echo $this->Html->link(__('View'), array('admin'=>false, 'action' => 'view', $post['Post']['slug']), array('target'=>'_blank')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), null, __('Are you sure you want to delete # %s?', $post['Post']['id'])); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
        <?php echo $this->element('pagination'); ?>
	</div>
</div>
