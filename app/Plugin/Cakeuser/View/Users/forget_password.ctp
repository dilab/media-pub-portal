<?php
echo $this->Form->create('User',array('class'=>'well form-inline','url'=>array('action'=>'forget_password')));
echo $this->Form->input('email',array('class'=>'input-big','placeholder'=>'Email','label'=>false,'div'=>false));
?>


<?php 
echo $this->Form->button('Submit',array('class'=>'btn'));
echo $this->Form->end();
?>