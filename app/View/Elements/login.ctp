<div>
	<?php
		echo $this->Form->create();
		echo $this->Form->input('email');   //text
		echo $this->Form->input('password');   //password
		/*echo $this->Form->input('email');   //day, month, year, hour, minute,
		echo $this->Form->input('password');
		echo $this->Form->input('cpassword');      //textarea*/
		echo $this->Form->end('Login');
	?>
</div>