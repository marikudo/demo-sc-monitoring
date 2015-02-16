<?php
if(!defined('APPS')) exit ('No direct access allowed');

class hotel_reservation extends crackerjack_model{
	public function __construct(){
		parent::__construct();
	}

	public function prior($daysPrior = 0){
		$date = date("F d, Y");
			if ($daysPrior > 1) {
				$date = date("F d, Y",strtotime("+$daysPrior days",strtotime(date("Y-m-d"))));
			}
		$date2 = date("F d, Y",strtotime("+1day",strtotime($date)));
		$checkin = strtotime($date);
						$checkout = strtotime($date2);
							$diff 	= $checkout - $checkin;
							$no_of_nights 	= floor($diff/(60*60*24));
							$no_of_days 	= $no_of_nights + 1;
						$reservation = array('check_in'=>$date,'check_out'=>$date2,'no_of_nights'=>$no_of_nights,'no_of_days'=>$no_of_days,'label'=> $no_of_nights.' Night(s) / '.$no_of_days.' Days');
						
		//return array('check_in'=>$date,'check_out'=>date("F d, Y",strtotime("+1day",strtotime($date))));
		return $reservation;
	}

	public function availableRooms($postDate){
		$result = array();
			$roomDetails = array();
			$dQueryRoom = "SELECT * FROM _troom_type WHERE status=1";
			$dQueryRoomResult = $this->crud->read($dQueryRoom,array(),"obj");
			$output = array();
			$available_rooms = 0;
				if ($dQueryRoomResult) {
					
					foreach ($dQueryRoomResult as $get) {
						$room_type_id = $get->room_type_id;
						$reserve = 0;
						$room_quantityx = 0;
						$date		= $postDate['check_in'];
						$end_date 	= date("Y-m-d",strtotime("-1 day",strtotime($postDate['check_out'])));
						$noOfNights = 0;
						while (strtotime($date) <= strtotime($end_date)) {
							$noOfNights++;
								$date = date("Y-m-d",strtotime($date));

								$dQuery = "SELECT * FROM _tdailyblockings_and_rates WHERE reference_id=:reference_id AND calendar_date=:calendar_date";
								$aResultx = $this->crud->read($dQuery,array(':reference_id'=>$room_type_id,':calendar_date'=>$date),"assoc");
							
								$dQueryRoom = "SELECT * FROM _troom_type WHERE room_type_id=:reference_id AND status=1";
								$dQueryRoomResult = $this->crud->read($dQueryRoom,array(':reference_id'=>$room_type_id),"assoc");
								//echo count($aResultx);
								//print_r($aResultx);
								$rates = $dQueryRoomResult['rate'];
								$child_rate = $dQueryRoomResult['child_rate'];
								$extra_pax_rate = $dQueryRoomResult['extra_pax_rate'];
								$extra_bed_rate = $dQueryRoomResult['extra_bed_rate'];
								$room_quantity = $dQueryRoomResult['room_quantity'];
								$room_name = $dQueryRoomResult['room_type'];
								$descriptions = $dQueryRoomResult['descriptions'];
								$base_capacity = $dQueryRoomResult['base_capacity'];
								$maxi_capacity = $dQueryRoomResult['maxi_capacity'];
								$maxi_child = $dQueryRoomResult['maxi_child'];
								$extra_bed = $dQueryRoomResult['extra_bed'];
								$extra_pax = $dQueryRoomResult['extra_pax'];

							//	print_pre($aResultx);
							$dQueryx = "SELECT count(tb.bookings_id) as reserve,tbd.calendar_date FROM _tbooking_dates AS tbd LEFT JOIN _tbookings AS tb ON tbd.bookings_id = tb.bookings_id WHERE tbd.reference_id=:reference_id AND tbd.calendar_date =:calendar_date AND tb.booking_status='Confirmed'";
							$aResulty = $this->crud->read($dQueryx,array(':reference_id'=>$room_type_id,':calendar_date'=>$date),"obj");
							

								if ($aResulty[0]->reserve > 0) {
									//print_pre($room_quantity);
								$room_quantity = ($room_quantity - $aResulty[0]->reserve);
								$available_rooms = $available_rooms++;
									if ($aResultx){
											$rates = $aResultx['daily_rates'];
											$extra_bed_rate = $aResultx['extra_bed'];
											$extra_pax_rate = $aResultx['extra_pax_rate'];
									}	

								}
										if($aResultx['blocked'] > 0) {
											$room_quantity = 0;
										}
									$roomDetails[$room_type_id]['room_name'] = $room_name;
									$roomDetails[$room_type_id]['descriptions'] = $descriptions;
									$roomDetails[$room_type_id]['base_capacity'] = $base_capacity;
									$roomDetails[$room_type_id]['maxi_capacity'] = $maxi_capacity;
									$roomDetails[$room_type_id]['maxi_child'] = $maxi_child;
									$roomDetails[$room_type_id]['extra_bed'] = $extra_bed;
									$roomDetails[$room_type_id]['extra_pax'] = $extra_pax;
									$result[$date][$room_type_id]['available_qty'] = $room_quantity;
									$result[$date][$room_type_id]['rates'] = $rates;
									$result[$date][$room_type_id]['extra_pax_rate'] = $extra_pax_rate;
									$result[$date][$room_type_id]['extra_bed_rate'] = $extra_bed_rate;
								
							
							$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
						}
					
					}
					
					//echo $noOfNights;
					$rooms = array();
					foreach ($result as $date => $value) {
						$qty = 0;
						foreach ($value as $room_id => $available) {

								if ($available['available_qty'] > 0) {
									//echo $available;
									if (in_array($room_id, $roomDetails)) {
										# code...
									}
										$rooms[$room_id] = $roomDetails[$room_id];
									$rooms[$room_id]['available_qty'] = $available['available_qty'];
									$rooms[$room_id]['rate'] = $rooms[$room_id]['rate'] + $available['rates'];
									$rooms[$room_id]['extra_pax_rate'] = $rooms[$room_id]['extra_pax_rate'] + $available['extra_pax_rate'];
									$rooms[$room_id]['extra_bed_rate'] = $rooms[$room_id]['extra_bed_rate'] + $available['extra_bed_rate'];
								}else{
									unset($rooms[$room_id]);
								}
						}


					}

					foreach ($rooms as $room_id => $value) {
						$rates = $value['rate'];
						$extra_pax = $value['extra_pax_rate'];
						$extra_bed = $value['extra_bed_rate'];
						$rooms[$room_id]['rate_perNight'] = ($rates * $noOfNights) / $noOfNights;	
						$rooms[$room_id]['pax_rate_perNight'] = ($extra_pax * $noOfNights) / $noOfNights;	
						$rooms[$room_id]['bed_rate_perNight'] = ($extra_bed * $noOfNights) / $noOfNights;

						$rooms[$room_id]['total_room_rate'] = $rates * $noOfNights;
						$rooms[$room_id]['total_extra_pax_rate'] = $extra_pax * $noOfNights;
						$rooms[$room_id]['total_extra_bed_rate'] = $extra_bed * $noOfNights;

					}
					//echo $noOfNights;
					//print_pre($rooms);
					$result['available_rooms'] = $rooms;
					$result['no_of_nights'] = $noOfNights;
					$result['no_of_available_rooms'] = count($rooms);
					
				}
						
			return $result;
	}

