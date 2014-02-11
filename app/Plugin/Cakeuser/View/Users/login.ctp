<?php
echo $this->Form->create('User',array('class'=>'well form-inline'));
echo $this->Form->input('email',array('class'=>'input-large','placeholder'=>'Email','label'=>false,'div'=>false));
?>

<?php 
echo $this->Form->input('password',array('type'=>'password', 'class'=>'input-large','placeholder'=>'Password','label'=>false,'div'=>false));
?>

<?php 
echo '<label class="checkbox">';
echo $this->Form->input('remember_me',array('type'=>'checkbox','label'=>false,'div'=>false));
echo 'Remember me';
echo '</label>';
?>

<?php 
echo $this->Form->button('Sign in',array('class'=>'btn'));
echo $this->Form->end();
?>