<div class="loginbox">
    <div class="logincontent">
      <div class="loginheader">
        <?php echo $this->Html->image('memberlogo.png', array('alt' => 'RunSociety'));?>
      </div>
      
      <div class="loginbody">
      	<h1>Reset Password</h1>
      	<p class="logintext">Enter your email address below and we'll send you the instructions.</p>

      	<div class="logintabarea">
	      	<?php
				 echo $this->Form->create('User',array(
	                      'inputDefaults' => array(
	                      'required'=>false,
	                      'class'=>'input',
	                      		'novalidate'=>true,
	                            'div' => 'field',
	                            'url'=>array('action'=>'forget_password')
	                       )
	                    )
	                  );

				echo $this->Form->input('email',
						array(
							'class'=>'fulltext input',
							'placeholder'=>'Email Address',
							'label'=>false)
					);
			?>

	      	<div class="loginfooter">
	            <?php echo $this->Form->end(array('label' => __('Submit'), 'class' => 'btn btn-danger')); ?>
	        </div>
	    </div>
      </div>
    </div>
</div>