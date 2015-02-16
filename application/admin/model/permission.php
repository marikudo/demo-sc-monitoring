<?php
if(!defined('APPS')) exit ('No direct access allowed');

class permission extends crackerjack_model{
	protected $label = array();
	public function __construct(){
		parent::__construct();
	}

	public function getLabels($id = false){
		$query = $this->crud->read('SELECT * FROM _xparentlabel WHERE status=1 ORDER BY xparentlabel_id',array(),'obj');
			foreach ($query as $get) {
				$this->label[$get->xparentlabel_id] = $get->label;
			}
		$return = $this->label;
		if ($id) {
			if (array_key_exists($id,$this->label)) {
				$return = $this->label[$id];
			}
		}
		return $return;
	}

	public function getParentModule($id = false,$label =false){

		$query = $this->crud->read('SELECT * FROM _xparentmodule AS pm INNER JOIN _xparentlabel AS pl ON pm.xparentlabel_id = pl.xparentlabel_id WHERE pm.status=1 AND pl.status=1',array(),'obj');
		$module = array();
		foreach ($query as $get) {
			$module[$get->xparentlabel_id]['label'] = $get->label;
			$module[$get->xparentlabel_id]['module'][$get->xparentmodule_id]['xparentmodule'] = $get->parentmodule;
			$module[$get->xparentlabel_id]['module'][$get->xparentmodule_id]['_create'] = $get->_xcreate;
			$module[$get->xparentlabel_id]['module'][$get->xparentmodule_id]['_read'] = $get->_xread;
			$module[$get->xparentlabel_id]['module'][$get->xparentmodule_id]['_update'] = $get->_xupdate;
			$module[$get->xparentlabel_id]['module'][$get->xparentmodule_id]['_delete'] = $get->_xdelete;
			$module[$get->xparentlabel_id]['module'][$get->xparentmodule_id]['_print'] = $get->_xprint;
			$module[$get->xparentlabel_id]['module'][$get->xparentmodule_id]['_export'] = $get->_xexport;
			$module[$get->xparentlabel_id]['module'][$get->xparentmodule_id]['_url'] = $get->_xurl;
			$module[$get->xparentlabel_id]['module'][$get->xparentmodule_id]['_icon'] = $get->_icon;
		}
		$return =  $module;

		if ($id) {
					$array = array();
			foreach ($module as $key => $value) {
				if (array_key_exists($id, $value['module'])) {
					$array[$key]['label'] = $module[$key]['label'];
					$array[$key]['module'] = $value['module'][$id];
				}
			}
			$return = $array;	
		}

		if ($label==true) {
			if (array_key_exists($label, $module)) {
					$return = $module[$label];
			}
		}

		return $return;

	}

	public function subModule($submoduleId = false,$moduleId =false){
		$return = array();
			$result = $this->crud->read('SELECT * FROM _xparentmodule AS xm INNER JOIN _xparentmodule AS pm ON xm.xparentmodule_id = pm.xparentmodule_id WHERE xm.status=1 AND pm.status=1',array(),'obj');
			$submodule = array();
			$module = array();
			foreach ($result as $get) {
				$submodule[$get->xparentmodule_id][$get->xparentmodule_id]['submodule'] = $get->module;
				$submodule[$get->xparentmodule_id][$get->xparentmodule_id]['_create'] = $get->_xcreate;
				$submodule[$get->xparentmodule_id][$get->xparentmodule_id]['_read'] = $get->_xread;
				$submodule[$get->xparentmodule_id][$get->xparentmodule_id]['_update'] = $get->_xupdate;
				$submodule[$get->xparentmodule_id][$get->xparentmodule_id]['_delete'] = $get->_xdelete;
				$submodule[$get->xparentmodule_id][$get->xparentmodule_id]['_export'] = $get->_xexport;
				$submodule[$get->xparentmodule_id][$get->xparentmodule_id]['_print'] = $get->_xprint;
				$submodule[$get->xparentmodule_id][$get->xparentmodule_id]['_url'] = $get->_xurl;
				$submodule[$get->xparentmodule_id][$get->xparentmodule_id]['_icon'] = $get->_icon;
			}
			$return = $submodule;

			if ($submoduleId==true && $moduleId == false) {
					$array = array();
				foreach ($submodule as $key => $value) {
					if (array_key_exists($submoduleId, $value)) {
						$array[$key] = $submodule[$key];
					}
			
				}
				$return = $array;
			}

			if ($moduleId==true) {
				if (array_key_exists($moduleId, $submodule)) {
					$module[$moduleId] = $submodule[$moduleId];
					if ($submoduleId==true) {
						if (array_key_exists($submoduleId, $submodule[$moduleId])) {
							$module[$moduleId] = $submodule[$moduleId][$submoduleId];
						}else{
							$module = array();
						}
					}
				}

				$return = $module;
			}

		return $return;			
	}

	public function getUserPermission($id){
		$return = false;
		switch ($id) {
				case 1 :
				$query = "SELECT _xurl,parentmodule,_xcreate,_xread,_xupdate,_xdelete,_xprint,_xexport,pm.xparentlabel_id,xparentmodule_id,parent_id,pl.sort,pm._icon FROM _xparentmodule AS pm INNER JOIN _xparentlabel AS pl ON pm.xparentlabel_id = pl.xparentlabel_id WHERE pm.status = 1 AND pl.status= 1 ORDER BY pl.sort,xparentlabel_id,xparentmodule_id ASC"; 
				break;
				case 2:
				$query = "SELECT _xurl,parentmodule,_xcreate,_xread,_xupdate,_xdelete,_xprint,_xexport,pm.xparentlabel_id,xparentmodule_id,parent_id,pl.sort,pm._icon FROM _xparentmodule AS pm INNER JOIN _xparentlabel AS pl ON pm.xparentlabel_id = pl.xparentlabel_id WHERE pm.status = 1 AND pl.status= 1  AND pm.xparentmodule_id != 1 ORDER BY pl.sort,xparentlabel_id,xparentmodule_id ASC"; 
					break;
				default:
						$query = "SELECT pm._xurl,pm.parentmodule,a._xcreate,a._xread,a._xupdate,a._xdelete,a._xprint,a._xexport,a.xparentmodule_id,pm.xparentlabel_id,pm.parent_id,pm._icon FROM _xacl AS a INNER JOIN _xparentmodule AS pm ON a.xparentmodule_id = pm.xparentmodule_id WHERE a.xroles_id=:rid AND a._xread = 1 AND pm.status = 1 AND pl.status= 1 AND pm.xparentmodule_id != 1 ORDER BY  pm.xparentlabel_id";			
				break;
			}

			//echo $query;
			$result = $this->crud->read($query,array(':rid'=>$id),'obj');

			$module = array();
			$modulenolabels = array();
			$labels = $this->getLabels();
			$a = array();
			foreach ($result as $get) {
				//return modules with labels
				if ($get->parent_id == 0) {
				$module[$get->xparentlabel_id]['label'] = $labels[$get->xparentlabel_id];
				$module[$get->xparentlabel_id][$get->xparentmodule_id]['xparentmodule_id'] 	= $get->xparentmodule_id;
				$module[$get->xparentlabel_id][$get->xparentmodule_id]['parent_id'] 	= $get->parent_id;
				$module[$get->xparentlabel_id][$get->xparentmodule_id]['module'] 	= $get->parentmodule;
				$module[$get->xparentlabel_id][$get->xparentmodule_id]['_url'] 		= $get->_xurl;
				$module[$get->xparentlabel_id][$get->xparentmodule_id]['_icon'] 		= $get->_icon;
				$module[$get->xparentlabel_id][$get->xparentmodule_id]['_create'] 	= ($get->xparentmodule_id ==2) ? 1 : $get->_xcreate;
				$module[$get->xparentlabel_id][$get->xparentmodule_id]['_read'] 	= ($get->xparentmodule_id ==2) ? 1 : $get->_xread;
				$module[$get->xparentlabel_id][$get->xparentmodule_id]['_update'] 	= ($get->xparentmodule_id ==2) ? 1 : $get->_xupdate;
				$module[$get->xparentlabel_id][$get->xparentmodule_id]['_delete'] 	= ($get->xparentmodule_id ==2) ? 1 : $get->_xdelete;
				$module[$get->xparentlabel_id][$get->xparentmodule_id]['_print'] 	= ($get->xparentmodule_id ==2) ? 1 : $get->_xprint;
				$module[$get->xparentlabel_id][$get->xparentmodule_id]['_export'] 	= ($get->xparentmodule_id ==2) ? 1 : $get->_xexport;
				}	
					if ($get->parent_id > 0) {
						$module[$get->xparentlabel_id][$get->parent_id]['sub'][$get->xparentmodule_id]['xparentmodule_id'] 	= $get->xparentmodule_id;
						$module[$get->xparentlabel_id][$get->parent_id]['sub'][$get->xparentmodule_id]['parent_id'] 	= $get->parent_id;
						$module[$get->xparentlabel_id][$get->parent_id]['sub'][$get->xparentmodule_id]['module'] 	= $get->parentmodule;
						$module[$get->xparentlabel_id][$get->parent_id]['sub'][$get->xparentmodule_id]['_url'] 		= $get->_xurl;
						$module[$get->xparentlabel_id][$get->parent_id]['sub'][$get->xparentmodule_id]['_icon'] 		= $get->_icon;
						$module[$get->xparentlabel_id][$get->parent_id]['sub'][$get->xparentmodule_id]['_create'] 	= ($get->xparentmodule_id ==2) ? 1 : $get->_xcreate;
							$x_read = $get->_xread;
							if ($module[$get->xparentlabel_id][$get->parent_id]['_read']==0) {
								$x_read = 0;
							}
						$module[$get->xparentlabel_id][$get->parent_id]['sub'][$get->xparentmodule_id]['_read'] 	= ($get->xparentmodule_id ==2) ? 1 : $x_read;
						$module[$get->xparentlabel_id][$get->parent_id]['sub'][$get->xparentmodule_id]['_update'] 	= ($get->xparentmodule_id ==2) ? 1 : $get->_xupdate;
						$module[$get->xparentlabel_id][$get->parent_id]['sub'][$get->xparentmodule_id]['_delete'] 	= ($get->xparentmodule_id ==2) ? 1 : $get->_xdelete;
						$module[$get->xparentlabel_id][$get->parent_id]['sub'][$get->xparentmodule_id]['_print'] 	= ($get->xparentmodule_id ==2) ? 1 : $get->_xprint;
						$module[$get->xparentlabel_id][$get->parent_id]['sub'][$get->xparentmodule_id]['_export'] 	= ($get->xparentmodule_id ==2) ? 1 : $get->_xexport;
						
					}

				//return modules only
				$modulenolabels[$get->xparentmodule_id]['xparentmodule_id'] 	= $get->xparentmodule_id;
				$modulenolabels[$get->xparentmodule_id]['parent_id'] 	= $get->parent_id;
				$modulenolabels[$get->xparentmodule_id]['module'] 	= $get->parentmodule;
				$modulenolabels[$get->xparentmodule_id]['_icon'] 	= $get->_icon;
				$modulenolabels[$get->xparentmodule_id]['_url'] 	= $get->_xurl;
				$modulenolabels[$get->xparentmodule_id]['_create'] 	= ($get->xparentmodule_id ==2) ? 1 : $get->_xcreate;
				$modulenolabels[$get->xparentmodule_id]['_read'] 	= ($get->xparentmodule_id ==2) ? 1 : $get->_xread;
				$modulenolabels[$get->xparentmodule_id]['_update'] 	= ($get->xparentmodule_id ==2) ? 1 : $get->_xupdate;
				$modulenolabels[$get->xparentmodule_id]['_delete'] 	= ($get->xparentmodule_id ==2) ? 1 : $get->_xdelete;
				$modulenolabels[$get->xparentmodule_id]['_print'] 	= ($get->xparentmodule_id ==2) ? 1 : $get->_xprint;
				$modulenolabels[$get->xparentmodule_id]['_export'] 	= ($get->xparentmodule_id ==2) ? 1 : $get->_xexport;
				
			}
			$a['nav'] =  $module;
			$a['module'] =  $modulenolabels;

			//print_pre($module);
			$return = $a;
		return $return;
	}

}