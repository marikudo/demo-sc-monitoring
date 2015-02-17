<?php

class users extends crackerjack{
	private $modules = array();
	private $result;
	public function __construct(){
		parent::__construct();
		if ($this->session->_get('adminlogin')==false) {
				redirect('admin/home/auth');
			}

			$query = 'SELECT * FROM _xparentmodule WHERE status=1 AND xparentmodule_id > 1 ORDER BY xparentlabel_id';
			if($this->session->_get('role_id')!=1){

				//$query = 'SELECT * FROM _xparentmodule WHERE status=1 AND xparentmodule_id > 2 ORDER BY xparentlabel_id';
			}
		$this->result= $this->crud->read($query,array(),'obj');

		foreach($this->result as $k => $g){

			$this->modules[$g->xparentmodule_id] = array();
			$this->modules[$g->xparentmodule_id]['_xcreate'] =  0;
			$this->modules[$g->xparentmodule_id]['_xread'] 	=  0;
			$this->modules[$g->xparentmodule_id]['_xupdate'] =  0;
			$this->modules[$g->xparentmodule_id]['_xdelete'] =  0;
			$this->modules[$g->xparentmodule_id]['_xprint'] 	=  0;
			$this->modules[$g->xparentmodule_id]['_xexport'] =  0;
			$this->modules[$g->xparentmodule_id]['_xupload'] =  0;
		}

	}
	public function index(){
		//$data['users'] = $this->crud->read('SELECT * FROM _xusers as u LEFT JOIN _role as r ON u.role_id=r.role_id WHERE u.users_id!=:id AND u.users_id!=1',array(':id'=>$this->session->_get('users_id')),'obj');
			if($this->session->_get('message')==1){
					if ($this->session->_get('action')=='add') {
						$data['success'] = '<strong>Congratulations!.</strong> New record successfully added.';
					}

					if ($this->session->_get('action')=='update') {
						$data['success'] = '<strong>Congratulations!.</strong> User was successfully update.';
					}
				$this->session->_set(array('message'=>0,'action'=>''));

			}

		$this->template->_admin('admin/users',$data,$this->load);
	}

	public function new_record($id = false){
		$this->load->libraries(array('form'));
			if (isAjax()) {
				if ($_POST) {
				$postData = $this->form->post($_POST['btn-submit']);
				
				$userpostData = array();
				$xroles_id = $postData['xroles_id'];
				$userpostData['custom_role'] = '0';
					if($xroles_id==0){
						$role_data = array();
						$role_data['role'] = "Custom Role";
						$role_data['status'] =  1;
						$role_data['is_specific'] =  1;
						$role_data['date_created'] = date('Y-m-d H:i:s');
						$xroles_id = $this->crud->create('_xroles',$role_data);
						$userpostData['custom_role'] = 1;
						$result = $postData;
						unset($result['xusers_id']);
						unset($result['first_name']);
						unset($result['middle_name']);
						unset($result['last_name']);
						unset($result['email']);
						unset($result['password']);
						unset($result['xroles_id']);
						unset($result['status']);
						unset($result['btn-submit']);
						if(count($result) > 0){
							foreach($result as $k => $v){
								$xparentmodule_id = str_replace('_','',$k);
								$roleData['xparentmodule_id'] = $xparentmodule_id;
								$roleData['xroles_id'] = $xroles_id;
								$roleData['_xcreate'] 	= ($v['_xcreate']==0)? 0 : $v['_xcreate'];
								$roleData['_xread'] 	= ($v['_xread']==0)	? 0 : $v['_xread'];
								$roleData['_xupdate'] 	= ($v['_xupdate']==0)? 0 : $v['_xupdate'];
								$roleData['_xdelete'] 	= ($v['_xdelete']==0)? 0 : $v['_xdelete'];
								$roleData['_xexport'] 	= ($v['_xexport']==0)? 0 : $v['_xexport'];
								$roleData['_xprint'] 	= ($v['_xprint']==0)? 0 : $v['_xprint'];
								$roleData['_xupload'] 	= ($v['_xupload']==0)? 0 : $v['_xupload'];
								$ifsuccess += $this->crud->create('_xacl',$roleData);
			
							}
						}
						
					}
				
				$userpostData['xroles_id'] = $xroles_id;
				$userpostData['first_name'] = $postData['first_name'];
				$userpostData['middle_name'] = $postData['middle_name'];
				$userpostData['last_name'] = $postData['last_name'];
				$userpostData['email'] = $postData['email'];
				$userpostData['status'] = $postData['status'];
				$userpostData['password'] =  $this->hash->encryptMe_($postData['password']);
				$userpostData['date_created'] = date("Y-m-d H:i:s");
				
				
				if($this->crud->create('_xusers',$userpostData)){
					// $action_data['xparentmodule_id'] = 1;
					// $action_data['xusers_id'] = $this->session->_get('user_id');
					// $action_data['action'] = "Created";
					// $action_data['remarks'] = $userpostData['email'];
					// $this->admin_actions->createlog($action_data);
					header("Expires: " . gmdate( "D, d M Y H:i:s" ) . " GMT" );
					header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
					header("Cache-Control: no-cache, must-revalidate" );
					header("Pragma: no-cache" );
					header("Content-type: text/x-json");
					echo json_encode(array('result'=>'true'));
					$this->session->_set(array('message'=>true,'action'=>'add'));
					}
				}
				
				die();
			}
		
		
	$data['role_create'] = $this->result;
	$data['role'] = $this->crud->read('SELECT * FROM _xroles WHERE status=1 AND xroles_id > 1 AND is_specific < 1',array(),'obj');

	$data['action'] = 'Add';
			$this->template->_admin('admin/users_',$data,$this->load);
	}

