<div class="loginbox">
    <div class="logincontent">
      <div class="loginheader">
        <?php echo $this->Html->image('memberlogo.png', array('alt' => 'RunSociety'));?>
      </div>
      
      <div class="loginbody">
        <ul class="nav nav-tabs">
          <li><a href="#login" data-toggle="tab">Login</a></li>
          <li  class="active"><a href="#signup" data-toggle="tab">Sign Up</a></li>
        </ul>

        <div class="tab-content logintabarea">
          <div class="tab-pane" id="login">

            <p class="logintext">Login to RunSociety for full access to the Forum and Goodies.</p>

            <div class="block">
              <div class="btn btn-info">
                <?php
                    echo $this->Facebook->login(array(
                      'id'=>'fbbtn',
                      'label'=> __('<span><i class="icon-facebook"></i></span>Login with Facebook'),
                      'redirect'=>array('controller'=>'users','action'=>'login','plugin'=>'cakeuser')
                    ));
                ?>
              </div>
            </div>

            <div class="block">
              <div class="loginor"><span>or</span></div>
            </div>

              <?php
                  echo $this->Form->create('User',array(
                      'inputDefaults' => array(
                      'required'=>false,
                      'class'=>'input',
                            'div' => 'field',
                            'label'=>array('class'=>'control-label')
                       ),
                  	  'url'=>array('controller'=>'users','action'=>'login','plugin'=>'cakeuser','admin'=>false)
                    )
                  );
                   
                  echo $this->Form->input('email', array(
                      'class'=>'text input',
                      'placeholder'=>'Email Address',
                      'label'=>false,
                      'autocomplete'=>'off'
                    )
                  );

                  echo $this->Form->input('password', array(
                      'type'=>'password',
                      'class'=>'text input',
                      'placeholder'=>'Password',
                      'label'=>false,
                      'autocomplete'=>'off'
                    )
                  );
              ?>

            <div class="field loginmeta">
              <div class="pushleft">
                <label class="checkbox" for="remember_me">
                <?php echo $this->Form->input('remember_me',array('type'=>'checkbox','label'=>false,'div'=>false)); ?> Remember me
                </label>
              </div>
              <div class="pushright">
                <?php echo $this->Html->link(__('Forget password?'),array('controller'=>'users','action'=>'forget_password'));?>
              </div>
              <div class="clear"></div>
            </div>

            <div class="loginfooter">
              <?php echo $this->Form->end(array('label' => __('Login'), 'class' => 'btn btn-danger')); ?>
            </div>
            
          </div>

          <div class="tab-pane active" id="signup">
             <div class="block">
              <div class="btn btn-info">
                <?php
                    echo $this->Facebook->login(array(
                      'id'=>'fbbtn',
                      'label'=> __('<span><i class="icon-facebook"></i></span>Sign Up with Facebook'),
                      'redirect'=>array('controller'=>'users','action'=>'login','plugin'=>'cakeuser')
                    ));
                ?>
              </div>
            </div>
            
            <?php  echo $this->Session->flash(); ?>
            
            <?php
                  echo $this->Form->create('User',array(
                      'inputDefaults' => array(
                      'required'=>false,
                      'class'=>'input',
                            'div' => 'field',
                            'label'=>array('class'=>'control-label')
                       ),
                  	  'url'=>array('controller'=>'users','action'=>'register','plugin'=>'cakeuser','admin'=>false)
                    )
                  );
                   
                  echo $this->Form->input('email', array(
                      'class'=>'text input',
                      'placeholder'=>'Email Address',
                      'label'=>false,
                      'autocomplete'=>'off'
                    )
                  );

                  echo $this->Form->input('password', array(
                      'type'=>'password',
                      'class'=>'text input',
                      'placeholder'=>'Password',
                      'label'=>false,
                      'autocomplete'=>'off'
                    )
                  );
                  
                  echo $this->Form->input('password2', array(
                  		'type'=>'password',
                  		'class'=>'text input',
                  		'placeholder'=>'Confirm Password',
                  		'label'=>false,
                  		'autocomplete'=>'off'
                  )
                  );
              ?>

           
            <div class="loginfooter">
              <?php echo $this->Form->end(array('label' => __('Submit'), 'class' => 'btn btn-danger')); ?>
            </div>
            
            

          </div>
        </div>
      </div>
    </div>
</div>

