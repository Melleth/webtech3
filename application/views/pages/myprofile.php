<?php
	//First we do a quick logged in check
	if (!(isset($loggedin) && $loggedin)) {
		//IMPOSTER ALERT!
		echo "You really shouldn't be here. Kicking you out in 10";
		$this->output->set_header('refresh:10;url='.base_url());
	} else {
		$this->load->model('profile_model');
		$profile_model->get_profile($user);
	}
	

?>