<?php
if(!defined('APPS')) exit ('No direct access allowed');
class api extends crackerjack{

	private $status;
	public function __construct(){
		parent::__construct();
			if ($this->session->_get('adminlogin')==false) {
				redirect('admin/home/auth');
			}

			if (isAjax()==false) {
				redirect('admin/home/auth');
			}

	}

	public function index($id = false){
		require_once('system/core/error.php');
	}

	public function isexist($get){
		$result = 'true';
		$email = r_string($_GET['inputEmail']);
		$g = $this->crud->read("SELECT email FROM _users WHERE email = :email LIMIT 0,1",array(':email'=>$email),'assoc');
		if($g){
			$result = "false";
			if ( ($g['email']==$get[0]) && ($get[1]=="edit") ) {
				$valid = "true";
			}
		}

		echo $result;

	}

	public function usernameisexists($get){
		$result = 'true';
		$email = r_string($_GET['email']);
		$current = r_string($_GET['current']);
		$g = $this->crud->read("SELECT email FROM _employee WHERE email = :email LIMIT 0,1",array(':email'=>$email),'assoc');
		if($g){
			$result = "false";
			if ($g['email']==$current && strtolower(r_string($get[0]))=="edit") {
				$result = "true";
			}

		}
	//	print_pre($get);

		echo $result;

	}



	public function doesexists($get){

			if (isset($_GET['gConf'])) {
				$gConfig = unserialize(base64_decode($_GET['gConf']));
				extract($gConfig['uPermission']);
			}
				//print_pre($gConfig);
				$aModule = trim(strtolower($module));
				$aModule = str_replace(' ', '_', $aModule);
				$mxConfig = $this->gData->$aModule();
				$sIndexColumn = $mxConfig['iColumn'];
				$sTable = $mxConfig['tName'];
				$value = end($_GET);
				$aColumnx = key($_GET);
				$current = html_entity_decode(r_string($_GET['current']));

				$result = 'true';
				$dbResult = $this->crud->read("SELECT $aColumnx FROM $sTable WHERE $aColumnx = :val LIMIT 0,1",array(':val'=>$value),'assoc');

				if($dbResult){
					$result = "false";
					//echo $dbResult[$aColumnx]."--".$current."-".strtolower(r_string($get[0]));
					if (strtolower($dbResult[$aColumnx])==strtolower($current) && strtolower(r_string($get[0]))=="edit") {
						$result = "true";
					}

				}
				echo $result;
			$this->db->dbClose();

	}

	public function coldoesexists($get=false){
		if (isset($_GET['gConf'])) {
				$gConfig = unserialize(base64_decode($_GET['gConf']));
				extract($gConfig);
			}

			$current = html_entity_decode(r_string($_GET['current']));
			$aColumn = $iColumn;
			$sTable = $tName;
			$value = $_GET[$aColumn];
			$result = 'true';
				$dbResult = $this->crud->read("SELECT $aColumn FROM $sTable WHERE $aColumn = :val LIMIT 0,1",array(':val'=>$value),'assoc');
				if($dbResult){
					$result = "false";
					if ($dbResult[$aColumn]==$current && strtolower(r_string($get[0]))=="edit") {
						$result = "true";
					}

				}
				echo $result;
			$this->db->dbClose();

	}

	public function dactive($id = false){
		if (isset($_POST['act'])) {
			if (isset($_GET['gConf'])) {
				$gConfig = unserialize(base64_decode($_GET['gConf']));
				extract($gConfig['uPermission']);
			}

				$aModule = trim(strtolower($module));
				$aModule = str_replace(' ', '_', $aModule);
				$mxConfig = $this->gData->$aModule();
				$row = $_POST['row'];
				$sIndexColumn = $mxConfig['iColumn'];
				$sTable = $mxConfig['tName'];
				$sts = isset($_POST['status']) ? $_POST['status'] : $id[0];
				$data['status'] =$sts;
				$aResult = 0;
				if (is_array($row)) {
					foreach ($row as $value) {
						$tid = $this->hash->decryptMe_($value);
					$aResult =+ $this->crud->update($sTable,$data,array($sIndexColumn=>$tid));
					}
				}else{
					$tid = $this->hash->decryptMe_($row);
					$aResult = $this->crud->update($sTable,$data,array($sIndexColumn=>$tid));
				}

				echo $aResult;
			$this->db->dbClose();
		}
	}

