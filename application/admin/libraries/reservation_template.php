<?php
class reservation_template{
	public $registry ;
	public function __construct(){
		$this->registry = Registry::getInstance();

	}

	public function fe_template($path,$data,$mvc){

			$data['project_name'] = "Hotel Reservation System";
			$data['property_name'] = "Hotel - Demo Hotel Reservation";
			$data['property_address'] = "Manila, Philippines";
			$data['property_tel'] = "000-00-00";
			//$mvc->render('reservation/template',$data);

			$progress = array('Select Dates','Accommodation','Guest Details','Booking Confirmation');
			$progress_link = array('','accommodation','guest-details','booking-confirmation');

			$data['progress'] = $progress;
			$data['progress_link'] = $progress_link;
			
			$mvc->render('reservation/header',$data);
			$file = APPS.getApplication().DS."views".DS.$path.EXT;
				if (file_exists($file)) {
						$mvc->render($path,$data);
					}else{
						echo "file not found";
					}
			$mvc->render('reservation/footer',$data);
	}
}