<?php
class FILESERV extends MY_Controller{

		function FILESERV(){
			parent::__construct();
		}


		public function index()
		{
			$data['title'] = "FILESERV | E-Online";
			$data['userId'] = $this->session->userData('userId');
			$data['userName'] = $this->session->userData('userName');
			$this->layout->view('FILESERV/FILESERV_view', $data);
		}

		function getFILESERV(){
        
	        $start=$this->input->post('start');
	        $limit=$this->input->post('limit');
	
	        $sort = $this->input->post('sort');
	        $dir = $this->input->post('dir');
	        $query = $this->input->post('query');
	
	        $records = array();
	        $table = "FILESERV";
	        $fields = array("SERVCODE","SERVIDNO","SERVICE","dcreated","dmodified","created_by","modified_by",);
	        $db = 'fr';
	        $filter = "";
	        $group = "";
			if(empty($sort) && empty($dir)){
	            $sort = "SERVCODE DESC";
	        }else{
	        	$sort = "$sort $dir";
	        }
			
			if(!empty($query)){
 				"(SERVCODE LIKE '%$query%' OR SERVIDNO LIKE '%$query%' OR SERVICE LIKE '%$query%' OR dcreated LIKE '%$query%' OR dmodified LIKE '%$query%' OR created_by LIKE '%$query%' OR modified_by LIKE '%$query%')";
	    	}
			 
			
			
			$records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);
	
	        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
	
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
	        die(json_encode($data));
	    }

		function addFILESERV(){
	        $db = 'fr';
	        $table = "FILESERV";
			$input = $this->input->post();
			
			//uncomment for checking duplicates (change $fieldname)
			$fieldname = 'description';
	        if($this->lithefire->countFilteredRows($db, $table, "SERVIDNO = '".$this->input->post("SERVIDNO")."' AND SERVICE = '".$this->input->post("SERVICE")."'", "")){
	            $data['success'] = false;
	            $data['data'] = "Record already exists";
	            die(json_encode($data));
	        }
	        
	        //uncomment for FRs
			//$input['IDNO'] = $this->lithefire->getNextCharId($db, $table, 'IDNO', 5);
			
	        $data = $this->lithefire->insertRow($db, $table, $input);
	
	        die(json_encode($data));
    	}

		function loadFILESERV(){
	        $db = "fr";
	        
	
	        $id=$this->input->post('id');
	        $table = "FILESERV";
			$param = "SERVCODE";
	
	        $filter = "$param = '$id'";
	        $fields = array("SERVCODE","SERVIDNO","SERVICE","dcreated","dmodified","created_by","modified_by",);
	        $records = array();
	        $records = $this->lithefire->getRecordWhere($db, $table, $filter, $fields);
	
	        $temp = array();
	
	        foreach($records as $row):
	            $data["data"] = $row;
	        endforeach;
	        $data['success'] = true;
	
	        die(json_encode($data));
	    }

		function updateFILESERV(){
	        $db = 'fr';
	
	        $table = "FILESERV";
	        
			$param = "SERVCODE";
	        $id=$this->input->post('id');
	        $filter = "$param = '$id'";
	
	        $input = array();
	        foreach($this->input->post() as $key => $val){
	            if($key == 'id')
	                continue;
	            if(!empty($val)){
	                $input[$key] = $val;
	            }
	        }
			//check for duplicates (change $fieldname)
			$fieldname = 'description';
	        if($this->lithefire->countFilteredRows($db, $table, "$fieldname = '".$this->input->post("$fieldname")."' AND SERVCODE != '$id'", "")){
	            $data['success'] = false;
	            $data['data'] = "Record already exists";
	            die(json_encode($data));
	        }
	
	
	        $data = $this->lithefire->updateRow($db, $table, $input, $filter);
	
	
	        die(json_encode($data));
	    }

		function deleteFILESERV(){
	        $table = "FILESERV";
	        $param = "SERVCODE";
	       
			$db = "fr";
	        $id=$this->input->post('id');
			$filter = "$param = '$id'";
	
	        $data = $this->lithefire->deleteRow($db, $table, $filter);
	
	        die(json_encode($data));
	    }

}