	public function published($id = false){
		if (isset($_POST['act'])) {
			if (isset($_GET['gConf'])) {
				$gConfig = unserialize(base64_decode($_GET['gConf']));
				extract($gConfig['uPermission']);
			}

				$aModule = trim(strtolower($module));
				$aModule = str_replace(' ', '_', $aModule);
				$mxConfig = $this->gData->$aModule();
				$row = $_POST['row'];
				$sIndexColumn = $mxConfig['iColumn'];
				$sTable = $mxConfig['tName'];
				$sts = isset($_POST['status']) ? $_POST['status'] : $id[0];
				$data['is_plublished'] =$sts;
				$aResult = 0;
				if (is_array($row)) {
					foreach ($row as $value) {
						$tid = $this->hash->decryptMe_($value);
					$aResult =+ $this->crud->update($sTable,$data,array($sIndexColumn=>$tid));
					}
				}else{
					$tid = $this->hash->decryptMe_($row);
					$aResult = $this->crud->update($sTable,$data,array($sIndexColumn=>$tid));
				}

				echo $aResult;
			$this->db->dbClose();
		}
	}

	public function action(){
		if($_POST['_delete']){
			if (isset($_GET['gConf'])) {
				$gConfig = unserialize(base64_decode($_GET['gConf']));
				extract($gConfig['uPermission']);
			}
				$aModule = trim(strtolower($module));
				$aModule = str_replace(' ', '_', $aModule);
				$mxConfig = $this->gData->$aModule();
				$row = $_POST['row'];
				$id = $this->hash->decryptMe_($row);
				$sIndexColumn = $mxConfig['iColumn'];
				$sTable = $mxConfig['tName'];
				switch(strtolower($aModule)){
					case 'user_management':
						$_xusers = $this->crud->read('SELECT * FROM _xusers WHERE xusers_id = :id',array(':id'=>$id),'assoc');
						$this->crud->delete($sTable,array($sIndexColumn=>$id));
						echo $this->crud->delete('_xroles',array('xroles_id'=>$_xusers['xroles_id']));
					break;
					default:
					echo $this->crud->delete($sTable,array($sIndexColumn=>$id));
					break;
				}
			



			$this->db->dbClose();
		}
	}