	public function accommodation($stack,$dates){
		$accommodation = array();
		$total_perRoom = array();
		$total_perRoomJSON = array();
		$select_room = array();
		$result = array();
		$adult = 0;
		$extra_pax = 0;
		$extra_bed = 0;

		if (count($stack) > 0) {
			if ($dates) {
			$result = $this->availableRooms($dates);
				foreach ($stack as $key => $value) {
					$room_id = $key;
					if (count($value['base_capacity']) > 0) {
						$bed_qty = $value['extra_bed'];
						$pax_qty = $value['extra_pax'];
						foreach ($value['base_capacity'] as $key2 => $rooms) {
							$type = $key2;
							$roomQty = count($rooms);
							//
								//	print_r($rooms);
									$room_total = $result['available_rooms'][$room_id]['total_room_rate'] * $roomQty;
									$total = 0;
									foreach ($rooms as $index => $qty) {
										$xtr_bed_qty = $bed_qty[$type][$index];
										$xtr_pax_qty = $pax_qty[$type][$index];
										$accommodation['accommodation']['rooms'][$room_id]['adult'][$type][$index] += $result['available_rooms'][$room_id]['total_room_rate'];
										$accommodation['accommodation']['details'][$room_id][$type][$index]['room_rate'] = $result['available_rooms'][$room_id]['total_room_rate'];
										$accommodation['accommodation']['details'][$room_id][$type][$index]['total_extra_pax_rate'] = ($result['available_rooms'][$room_id]['total_extra_pax_rate'] * $xtr_bed_qty);
										$accommodation['accommodation']['details'][$room_id][$type][$index]['total_extra_bed_rate'] = ($result['available_rooms'][$room_id]['total_extra_bed_rate'] * $xtr_pax_qty);
										$accommodation['accommodation']['details'][$room_id][$type][$index]['adult'] = $qty;
										$accommodation['accommodation']['details'][$room_id][$type][$index]['extra_pax'] = $xtr_bed_qty;
										$accommodation['accommodation']['details'][$room_id][$type][$index]['extra_bed'] = $xtr_pax_qty;
										$adult = $adult + ($result['available_rooms'][$room_id]['total_room_rate']);
										$extra_bed = $extra_bed + ($result['available_rooms'][$room_id]['total_extra_pax_rate'] * $xtr_bed_qty);
										$extra_pax = $extra_pax + ($result['available_rooms'][$room_id]['total_extra_bed_rate'] * $xtr_pax_qty);
										$total = $room_total + $extra_bed + $extra_pax;
									
									}
							$total_perRoom['total_perRoom'][$room_id] = $total;
							$total_perRoomJSON['total_perRoomJSON'][$room_id]['id'] = $room_id;
							$total_perRoomJSON['total_perRoomJSON'][$room_id]['total'] = $total;
								//}
							}
					}
					$select_room['select_room'][] = $room_id;
				}
			}
		}
		//print_r($total_perRoom);
		$accommodation['accommodation']['total_perRoom'] = $total_perRoomJSON['total_perRoomJSON'];
		$accommodation['accommodation']['adult'] = number_format($adult,2);
		$accommodation['accommodation']['extra_pax'] = number_format($extra_pax,2);
		$accommodation['accommodation']['extra_bed'] = number_format($extra_bed,2);
		$accommodation['accommodation']['grandtotal'] = number_format(($adult + $extra_pax + $extra_bed), 2);
		$accommodation['accommodation']['no_of_nights'] = $result['no_of_nights'];
		//$accommodation['accommodation']['accommodation_details'] = $result;
		return $accommodation;
	}

