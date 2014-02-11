<div class="row">
	<div class="col-lg-6 col-lg-offset-3 ">
		<div class="well">

			<?php 
			echo $this->Form->create('User',array(
					'class'=>'form-horizontal',
					'inputDefaults' => array(
							'required'=>false,
							'class'=>'form-control',
							'div' => 'form-group',
							'between'=>'<div class="col-sm-10">',
							'after'=>'</div>',
							'label'=>array('class'=>'col-sm-2 control-label')
					),
					'url'=>array('controller'=>'users','action'=>'login','plugin'=>'cakeuser','admin'=>false)
			));
			
			echo $this->Form->input('email', array(
					'placeholder'=>'Email Address',
					'autocomplete'=>'off'
			)
			);
			
			echo $this->Form->input('password', array(
					'type'=>'password',
					'placeholder'=>'Password',
					'autocomplete'=>'off'
			)
			);
			
			echo $this->Form->input('Login', array(
					'class'=>'btn btn-primary',
					'label'=>false,
					'type'=>'submit',
					'between'=>'<div class="col-sm-offset-2 col-sm-10">',
					'after'=>'</div>'
			));
			
			echo $this->Form->end();
			
			?>
			
		</div>
	</div>
</div>