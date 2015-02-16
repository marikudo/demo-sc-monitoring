<?php
class home extends crackerjack{
		public function __construct(){
			parent::__construct();
		}

		public function index(){

			if ($this->session->_get('adminlogin')==false) {
				redirect('admin/home/auth');
			}

		

			$this->template->_admin('admin/dashboard',$data,$this->load);
		}

		public function testing($a = false){
			$this->template->_admin('admin/dashboard',$data,$this->load);
		}

		public function auth(){
			if ($this->session->_get('adminlogin')==true) {
				redirect('admin/home');
			}
			if (isset($_POST['btn_success'])) {
				$invalid = 'Invalid Username or password.';
					$_postData = $this->form->_serialize($_POST);
						if (empty($_postData['username']) || empty($_postData['password'])) {
							$data['error'] = $invalid;
						}else{
							$result = $this->user_auth->validate($_postData['username'],$_postData['password']);
							if ($result) {
								$this->session->_set(array('adminlogin'=>true,'user_id'=>$result['xusers_id'],'role_id'=>$result['xroles_id']));
								redirect('admin');

							}else{
								$data['error'] = $invalid;
							}
						}

			}

			$data['title'] = "Administrator login";
			$data['notlogin'] = 'login';
			$this->load->render('notlogin/index',$data);
		}

		public function forgot(){
			if ($this->session->_get('adminlogin')==true) {
				redirect('admin/home');
			}

			if (isset($_POST['btn_success'])) {
				$invalid = 'Email address not exists in database.';
					$_postData = $this->form->_serialize($_POST);
						$result = $this->user_auth->forgot($_postData['username']);

						if ($result) {
							//to do
							$data['success'] = 'Password was successfully reset. Kindly check your email.';
						}else{
							$data['error'] = $invalid;
						}
			}
			$data['title'] = "Forgot Password";
			$data['notlogin'] = 'forgot';
			$this->load->render('notlogin/index',$data);
		}

		public function logout(){
			$this->session->_unset();
			redirect('admin/home/auth');
		}


}