<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facility extends MY_Controller {
	private $fsm_db;
	private $fr_db;
	function Facility(){
		parent::__construct();
		$this->fsm_db = $this->config->item("fsm_db");
		$this->fr_db = $this->config->item("fr_db");
	}
	
	function reservation(){
		$data['header'] = 'Header Section';
		$data['title'] = 'Reservation';
        $data['footer'] = 'Footer Section';


        $data['userId'] = $this->session->userdata('userId');
        $data['userName'] = $this->session->userdata('userName');

        $this->layout->view('facility/reservation_view', $data);
        
	}
	
	function approveReservation(){
		$data['header'] = 'Header Section';
		$data['title'] = 'Reservation';
        $data['footer'] = 'Footer Section';


        $data['userId'] = $this->session->userdata('userId');
        $data['userName'] = $this->session->userdata('userName');

        $this->layout->view('facility/approve_reservation_view', $data);
        
	}
	
	function createReservation(){
		$input['DATEFROM'] = $this->input->post("DATEFROM");
		$input['DATETO'] = $this->input->post("DATETO");
		$input['FACIIDNO'] = $this->input->post("FACIIDNO");
		$input['PURPOSE'] = $this->input->post("PURPOSE");
		$input['TIMEEND'] = $this->input->post("TIMEEND");
		$input['TIMESTART'] = $this->input->post("TIMESTART");
		
	
        $selected_items_json = $this->input->post('items');
		$selected_items_json = str_replace("\\", "", $selected_items_json);
		$selected_item = json_decode($selected_items_json);
	
		$db = "default";
        $id_field = "CONFIRMNO";
		$fsm_db = $this->config->item("fsm_db");
		$table = "$fsm_db.RESERVATIONS";
		
		$input[$id_field] = $this->lithefire->getNextCharId($db, "RESERVATIONS", $id_field, 10);
		//die($this->lithefire->currentQuery());
		$input['DATEREQUESTED'] = date("Y-m-d");
		$input['REQUESTED_BY'] = $this->session->userdata("userName");
		$input['REQUESTED_BY_ID'] =  $this->session->userdata("userCode");
		$input['STATUS'] = "Pending";
		$input['DCREATED'] = date("Y-m-d");
		$input['TCREATED'] = date("H:i:s");
		$input['DMODIFIED'] = date("Y-m-d");
		$input['TMODIFIED'] = date("H:i:s");
		
		
		if($this->lithefire->countFilteredRows($db, $table, "FACIIDNO = '".$input['FACIIDNO']."' AND DATEFROM = '".$input['DATEFROM']."' 
		AND DATETO = '".$input['DATETO']."' AND TIMESTART = '".$input['TIMESTART']."' AND TIMEEND = '".$input['TIMEEND']."'", "")){
            $data['success'] = false;
            $data['data'] = "A reservation for this facility already exists for this timeslot";
            die(json_encode($data));
        }

        $data = $this->lithefire->insertRow($db, $table, $input);
		foreach($selected_item->data as $key => $value){
			try{
			$item_input['reservation_id'] = $data['id'];
			$item_input['item_id'] = $value;
            $this->lithefire->insertRow($db, "$fsm_db.RESEITEM", $item_input);
			}catch(Exception $e){
				continue;
			}
		}
        die(json_encode($data));
    
	}

	function getReservation(){
		
		
		$this->load->model('lithefire_model', 'lithefire', TRUE);
        $start=$this->input->post('start');
        $limit=$this->input->post('limit');

		$is_approver = $this->input->post("approver");

        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $query = $this->input->post('query');
        $db = "default";
        
		$fsm_db = $this->config->item("fsm_db");
		$fr_db = $this->config->item("fr_db");
		$user_id = $this->session->userdata("userCode");
		
		$filter = "REQUESTED_BY_ID = '$user_id'";
		$group = "";
		$having = "";

        if(empty($sort) && empty($dir)){
            $sort = "DATEREQUESTED DESC";
            
        }else{
        	$sort = "$sort $dir";
        }
		
		if(!empty($query))
			$filter  = "(CONFIRMNO LIKE '%$query%' OR DATEREQUESTED LIKE '%$query%')";
		

        $records = array();
        $table = "$fsm_db.RESERVATIONS a LEFT JOIN $fr_db.FILEFACI b ON a.FACIIDNO = b.FACIIDNO";
        $fields = array("a.*", "b.FACILITY");

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);
        $temp = array();
        $total = 0;
        if($records){
        foreach($records as $row):

            $temp[] = $row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
	}

	function getAllReservations(){
		
		
		$this->load->model('lithefire_model', 'lithefire', TRUE);
        $start=$this->input->post('start');
        $limit=$this->input->post('limit');

		$is_approver = $this->input->post("approver");

        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $query = $this->input->post('query');
        $db = "default";
        
		$fsm_db = $this->config->item("fsm_db");
		$fr_db = $this->config->item("fr_db");
		$user_id = $this->session->userdata("userCode");
		$user_name  = $this->session->userdata("userName");
		
		$filter = "REQUESTED_BY != '$user_name' OR REQUESTED_BY_ID != '$user_id'";
		$group = "";
		$having = "";

        if(empty($sort) && empty($dir)){
            $sort = "DATEREQUESTED DESC";
            
        }else{
        	$sort = "$sort $dir";
        }
		
		if(!empty($query))
			$filter  = "(CONFIRMNO LIKE '%$query%' OR DATEREQUESTED LIKE '%$query%')";
		

        $records = array();
        $table = "$fsm_db.RESERVATIONS a LEFT JOIN $fr_db.FILEFACI b ON a.FACIIDNO = b.FACIIDNO";
        $fields = array("a.*", "b.FACILITY");

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);
        $temp = array();
        $total = 0;
        if($records){
        foreach($records as $row):

            $temp[] = $row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
	}

	function loadReservation(){
		$this->load->model('lithefire_model','lithefire',TRUE);
        $db = "default";
        

        $id=$this->input->post('id');
		$fsm_db = $this->config->item("fsm_db");
		$fr_db = $this->config->item("fr_db");
		
        $table = "$fsm_db.RESERVATIONS a LEFT JOIN $fr_db.FILEFACI b ON a.FACIIDNO = b.FACIIDNO";
		$param = "CONFIRMNO";

        $filter = "$param = '$id'";
        $fields = array("a.CONFIRMNO", "a.DATEREQUESTED", "b.FACILITY", "DATEFROM", "DATETO", "TIMESTART", "TIMEEND", "PURPOSE", "REASON", "REQUESTED_BY");

        $records = array();
        $records = $this->lithefire->getRecordWhere($db, $table, $filter, $fields);

        $temp = array();

        foreach($records as $row):

            $data["data"] = $row;


        endforeach;
        $data['success'] = true;

        die(json_encode($data));
	}
	
	function loadReservedItems(){
        
        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        $db = "default";


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $query = $this->input->post('query');
        $id = $this->input->post('reservation_id');
        $queryby = "";
		
		$filter = "b.reservation_id = '$id'";
		$group = "";
		$having = "";

        if(empty($sort) && empty($dir)){
            $sort = "ITEMIDNO DESC";
        }else{
        	$sort = "$sort $dir";
        }
		
		if(!empty($query)){
			$filter = "ITEM LIKE '%$query%' OR DESCRIPTION LIKE '%$query%'";
		}
		
		$fr_db = $this->config->item("fr_db");
		$fsm_db = $this->config->item("fsm_db");
        $records = array();
        $table = "$fr_db.FACIITEM a JOIN $fsm_db.RESEITEM b ON a.ITEMCODE = b.item_id";
        $fields = array("a.ITEMCODE", "a.ITEMIDNO", "a.ITEM", "a.DESCRIPTION");

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
        if($records){
        foreach($records as $row):
            
            $temp[] = $row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
    }

	function cancelReservation(){
        $db = 'default';
		
        $table = $this->fsm_db.".RESERVATIONS";
        
       // $fields = $this->input->post();
		$param = "CONFIRMNO";
        $id=$this->input->post('id');
        $filter = "$param = '$id'";

        $input = array("STATUS"=>"Cancelled", "MODIFIED_BY"=>$this->session->userdata('userName'), "REASON"=>"Cancelled by requestor");
		$date_today = date("Y-m-d");
        if($this->lithefire->countFilteredRows($db, $table, "CONFIRMNO = '$id' AND STATUS = 'Cancelled' OR (STATUS = 'Approved' AND '$date_today' > DATETO)", "")){
        	
            $data['success'] = false;
            $data['data'] = "This reservation cannot be cancelled";
            die(json_encode($data));
        }


        $data = $this->lithefire->updateRow($db, $table, $input, $filter);
		$data['msg'] = "The reservation has been cancelled";

        die(json_encode($data));
	}

	function approve(){
        $db = 'default';
		
        $table = $this->fsm_db.".RESERVATIONS";
        
       // $fields = $this->input->post();
		$param = "CONFIRMNO";
        $id=$this->input->post('CONFIRMNO');
        $reason = $this->input->post("REASON");
        $filter = "$param = '$id'";
		$date_today = date("Y-m-d");
		
        $input = array("STATUS"=>"Approved", "APPROVER"=>$this->session->userdata('userName'), 
		"APPROVER_ID"=>$this->session->userdata("userCode"), "DMODIFIED"=>$date_today,
		"TMODIFIED"=>date("H:i:s"), "REASON"=>$reason);
		
        if($this->lithefire->countFilteredRows($db, $table, "STATUS != 'Pending' AND CONFIRMNO = '$id'", "")){
            $data['success'] = false;
            $data['data'] = "This reservation cannot be approved";
            die(json_encode($data));
        }


        $data = $this->lithefire->updateRow($db, $table, $input, $filter);
        
		$data['msg'] = "The reservation has been approved";

        die(json_encode($data));
	}

	function deny(){
        $db = 'default';
		
        $table = $this->fsm_db.".RESERVATIONS";
        
       // $fields = $this->input->post();
		$param = "CONFIRMNO";
        $id=$this->input->post('CONFIRMNO');
        $reason = $this->input->post("REASON");
        $filter = "$param = '$id'";
		$date_today = date("Y-m-d");
		
        $input = array("STATUS"=>"Denied", "APPROVER"=>$this->session->userdata('userName'), 
		"APPROVER_ID"=>$this->session->userdata("userCode"), "DMODIFIED"=>$date_today,
		"TMODIFIED"=>date("H:i:s"), "REASON"=>$reason);
		
        if($this->lithefire->countFilteredRows($db, $table, "(STATUS != 'Pending' AND STATUS != 'Approved') AND CONFIRMNO = '$id'", "")){
            $data['success'] = false;
            $data['data'] = "This reservation cannot be denied";
            die(json_encode($data));
        }


        $data = $this->lithefire->updateRow($db, $table, $input, $filter);
        
		$data['msg'] = "The reservation has been denied";

        die(json_encode($data));
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */