<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends MY_Controller {
	/*
	* Controller::Pages for SomanyFoam Admin.
	* Created By Aditya Das, 16-Jan-12
	* Accessed via http://hostname/index.php/admin/contacts
	*/
	private $RPath;
	private $data = array();
	
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('admin_menu');
		$this->load->model('rooms');
		$this->load->model('rooms_catg');
		$this->load->model('rooms_reservation');	
		$this->load->model('rooms_cancellation');	
		$this->load->library('form_validation');	 // load form validation library	
		$this->data['admin_menu'] = $this->admin_menu->getEntries();	// admin menu items array
		$this->data['RPath'] = base_url() . 'resources/';	// resources folder  locations
		$this->data['ErrMsg'] = null;					   // keeps the page error message
	}
	
	
	
	
	public function index()
	{
		$this->data['rooms_catg_details'] = $this->rooms_catg->getEntries();
		showPage('booking', $this->data);
	}
	
	
	
	
	public function fetchRoomDetails()
	{
		$catg_id = $this->input->post('catg_id');
		$frm_date = $this->input->post('frm_date');
		$to_date = $this->input->post('to_date');
		if(empty($catg_id))
		{
			return false;
		}
		$catg_id = $catg_id == 'all' ? '' : $catg_id;
		$arr_rooms_details = $this->rooms->getEntries($catg_id);
		
		// find reservation statsu of room between start & end date
		foreach($arr_rooms_details as $room_details)
		{
			$room_reserve_info = $this->rooms_reservation->getReserveInfoByRoomNo($room_details->room_no);
			$reserve_status = 'Available';
			foreach($room_reserve_info as $reserve)
			{
				$arr_reserve_dates = createDateArray($reserve->book_start_date, $reserve->book_end_date);
				$arr_request_dates = createDateArray($frm_date, $to_date);
				$merged_array = array_unique(array_merge($arr_reserve_dates, $arr_request_dates));
				if( count($merged_array) != (count($arr_reserve_dates) + count($arr_request_dates)) )
				{
					$reserve_status = 'Booked';
					break;
				}
			}
			$room_details->book_status = $reserve_status;
		}
		echo json_encode($arr_rooms_details);
	}
	
	
	
	
	public function fetchRoomsByCatg()
	{
		$temp_post_data = $this->input->post(NULL, TRUE);
		if( ! empty($temp_post_data['catg_id']))
		{
			$temp_post_data['catg_id'] == 'all' ? $temp_post_data['catg_id'] = '' : '';
			echo json_encode($arr_room_list = $this->rooms->getEntries($temp_post_data['catg_id']));
			return;
		}
	}
	
	
	
	
	public function saveBookingData()
	{	
		$temp_post_data = $this->input->post(NULL, TRUE);  // returns all POST items with XSS filter 
		foreach($temp_post_data as $key => $data)
		{
			if(empty($data) && $key != 'guest_add2')
			{
				$json_array = array('error' => true, 'message' => 'Some fields are left blank');
				echo json_encode($json_array);
				return false;
			}
		}
		$temp_post_data['guest_usr_id'] = $this->session->userdata('usr_id');
		$temp_post_data['guest_book_date'] = date('d F Y');
		$temp_post_data['guest_book_code'] = date('dmYhis');	// create unique booking id for each room
		$arr_rate = $this->rooms->getAllCharges($temp_post_data['charge_type']);  
		
		$this->db->trans_begin();	// begin transaction
		foreach($temp_post_data['arr_roomno'] as $room)
		{
			if( ! $this->rooms_reservation->addEntry($room, $arr_rate[$room], $temp_post_data))
			{
				$this->db->trans_rollback();	// rollback transaction
				$json_array = array('error' => true, 'message' => 'Some database error occured');
				echo json_encode($json_array);
				return false;
			}
		}
		$this->db->trans_commit();	// commit transaction
		$json_array  = array('error' => false, 
							  'message' => '<strong>Booking made for -</strong>'.
										'<br>Room no(s). :'.implode(', ',$temp_post_data['arr_roomno']).
										'<br>From : '.$temp_post_data['book_from_date'].' To : '.$temp_post_data['book_from_date'].
										'<br>For : '.$temp_post_data['guest_name'].
										'<br><strong>Booking Code -</strong><br>'.$temp_post_data['guest_book_code'].
										'<br>mention this code while editing / deleting booking.'
							);
		echo json_encode($json_array);
		return true;
	}
	
	
	
	
	public function fetchRoomBookStatus()
	{	
		$temp_post_data = $this->input->post(NULL, TRUE);  // returns all POST items with XSS filter 
		foreach($temp_post_data as $key => $data)
		{
			if(empty($data))
			{
				return false;
			}
		}
		$json_array = array();
		$arr_request_dates = createDateArray($temp_post_data['frm_dt'], $temp_post_data['to_dt']);
		
		foreach($temp_post_data['arr_room_no'] as $room_no)
		{
			$room_reserve_info = $this->rooms_reservation->getReserveInfoByRoomNo($room_no);
			$arr_reserve_dates = $arr_temp_reserve_dates = $arr_unreserved_dates = $arr_reserve_id = array();
			foreach($room_reserve_info as $reserve)
			{
				$arr_temp_reserve_dates = createDateArray($reserve->book_start_date, $reserve->book_end_date);
				foreach($arr_temp_reserve_dates as $val)
				{
					$arr_reserve_dates[] = $val;
					$arr_reserve_id[$val] = $reserve->id;
				}
			}
			$arr_reserve_dates = array_intersect($arr_request_dates, $arr_reserve_dates);
			$arr_unreserved_dates = array_diff($arr_request_dates, $arr_reserve_dates);
			if(count($arr_reserve_dates) > 0)
			{
				$arr_reserve = array_fill(0, count($arr_reserve_dates), "Booked");
				$arr_reserve_dates = array_combine($arr_reserve_dates, $arr_reserve);
			}
			if(count($arr_unreserved_dates) > 0)
			{
				$arr_unreserve = array_fill(0, count($arr_unreserved_dates), "Available");
				$arr_unreserved_dates = array_combine($arr_unreserved_dates, $arr_unreserve);
			}
			
			$merged_array = $arr_reserve_dates + $arr_unreserved_dates; 
			ksort($merged_array);
			
			$arr_room_stat = array();
			foreach($merged_array as $key => $val)
			{
				$arr_room_stat[] = array_key_exists($key, $arr_reserve_id) ?  array('dt' => date('d F Y', $key), 'status' => $val, 'id' => $arr_reserve_id[$key]) : array('dt' => date('d F Y', $key), 'status' => $val, 'id' => '');
			}
			
			$json_array[] = array('room_no' => $room_no, 'booking_details' => $arr_room_stat);
		}
		echo json_encode($json_array);
		return true;
	}
	
	
	
	
	
	public function fetchBookDetails()
	{
		$temp_post_data = $this->input->post(NULL, TRUE);  // returns all POST items with XSS filter 
		foreach($temp_post_data as $key => $data)
		{
			if(empty($data))
			{
				$json_array  = array('error' => true, 'message' => 'Some error occured');
				echo json_encode($json_array);
				return;
			}
		}
		$booking_details = $this->rooms_reservation->getEntries($temp_post_data['booking_id']);
		$charge_type = $booking_details[0]->charge_type == 'sess' ? 'Sessional' : 'Off Sessional';
		$message = '<div class="row-fluid booking_details">'.
				   'Booked For : '.$booking_details[0]->guest_name.
				   '<br>From : '.$booking_details[0]->book_start_date.
				   '<br>To : '.$booking_details[0]->book_end_date.
				   '<br>Charge Type : '.$charge_type.
				   '<hr></hr>'.
				   'Booked By : '.$booking_details[0]->booked_admin.
				   '<br>Receipt No. : '.$booking_details[0]->receipt_no.
				   '<br>Booked On : '.$booking_details[0]->booking_date.
				   '</div>';
		$all_rooms = $this->rooms_reservation->getRoomsUnderBookedId($booking_details[0]->booking_code);
		$message_details = '<div class="span5 offset1 form-actions">'.
							'<p><strong>Guest Name : </strong>' . $booking_details[0]->guest_name . '</p>' .
							'<p><strong>From : </strong>'.$booking_details[0]->book_start_date . '</p>' .
				   			'<p><strong>To : </strong>'.$booking_details[0]->book_end_date . '</p>' .
							'<p><strong>Rooms Booked : </strong>'. implode(', ', $all_rooms). '</p>' .
							'<p><strong>Booking Code : </strong>'.$booking_details[0]->booking_code . '</p>' .
							'<p><strong>Receipt No. : </strong>'.$booking_details[0]->receipt_no. '</p>' .
				   			'<p><strong>Booked On : </strong>'.$booking_details[0]->booking_date. '</p>' .
							'<p><strong>Booked By : </strong>'.$booking_details[0]->booked_admin. '</p>' .
							'</div>'.
							'<div class="span5 form-actions">'.
							'<p><strong>Guest Address 1 : </strong>'. $booking_details[0]->guest_add1 . '</p>' .
							'<p><strong>Guest Address 2 : </strong>'.$booking_details[0]->guest_add2 . '</p>' .
							/*'<p><strong>Guest Country : </strong>'.$booking_details[0]->country . '</p>' .*/
				   			'<p><strong>Guest Phone : </strong>'.$booking_details[0]->guest_phone . '</p>' .
							'<p><strong>Guest Mobile : </strong>'.$booking_details[0]->guest_mobile. '</p>' .
							'<p><strong>Guest Email : </strong>'.$booking_details[0]->guest_email . '</p>'.
							'</div>';
							
		$json_array  = array('error' => false, 'message' => $message, 'message_details' => $message_details, 'roomnos' => $all_rooms, 'book_id' => $booking_details[0]->booking_code );
		echo json_encode($json_array);
		return;
	}
	
	
	
	
	public function cancelBooking()
	{
		$temp_post_data = $this->input->post(NULL, TRUE);  // returns all POST items with XSS filter 
		foreach($temp_post_data as $key => $data)
		{
			if(empty($data))
			{
				$json_array  = array('error' => true, 'message' => 'Some error occured');
				echo json_encode($json_array);
				return;
			}
		}
		$temp_post_data['requester_usr_id'] = $this->session->userdata('usr_id');
		$temp_post_data['request_date'] = date('d F Y');
		if($this->rooms_cancellation->addEntry($temp_post_data))
		{
			$json_array  = array('error' => false, 'message' => 'Cancellation request sent');
			echo json_encode($json_array);
			return;
		}
		else
		{
			$json_array  = array('error' => true, 'message' => 'Some error occured');
			echo json_encode($json_array);
			return;
		}
	}
}

/* End of file contacts.php */
/* Location: ./application/controllers/admin/contacts.php */