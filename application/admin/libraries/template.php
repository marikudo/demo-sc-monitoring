<?php
class template{
	public $registry ;
	public function __construct(){
		$this->registry = Registry::getInstance();

	}

	public function _admin($path,$data,$mvc){
		$userID = $this->registry->session->_get('user_id');
		$data['user'] = $user = $this->registry->user->data($userID);


		//Find the parent module if exists

		$a = str_replace("_","-",getController());

		$module = $this->registry->crud->read("SELECT * FROM _xparentmodule WHERE _xurl = :url",array(':url'=>$a),'assoc');
		$module_id = $module['xparentmodule_id'];
		$method = (getMethod()!='index') ? getMethod() : null;

		$acl = $this->registry->permission->getUserPermission($user['xroles_id']);
		//echo $user['xroles_id'];
		$permission = $acl['module'][$module_id];
		if ($user['xroles_id']==1 || $user['xroles_id']==2) {
				$permission['_url'] = $acl['module'][$module_id]['_url'];
				$permission['_create'] = $module['_xcreate'];
				$permission['_read'] 	= $module['_xread'];
				$permission['_update'] 	= $module['_xupdate'];
				$permission['_delete'] 	= $module['_xdelete'];
				$permission['_print'] 	= $module['_xprint'];
				$permission['_export'] 	= $module['_xexport'];
				$permission['_upload'] 	= $module['_xupload'];

			}
		//print_r($permission);


		$data['user']['permission'] = $permission;
		$data['user']['navigation'] = $acl['nav'];


		//print_pre($acl['nav']);

		$data['title'] = ($permission['module']!="") ? ucfirst($permission['module']) : "Crackerjack Web Development and Services";
		$mConfig = array();
		$mConfig['uPermission'] =  $permission;
		$data['hashConfig'] = base64_encode(serialize($mConfig));
		$mvc->render('admin/common/header',$data);
			if ($a=='account') {
				$permission['_read'] = 1;
			}
		if ($permission['_read']==1) {
				$file = APPS.getApplication().DS."views".DS.$path.EXT;
				if (file_exists($file)) {
						$mvc->render($path,$data);
					}else{
						echo '<div class="inner-container">
						<div class="alert alert-danger" style="margin:20px 15px">
							<h1>File Not found <span>:(</span></h1>

							<p>Sorry, but the page you were trying to view does not exist.</p>

							<p>It looks like this was the result of either:</p>
							<ul>
								<li>you don\'t have a permission to access</li>
								<li>a mistyped address</li>
								<li>an out-of-date link</li>
							</ul>
							</div>
						</div>';
					}

		}else{
		
			
			if(count($permission) > 0){
			echo '<div class="inner-container">
						<div class="alert alert-danger" style="margin:20px 15px">
							<h1>Not found <span>:(</span></h1>

							<p>Sorry, but the page you were trying to view does not exist.</p>

							<p>It looks like this was the result of either:</p>
							<ul>
								<li>you don\'t have a permission to access</li>
								<li>a mistyped address</li>
								<li>an out-of-date link</li>
							</ul>
							</div>
						</div>';
			}else{
				echo '<div class="inner-container">';
							echo "<br />";

							echo showMessageSmall('<strong>Note : </strong> You don\'t have a permission to access. Please contact your administrator regarding this matter.','danger');
							echo '</div>';
			}
		}
		
		$mvc->render('admin/common/footer',$data);
		if ($permission['_read']==1) {
			$filex = APPS.getApplication().DS."views".DS.(rtrim($path,'_'))."_footer".EXT;
				if (file_exists($filex)) {
					$mvc->render((rtrim($path,'_'))."_footer",$data);
				}
		}
		$mvc->render('admin/common/closing-footer',$data);
	}
}