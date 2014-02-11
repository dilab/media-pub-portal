<?php 
App::uses('Router','Ultility');
?>
<p>
Hi 
<br/><br/>
Thank you for registering with us, 
<br/><br/>
Please click on the <a href="<?php echo Router::url(array('controller'=>'users','action'=>'verify','plugin'=>'cakeuser',$code),true);?>">link</a> to confirm your registration.
</p>

<p>
Regards
</p>