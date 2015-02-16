<?php
if(!defined('APPS')) exit ('No direct access allowed');
class form{
	protected $_field_data			= array();
	protected $_config_rules		= array();
	public function post($post){
		unset($_POST[$post]);
		$_post = array();
			foreach( $_POST as $varname => $value ){
				$val = ($value=='on') ? 1 : $value;
						$_post[$varname] = $val;
					
			}
		return $_post;
	}
	
	public function _post($post){
		unset($_POST[$post]);
		$_post = array();
			foreach( $_POST as $varname => $value ){
				$val = ($value=='on') ? 1 : $value;
				$_post[$varname] = r_string($val);
			}
		return $_post;
	}

	public function _serialize($post){
	
		$_post = array();
			foreach( $post as $varname => $value ){
				$val = ($value=='on') ? 1 : $value;
				$_post[$varname] = r_string($val);
			}
		unset($_post['btn_success']);
		return $_post;
	}

	public function get($get = false){
			if ($get == false) {
				# code...
				$_get = array();
					foreach( $_GET as $varname => $value ){
						$val = ($value=='on') ? 1 : $value;
						$_get[$varname] = r_string($val);
					}
				return $_get;
			}else{
				return r_string($_GET[$get]);
			}
	}

	public function valid_email($str){
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
	}

	public function valid_emails($str)
	{
		if (strpos($str, ',') === FALSE)
		{
			return $this->valid_email(trim($str));
		}

		foreach (explode(',', $str) as $email)
		{
			if (trim($email) != '' && $this->valid_email(trim($email)) === FALSE)
			{
				return FALSE;
			}
		}

		return TRUE;
	}

	public function setRules($field,$rules){
			if (count($_POST)) {
				return $this;
			
			}

					if (is_array($field))
		{
			foreach ($field as $row)
			{
				if ( ! isset($row['field']) OR ! isset($row['rules']))
				{
					continue;
				}

				// If the field label wasn't passed we use the field name
				$label = ( ! isset($row['label'])) ? $row['field'] : $row['label'];

				// Here we go!
				$this->setRules($row['field'], $label, $row['rules']);
			}
			return $this;


		}

		if ( ! is_string($field) OR  ! is_string($rules) OR $field == '')
		{
			return $this;
		}

		// Build our master array
		$this->_field_data[$field] = array(
			'field'				=> $field,
			'rules'				=> $rules,
			'is_array'			=> $is_array,
			'keys'				=> $indexes,
			'postdata'			=> NULL,
			'error'				=> ''
		);

		return $this;
	}

}