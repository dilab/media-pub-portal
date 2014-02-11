<?php 
App::uses('Router','Ultility');
?>
<p>
Hi 
<br/><br/>
Please click on the <a href="<?php echo Router::url(array('controller'=>'users','action'=>'reset_password','plugin'=>'cakeuser',$code),true);?>">link</a> 
to reset your password.

<br/><br/>
This link will expire in <?php echo Configure::read('ResetPasswordExpire');?> minutes;

</p>

<p>
Regards
</p>