	public function createBookingDates($bookings_id,$room_id,$type,$reservation){
		$date		= date("Y-m-d",strtotime($reservation['check_in']));
		$end_date 	= date("Y-m-d",strtotime("-1 day",strtotime($reservation['check_out'])));
		$dBookingDates = array();
		$result = 0;
		while (strtotime($date) <= strtotime($end_date)) {
			$dBookingDates['calendar_date'] = $date; 
			$dBookingDates['reference_id'] = $room_id; 
			$dBookingDates['bookings_id'] = $bookings_id; 
			$dBookingDates['reference_type'] = $type;
			$result += $this->crud->create("_tbooking_dates",$dBookingDates); 
			$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
		}
		return $result;
	}

	public function validateGuest($credentials){
		$result = array();
		if ($credentials) {
			$email = $credentials['email'];
			$password = $credentials['password'];
			$gRecord = $this->crud->read("SELECT * FROM _tguest WHERE email=:email AND is_member = 1 AND parent_guest_id = 0",array(":email"=>$email),'assoc');
				if ($gRecord) {
					$dbpasswrod = $this->hash->decryptMe_($gRecord['password']);
					if ($password==$dbpasswrod) {
						unset($gRecord['password']);
						$result = $gRecord;
					}
				}
			}
		return $result;
	}
}