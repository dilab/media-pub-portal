<ol class="breadcrumb">
    <li class="active"><?php echo __('Change Password');?></li>
</ol>



<div class="well">
    <?php
        echo $this->Form->create('User',array(
            'url'=>array('controller'=>'users','action'=>'change_pwd','plugin'=>'cakeuser','admin'=>false),
            'type'=>'file',
            'class'=>'form-horizontal',
            'inputDefaults' => array(
                'required'=>false,
                'class'=>'form-control',
                'div' => 'form-group',
                'between'=>'<div class="col-sm-5">',
                'after'=>'</div>',
                'label'=>array('class'=>'col-sm-2 control-label')
            )
        ));

        echo $this->Form->input('password',array('label'=>array('text'=>__('New Password'),'class'=>'col-sm-2 control-label')));

        echo $this->Form->input('password2',array('type'=>'password','label'=>array('text'=>__('Confirm Password'),'class'=>'col-sm-2 control-label')));

        echo $this->Form->input(__('Update'),array('label'=>false, 'class'=>'btn btn-default','type'=>'submit'));

        echo $this->Form->end();
    ?>
</div>