	public function data(){
		//config
		if (isset($_GET['gConf'])) {
			$gConfig = unserialize(base64_decode($_GET['gConf']));
			extract($gConfig['uPermission']);
			}
		//	echo $_url;
		//print_r($gConfig['uPermission']);
		$aModule = trim(strtolower($module));
		$aModule = str_replace(' ', '_', $aModule);
		$mxConfig = $this->gData->$aModule();
		$aColumns =$mxConfig['aColumns'];
		$sIndexColumn = $mxConfig['iColumn'];
		$sTable = $mxConfig['tName']." ".$mxConfig['qJoin'];
		//$sTable = $mxConfig['qJoin'];

		//print_r($gConfig);

		//Paging
		$sLimit = "";
			if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
			{
				$sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
					intval( $_GET['iDisplayLength'] );
			}

		/*
		 * Ordering
		 */
		$sOrder = "";
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
				{

					/*$aSort = $aColumns[ intval( $_GET['iSortCol_'.$i] ) ];
						if ($aSort=='status') {
							$aSort = 'status';
						}*/
						$aSort = preg_replace("/[a-zA-Z0-9_]*+./","$2", $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]);
					$sOrder .= "`".$aSort."` ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
				}
			}

			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "";
			}
		}




		$sWhere = "";
		$aWhere = array();
		if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
				{
					$sWhere .= $aColumns[$i]." LIKE :".$aColumns[$i]." OR ";
					$aWhere[':'.$aColumns[$i]] = $_GET['sSearch'].'%';
				}
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= '';
		}

		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
			{
				if ( $sWhere == "" )
				{
					$sWhere = "WHERE (";
				}
				else
				{
					$sWhere .= " AND ";
				}
				$sWhere .= $aColumns[$i]." LIKE '".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			}
		}
		if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
		{
		$sWhere .=") ";
		}
		//print_pre($_SESSION);
	//	echo $aModule;
		switch ($aModule) {
			case 'role':
					if ($sWhere!="") {
						$sWhere .= 'AND xroles_id > 1 AND xroles_id!='.$this->session->_get('role_id').' AND is_specific=0';
					}else{
						$sWhere = ' WHERE xroles_id > 1 AND xroles_id!='.$this->session->_get('role_id').' AND is_specific=0';
					}
				break;
			case 'user_management':
					if ($sWhere!="") {
						$sWhere .= 'AND x.xusers_id > 2 AND x.xusers_id!='.$this->session->_get('user_id').'';
					}else{
						$sWhere = ' WHERE x.xusers_id > 2 AND .x.xusers_id!='.$this->session->_get('user_id').'';
					}

				break;
			case 'modules':
					if ($sWhere!="") {
						$sWhere .= ' AND (xparentmodule_id > 1)';
					}else{
						$sWhere .= 'WHERE xparentmodule_id > 1';
					}
				break;


			default:
				# code...
				break;
		}
		/*
		 * SQL queries
		 * Get data to display
		 */
		$sQuery = "SELECT $sIndexColumn,".str_replace(" , ", " ", implode(", ", array_filter($aColumns)))." FROM $sTable $sWhere $sOrder $sLimit";
		 $sQueryx = "SELECT $sIndexColumn,".str_replace(" , ", " ", implode(", ", array_filter($aColumns)))." FROM $sTable $sWhere $sOrder";
		//echo $sQuery;
		$result = $this->crud->read($sQuery,$aWhere,'obj');
		$count = $this->crud->read($sQueryx,$aWhere,'obj');

		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => count($result),
			"iTotalDisplayRecords" => count($count),
			"aaData" => array()
		);
			if (count($result) > 0) {
				$ctr = 1;
				foreach ($result as $v) {
					$row = array();
					for ( $i=0 ; $i<count($aColumns) ; $i++ ){
						if ($aColumns[$i]!="") {
							$mCol = preg_replace("/[a-zA-Z0-9_]*+./","$2",$aColumns[$i]);
							$row[$mCol] = $v->$mCol;

								switch ($aModule) {
									case 'promotions':
									//'discount','discount_specific_amount','discount_percent'

										if ($mCol=="booking_date_start") {
												$a = date('M j, Y',strtotime($v->$mCol))." - ".date('M j, Y',strtotime($v->booking_date_end));
											$row['booking_date'] = $a;
										}

										if ($mCol=="promo_date_start") {
												$a = date('M j, Y',strtotime($v->$mCol))." - ".date('M j, Y',strtotime($v->promo_date_end));
											$row['stay_date'] = $a;
										}
									break;
									default:
									break;
								}

								if ($mCol=="discount") {
									//$a = ($v->$mCol==1) ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-warning'>Deactive</span>";
										$a = $v->discount_percent."%";
										if ($v->$mCol==1) {
											$a = number_format($v->discount_specific_amount,2);
										}
									$row[$mCol] = $a;
								}
								if ($mCol=="avatar") {
										$img = '<img src="'.base_url().'uploads/avatar/no_avatar.jpg" style="width:30px" />';
										$img2 = '<img src="'.base_url().'uploads/avatar/'.$v->$mCol.'" style="width:30px" />';
									$row['image'] = ( $v->$mCol=='' || $v->$mCol==null) ? $img : $img2;
								}

								if ($mCol=="status") {
										$a = ($v->$mCol==1) ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-warning'>Deactive</span>";

									$row[$mCol] = $a;
								}

								if ($mCol=="is_plublished") {
										$a = ($v->$mCol==1) ? "<span class='badge badge-success'>Published</span>" : "<span class='badge badge-warning'>Demo</span>";

									$row[$mCol] = $a;
								}
								if ($mCol=="is_selected") {
										$a = ($v->$mCol==1) ? "Amount" : "%";

									$row[$mCol] = $a;
								}
								if ($mCol=="date_created") {
										$a = date('F j, Y H:s a',strtotime($v->$mCol));
									$row[$mCol] = $a;
								}
								if ($mCol=="last_update") {
										$a = date('F j, Y H:s a',strtotime($v->$mCol));
									$row[$mCol] = $a;
								}

								if ($mCol=="rate") {
										$a = number_format($v->$mCol,2);
									$row[$mCol] = $a;
								}

								if ($mCol=="child_rate") {
										$a = number_format($v->$mCol,2);
									$row[$mCol] = $a;
								}

								if ($mCol=="extra_pax_rate") {
										$a = number_format($v->$mCol,2);
									$row[$mCol] = $a;
								}

								if ($mCol=="extra_bed_rate") {
										$a = number_format($v->$mCol,2);
									$row[$mCol] = $a;
								}

								if ($mCol=="_xcreate" || $mCol=="_xread" || $mCol=="_xupdate" || $mCol=="_xdelete" || $mCol=="_xexport" || $mCol=="_xprint" || $mCol=="_xupload") {
									$a = ($v->$mCol==1) ? "<i class='fa fa-check green'></i>" : "<i class='fa fa-times red'></i>";
									$row[$mCol] = $a;
								}


						}
					}


					$sLabel = ($v->status==1) ? 'Deactive' : 'Activate';
					 $sLabelx = ($v->status==1) ? 0 : 1;

					 $activate   = "<a href='javascript:void()' onClick=\"fActivate(".$ctr.",'".genKey($v->$sIndexColumn)."','".$_GET['gConf']."','".$sLabelx."')\" class='activate actions' data-toggle='modal' data-index='".($ctr)."' id='".genKey($indxColumn)."'><i class='fa fa-check green w16'></i> ".$sLabel."</a>";
					 $delete   = "<a href='javascript:void()' onClick=\"fDelete(".$ctr.",'".genKey($v->$sIndexColumn)."','".$_GET['gConf']."')\" class='delete actions' data-toggle='modal' data-index='".($ctr)."' id='".genKey($v->$sIndexColumn)."'><i class='fa fa-times red w16'></i></a>";
      				 $edit     = "<a href='".base_url('xhrs/'.$_url).'/modify/'.genKey($v->$sIndexColumn)."' class='actions'><i class='fa fa-pencil w16' style='color:orange'></i></a>";
      				 $view     = "<a href='".base_url('xhrs/'.$_url).'/view/'.genKey($v->$sIndexColumn)."' class='actions'><i class='fa fa-pencil w16' style='color:orange'></i></a>";


      				 	$Last = ($ctr >=8) ? '-115px' : '-28px';
				      $button = '';
					 $dropdown ='<ul class="nav navbar-nav navbar-left action-dropdown " style="width: 42px;margin: 0 auto;">';
				      $dropdown .='       <li class="dropdown">';
				      $dropdown .='         <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="width:25px;padding:0;text-align:center"><i class="fa fa-gear gray"></i> <b class="caret"></b></a>';
				      $dropdown .='        <ul class="dropdown-menu" role="menu" aria-labelledby="user-dropdown" style="border-radius: 0px;margin-top: '.$Last.';">';
				      if ($_update==1) {
				      	//$a = '<li>'.$edit.'</li>';
				      	$a = $edit;
				      			if(strtolower($module)=='role' && $xparentmodule_id ==3 && $v->xroles_id==2 ) {
				      				$a = '';
				      			}
				      	$button .= $a;
				      		//if(strtolower($module)!='role' && $xparentmodule_id !=3 && $v->xroles_id!=2 ) {
				      			$dropdown .='       ';
				      		//}
				      	//$dropdown .='        <li>'.$activate.'</li>';
				      }

				        if ($_read==1 && strtolower($module)=='role' && $xparentmodule_id ==3 && $v->xroles_id==2 ) {
				      	# code...
				      	$button .=$view;
				      	//$dropdown .='        <li>'.$activate.'</li>';
				      }

				      if ($_delete==1) {
				      	if (strtolower($module)!='role' && strtolower($module)!='users') {
				      		$button .=$delete;
				      	}else if(($v->$sIndexColumn > 2 && strtolower($module)=='role') || ($v->$sIndexColumn > 2 && strtolower($module)=='users' )){
				      		$button .=$delete;
				      	}
				      }
				      $dropdown .='        <li class="divider"></li>';

				      $dropdown .='         </ul>';
				      $dropdown .='       </li>';
				      $dropdown .='     </ul>';


				    $row['DT_RowId'] = genKey($v->$sIndexColumn);
					$row['checkbox'] = '<input type="checkbox"/>';
					$row['button'] = "<center>".$button."</center>";
					$output['aaData'][] = $row;
					$ctr++;
				}
			}
		header('Content-Type: application/json');
		echo json_encode($output);
	}




}