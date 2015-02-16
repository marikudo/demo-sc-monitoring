<?php
if(!defined('APPS')) exit ('No direct access allowed');

class gData extends crackerjack_model{
	public function __construct(){
		parent::__construct();
	}

	public function modules(){
		$mConfig['aColumns'] =  array('','parentmodule','parent_id', 'status','_xcreate','_xread','_xupdate','_xdelete','_xexport','_xprint','_xupload');
		$mConfig['iColumn'] = 'xparentmodule_id';
		$mConfig['tName'] = '_xparentmodule';
		$mConfig['qJoin'] = '';
		return $mConfig;
	}

	public function sample_page(){
		$mConfig['aColumns'] =  array('','first_name','last_name','email','role' ,'x.status','x.date_created','x.last_update');
		$mConfig['iColumn'] = 'xusers_id';
		$mConfig['tName'] = '_xusers';
		$mConfig['qJoin'] = 'as x inner join _xroles as r ON x.xroles_id = r.xroles_id';
		return $mConfig;
	}
		public function user_management(){
		$mConfig['aColumns'] =  array('','first_name','last_name','email','role' ,'x.status','x.date_created','x.last_update');
		$mConfig['iColumn'] = 'xusers_id';
		$mConfig['tName'] = '_xusers';
		$mConfig['qJoin'] = 'as x inner join _xroles as r ON x.xroles_id = r.xroles_id';
		return $mConfig;
	}

	public function role(){
		$mConfig['aColumns'] =  array('','role', 'date_created','last_update','status');
		$mConfig['iColumn'] = 'xroles_id';
		$mConfig['tName'] = '_xroles';
		$mConfig['qJoin'] = '';
		return $mConfig;
	}

	//reservation

	public function room_type(){
		$mConfig['aColumns'] =  array('','room_type','rate','child_rate','room_quantity','extra_pax_rate','extra_bed','extra_pax','extra_bed_rate','base_capacity','maxi_capacity','maxi_child','status','is_plublished', 'updated_at');
		$mConfig['iColumn'] = 'room_type_id';
		$mConfig['tName'] = '_troom_type';
		$mConfig['qJoin'] = '';
		return $mConfig;
	}

	public function promotions(){
		$mConfig['aColumns'] =  array('','promotions_name','discount','discount_specific_amount','discount_percent','selected_room_type','promo_date_start','minimum_stay','promo_date_end','booking_date_start','booking_date_end','selected_days_check','image','status', 'updated_at');
		$mConfig['iColumn'] = 'promotions_id';
		$mConfig['tName'] = '_tpromotions';
		$mConfig['qJoin'] = '';
		return $mConfig;
	}

	public function daily_rates_and_availability(){
		$mConfig['aColumns'] =  array('','dbar.calendar_date','rt.rate','rt.child_rate','rt.extra_pax_rate');
		$mConfig['iColumn'] = 'dbar.id';
		$mConfig['tName'] = '_tdailyblockings_and_rates';
		$mConfig['qJoin'] = 'AS dbar LEFT JOIN _troom_type AS rt';
		return $mConfig;
	}
	
	public function bookings(){
		$mConfig['aColumns'] =  array('','tb.guest_id','transaction_code','check_in','check_out','tg.first_name','tg.last_name','booking_status','total_payment','transaction_date');
		$mConfig['iColumn'] = 'tb.bookings_id';
		$mConfig['tName'] = '_tbookings';
		$mConfig['qJoin'] = 'AS tb INNER JOIN _tguest AS tg ON tb.guest_id = tg.guest_id';
		return $mConfig;
	}
	

	public function services(){
		$mConfig['aColumns'] =  array('','service_name', 'updated_at','status');
		$mConfig['iColumn'] = 'services_id';
		$mConfig['tName'] = '_tservices';
		$mConfig['qJoin'] = '';
		return $mConfig;
	}
	public function service_charges_and_taxes(){
		$mConfig['aColumns'] =  array('','name','percent','specified','is_selected', 'updated_at','status');
		$mConfig['iColumn'] = 'tax_and_charges_id';
		$mConfig['tName'] = '_ttax_and_charges';
		$mConfig['qJoin'] = '';
		return $mConfig;
	}

	public function package_setup(){
		$mConfig['aColumns'] =  array('','package_name', 'p.updated_at','r.room_type','p.status');
		$mConfig['iColumn'] = 'packages_id';
		$mConfig['tName'] = '_tpackages';
		$mConfig['qJoin'] = 'AS p INNER JOIN _troom_type AS r ON p.room_type_id = r.room_type_id';
		return $mConfig;
	}

	public function guest_management(){
		$mConfig['aColumns'] =  array('','first_name', 'last_name','email','contact_number','created_at');
		$mConfig['iColumn'] = 'guest_id';
		$mConfig['tName'] = '_tguest';
		$mConfig['qJoin'] = '';
		return $mConfig;
	}

}