	private function test(){
		echo 1;
	}

	public function modify($id =false){
		$users_id = $this->hash->decryptMe_($id[0]);
		$_xusers = $this->crud->read('SELECT * FROM _xusers WHERE xusers_id = :id',array(':id'=>$users_id),'assoc');
		$role_id = $_xusers['xroles_id'];
		//echo isAjax();
		$this->load->libraries(array('form'));
			if (isAjax()) {
				if ($_POST) {
				$postData = $this->form->post($_POST['btn-submit']);
				$xroles_id = $postData['xroles_id'];
				$userpostData = array();
				$userpostData['custom_role'] = '0';
					if($xroles_id==0){
						$userpostData['custom_role'] = 1;
						$role_data = array();
						$role_data['role'] = "Custom Role";
						$role_data['status'] =  1;
						$role_data['is_specific'] =  1;
						$role_data['date_created'] = date('Y-m-d H:i:s');
					
						$xroles_id = $this->crud->create('_xroles',$role_data);
						$result = $postData;
						unset($result['xusers_id']);
						unset($result['first_name']);
						unset($result['middle_name']);
						unset($result['last_name']);
						unset($result['email']);
						unset($result['password']);
						unset($result['xroles_id']);
						unset($result['status']);
						unset($result['btn-submit']);
						if(count($result) > 0){
							foreach($result as $k => $v){
								$xparentmodule_id = str_replace('_','',$k);
								$roleData['xparentmodule_id'] = $xparentmodule_id;
								$roleData['xroles_id'] = $xroles_id;
								$roleData['_xcreate'] 	= ($v['_xcreate']==0)? 0 : $v['_xcreate'];
								$roleData['_xread'] 	= ($v['_xread']==0)	? 0 : $v['_xread'];
								$roleData['_xupdate'] 	= ($v['_xupdate']==0)? 0 : $v['_xupdate'];
								$roleData['_xdelete'] 	= ($v['_xdelete']==0)? 0 : $v['_xdelete'];
								$roleData['_xexport'] 	= ($v['_xexport']==0)? 0 : $v['_xexport'];
								$roleData['_xprint'] 	= ($v['_xprint']==0)? 0 : $v['_xprint'];
								$roleData['_xupload'] 	= ($v['_xupload']==0)? 0 : $v['_xupload'];
								$resultx = $this->crud->read('SELECT count(xroles_id) AS count FROM _xacl WHERE xparentmodule_id=:id AND xroles_id=:idx',array(':id'=>$xparentmodule_id,':idx'=>$xroles_id),'assoc');
								if($resultx['count']==1){
									$ifsuccess +=$this->crud->update('_xacl',$roleData,array('xparentmodule_id'=>$xparentmodule_id,'xroles_id'=>$xroles_id),'=');
								}else{
									$ifsuccess += $this->crud->create('_xacl',$roleData);
								}
							}
						}
					}
					
							
							$userpostData['xroles_id'] = $xroles_id;
							$userpostData['first_name'] = $postData['first_name'];
							$userpostData['middle_name'] = $postData['middle_name'];
							$userpostData['last_name'] = $postData['last_name'];
							$userpostData['email'] = $postData['email'];
							$userpostData['status'] = $postData['status'];
							$userpostData['date_created'] = date("Y-m-d H:i:s");
							
							$isupdate = $this->crud->update('_xusers',$userpostData,array('xusers_id'=>$users_id));
							if($_xusers['custom_role']==1){
								$this->crud->delete('_xroles',array('xroles_id'=>$_xusers['xroles_id']));
							}
							
							if ($isupdate) {
								
								// $action_data['xparentmodule_id'] = 1;
								// $action_data['xusers_id'] = $this->session->_get('user_id');
								// $action_data['action'] = "Updated";
								// $action_data['remarks'] = "";
								// $this->admin_actions->createlog($action_data);
								
								header("Expires: " . gmdate( "D, d M Y H:i:s" ) . " GMT" );
								header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
								header("Cache-Control: no-cache, must-revalidate" );
								header("Pragma: no-cache" );
								header("Content-type: text/x-json");
								echo json_encode(array('result'=>'true'));
								$this->session->_set(array('message'=>true,'action'=>'update'));
							}
					
			
				
				}
				die();
			}
		
			$data['result'] = $this->crud->read('SELECT * FROM _xusers WHERE xusers_id = :id',array(':id'=>$users_id),'assoc');
			$data['action'] = 'Edit';
			$data['role'] = $this->crud->read('SELECT * FROM _xroles WHERE status=1 AND xroles_id > 1 AND is_specific=0',array(),'obj');
			$data['role_create'] = $this->result;
			
						$result = $this->crud->read('SELECT * FROM _xparentmodule AS m INNER JOIN _xacl AS p ON m.xparentmodule_id=p.xparentmodule_id WHERE p.xroles_id=:id AND m.xparentmodule_id > 1',array(':id'=>$role_id),'obj');
		$modules = array();
		if($_xusers['custom_role']==1){
			
		foreach($result as $k => $g){
		
			$modules[$g->xparentmodule_id] = array();
			$modules[$g->xparentmodule_id]['_xcreate'] = ($g->_xcreate==1) ? 1 : 0;
			$modules[$g->xparentmodule_id]['_xread'] = ($g->_xread ==1) ? 1 : 0;
			$modules[$g->xparentmodule_id]['_xupdate'] = ($g->_xupdate==1) ? 1 : 0;
			$modules[$g->xparentmodule_id]['_xdelete'] = ($g->_xdelete==1) ? 1 : 0;
			$modules[$g->xparentmodule_id]['_xexport'] = ($g->_xexport==1) ? 1 : 0;
			$modules[$g->xparentmodule_id]['_xprint'] = ($g->_xprint==1) ? 1 : 0;
			$modules[$g->xparentmodule_id]['_xupload'] = ($g->_xupload==1) ? 1 : 0;
		
		}
		}
		$data['modules'] = $modules;
			$this->template->_admin('admin/users_',$data,$this->load);

	}

	public function delete(){
			if (isAjax()) {
				if (isset($_GET['gConf'])) {
					$gConfig = unserialize(base64_decode($_GET['gConf']));
					extract($gConfig['uPermission']);

					//get post id's
					$row = array_unique($_POST['row']);
					if (is_array($row)) {
						$nDelete = '';
						$rDelete = 0;
						foreach ($row as $value) {
							$tid = $this->hash->decryptMe_($value);
									$rDelete += $this->crud->delete('_xusers',array('xusers_id'=>$tid));

						}
						echo $rDelete.":".rtrim($nDelete,',');
					}
				}
			}

		}

}