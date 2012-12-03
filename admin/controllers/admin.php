<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//include_once 'PHPExcel177/Classes/PHPExcel/Shared/PDF/tcpdf.php';
require_once 'PHPExcel177/Classes/PHPExcel.php';
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');

class Admin extends MY_Controller {
	
	function Admin(){
		parent::__construct();
		
	}
	
	function curriculum(){
		$data['title'] = 'Student Web Portal: Student Profile';
        $data['userId'] = $this->session->userData('userId');
        $data['userName'] = $this->session->userData('userName');

        $this->layout->view('admin/curriculum_setup_view', $data);
	}
	
	function getAllCurriculum(){
        
        $db = "default";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        
        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');
        $filter = "";
        $group = "";

        if(empty($sort) && empty($dir)){
            $sort = "CURRIDNO DESC";
        }else{
            $sort = "$sort $dir";
        }

        $fr_db = $this->config->item("fr_db");

        $records = array();
        $table = "CURRICULUM a LEFT JOIN $fr_db.FILECOUR b ON a.COURIDNO = b.COURIDNO";
		
        $fields = array("a.CURRIDNO", "a.DESCRIPTION", "a.COURIDNO", "b.COURSE");

        

        if(!empty($querystring))
            $filter = "(CURRIDNO LIKE '%$querystring%' OR DESCRIPTION LIKE '%$querystring%')";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
        if($records){
        foreach($records as $row):
          //  $row['COURSE'] = $this->commonmodel->getFieldWhere($db, "FILECOUR", "COURIDNO", $row['COURIDNO'], "COURSE");
            $temp[] = $row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, "");
        die(json_encode($data));
	}

	function addCourseCurriculum(){        
        $db = 'default';
        $table = "CURRICULUM";
		$input = $this->input->post();
        if($this->lithefire->countFilteredRows($db, $table, "COURIDNO = '".$this->input->post("COURIDNO")."'", "")){
            $data['success'] = false;
            $data['data'] = "Record already exists for this course";
            die(json_encode($data));
        }
        
		$input['CURRIDNO'] = $this->lithefire->getNextCharId($db, $table, 'CURRIDNO', 5);
        $data = $this->lithefire->insertRow($db, $table, $input);

        die(json_encode($data));
    }

	function loadCourseCurriculum(){
        
        $db = "default";
        

        $id=$this->input->post('id');
		
		$fr_db = $this->config->item("fr_db");
		
        $table = "CURRICULUM a LEFT JOIN $fr_db.FILECOUR b ON a.COURIDNO = b.COURIDNO";
        $fields = array("a.CURRIDNO", "a.DESCRIPTION", "a.COURIDNO", "b.COURSE");
		$param = "CURRIDNO";

        $filter = "$param = '$id'";
        

        $records = array();
        $records = $this->lithefire->getRecordWhere($db, $table, $filter, $fields);

        $temp = array();

        foreach($records as $row):

            $data["data"] = $row;


        endforeach;
        $data['success'] = true;

        die(json_encode($data));
    }
    
	function updateCourseCurriculum(){
        $db = 'default';

        $table = "CURRICULUM";
        
       // $fields = $this->input->post();
		$param = "CURRIDNO";
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

        if($this->lithefire->countFilteredRows($db, $table, "COURIDNO = '".$this->input->post("COURIDNO")."' AND CURRIDNO != '$id'", "")){
            $data['success'] = false;
            $data['data'] = "Record already exists";
            die(json_encode($data));
        }


        $data = $this->lithefire->updateRow($db, $table, $input, $filter);


        die(json_encode($data));
    }
	
	function deleteCourseCurriculum(){
        

        $table = "CURRICULUM";
        $param = "CURRIDNO";
       // $fields = $this->input->post();
		$db = "default";
        $id=$this->input->post('id');
		$COURIDNO=$this->input->post('COURIDNO');
		$filter = "$param = $id";
		$this->lithefire->deleteRow($db, "CURRSUBJ", "COURIDNO = '$COURIDNO'");
        $data = $this->lithefire->deleteRow($db, $table, $filter);
		

        die(json_encode($data));
    }
	
	function getCurriculumSubjects(){
        
        $db = "default";
		
		$COURIDNO=$this->input->post('COURIDNO');

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        
        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');
        $filter = "COURIDNO = '$COURIDNO'";
        $group = "";

        if(empty($sort) && empty($dir)){
            $sort = "YEAR ASC, CODE ASC";
        }else{
            $sort = "$sort $dir";
			if($sort == 'YEAR')
				$sort = "$sort $dir, CODE ASC";
        }

        $fr_db = $this->config->item("fr_db");

        $records = array();
        $table = "CURRSUBJ a LEFT JOIN $fr_db.FILESTLE b ON a.YEAR = b.YEAR LEFT JOIN $fr_db.FILESUBJ c ON a.SUBJIDNO = c.SUBJIDNO";
		
        $fields = array("a.YEAR", "a.SUBJIDNO", "a.COURIDNO", "c.SUBJCODE", "c.COURSEDESC", "b.DESCRIPTIO");

        

        if(!empty($querystring))
            $filter .= "AND (YEAR LIKE '%$querystring%' OR SUBJCODE LIKE '%$querystring%' OR COURSEDESC LIKE '%$querystring%')";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
		
		
        if($records){
        		$first_level = $records[0]['YEAR'];
				$ctr = 0;
        	
        foreach($records as $row):
          //  $row['COURSE'] = $this->commonmodel->getFieldWhere($db, "FILECOUR", "COURIDNO", $row['COURIDNO'], "COURSE");
          $row['SUBJECT'] = "(".$row['SUBJCODE'].") ".$row['COURSEDESC'];
		  if($row['YEAR'] == $first_level && $ctr != 0)
		  $row['YEAR'] = "";
		  else{
		  $first_level = $row['YEAR'];
		  if($ctr != 0)
		  $temp[] = array();
		  }
		  
		  if(!empty($row['YEAR']))
		  $row['YEAR'] = $row['YEAR']." - ".$row['DESCRIPTIO'];
		  $prereq = $this->lithefire->getAllRecords("default", "PREREQ", array("PREREQ"), "", "", "", "SUBJIDNO = '".$row['SUBJIDNO']."' AND COURIDNO = '".$row['COURIDNO']."'", "");
		  if($prereq){
		  $prerequisite = array();
		  foreach($prereq as $r){
		  	$prerequisite[] = $r['PREREQ'];
		  }
		  	$row['PREREQ'] = implode(',', $prerequisite);
		  }
            $temp[] = $row;
            $total++;
            $ctr++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, "");
        die(json_encode($data));
	}

	function addCurriculumSubject(){        
        $db = 'default';
        $table = "CURRSUBJ";
		$input = $this->input->post();
        if($this->lithefire->countFilteredRows($db, $table, "COURIDNO = '".$this->input->post("COURIDNO")."' AND SUBJIDNO = '".$input['SUBJIDNO']."'", "")){
            $data['success'] = false;
            $data['data'] = "Record already exists for this course";
            die(json_encode($data));
        }
        
		//$input['CURRIDNO'] = $this->lithefire->getNextCharId($db, $table, 'CURRIDNO', 5);
        $data = $this->lithefire->insertRow($db, $table, $input);

        die(json_encode($data));
    }

	function loadCurriculumSubject(){
        
        $db = "default";
        

        $id=$this->input->post('id');
		$COURIDNO=$this->input->post('COURIDNO');
		
		$fr_db = $this->config->item("fr_db");
		
        $table = "CURRSUBJ a LEFT JOIN $fr_db.FILESTLE b ON a.YEAR = b.YEAR LEFT JOIN $fr_db.FILESUBJ c ON a.SUBJIDNO = c.SUBJIDNO";
		
        $fields = array("a.YEAR", "a.SUBJIDNO", "a.COURIDNO", "c.SUBJCODE", "c.COURSEDESC", "a.CODE");
		
		$param = "a.SUBJIDNO";

        $filter = "$param = '$id' AND COURIDNO = '$COURIDNO'";
        

        $records = array();
        $records = $this->lithefire->getRecordWhere($db, $table, $filter, $fields);

        $temp = array();

        foreach($records as $row):
			$row['SUBJECT'] = $row['SUBJCODE'];
            $data["data"] = $row;


        endforeach;
        $data['success'] = true;

        die(json_encode($data));
    }
    
	function updateCurriculumSubject(){
        $db = 'default';

        $table = "CURRSUBJ";
        
       // $fields = $this->input->post();
		
        $id=$this->input->post('id');
		$COURIDNO=$this->input->post('COURIDNO');
		
        $param = "SUBJIDNO";

        $filter = "$param = '$id' AND COURIDNO = '$COURIDNO'";

        $input = array();
        foreach($this->input->post() as $key => $val){
            if($key == 'id')
                continue;
            if(!empty($val)){
                $input[$key] = $val;
            }
        }

        if($this->lithefire->countFilteredRows($db, $table, "YEAR != '".$this->input->post("YEAR")."' AND SUBJIDNO = '$id'", "")){
            $data['success'] = false;
            $data['data'] = "Record already exists";
            die(json_encode($data));
        }


        $data = $this->lithefire->updateRow($db, $table, $input, $filter);


        die(json_encode($data));
    }
	
	function deleteCurriculumSubject(){
        

        $table = "CURRSUBJ";
        $param = "SUBJIDNO";
       // $fields = $this->input->post();
		$db = "default";
        $id=$this->input->post('id');
		$COURIDNO=$this->input->post('COURIDNO');
		 $filter = "$param = '$id' AND COURIDNO = '$COURIDNO'";
		//$this->lithefire->deleteRow($db, "CURRSUBJ", "COURIDNO = '$COURIDNO'");
        $data = $this->lithefire->deleteRow($db, $table, $filter);
		

        die(json_encode($data));
    }
	
	function getPrereq(){
        
        $db = "default";
		
		$COURIDNO=$this->input->post('COURIDNO');
		$SUBJIDNO=$this->input->post('SUBJIDNO');

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        
        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');
        $filter = "COURIDNO = '$COURIDNO' AND SUBJIDNO = '$SUBJIDNO'";
        $group = "";

        if(empty($sort) && empty($dir)){
            $sort = "PREREQ ASC";
        }else{
            $sort = "$sort $dir";
        }

        $fr_db = $this->config->item("fr_db");

        $records = array();
        $table = "PREREQ";
		
        $fields = array("PRERCODE","PREREQ");

        

        if(!empty($querystring))
            $filter .= "AND (PREREQ LIKE '%$querystring%')";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);
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
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, "");
        die(json_encode($data));
	}
	
	function addPrerequisite(){        
        $db = 'default';
        $table = "PREREQ";
		$input = $this->input->post();
		unset($input['subj']);
		if(isset($input['PREREQSUBJIDNO'])){
		if($input['PREREQSUBJIDNO'] == $input['SUBJIDNO']){
			 $data['success'] = false;
            $data['data'] = "Course cannot be a pre-requisite to itself.";
            die(json_encode($data));
		}
		}
		
		if(!isset($input['PREREQ'])){
			$input['PREREQ'] = $this->lithefire->getFieldWhere("fr", "FILESUBJ", "SUBJIDNO = '".$input['PREREQSUBJIDNO']."'", "SUBJCODE");
			unset($input['PREREQSUBJIDNO']);
			
		}
        if($this->lithefire->countFilteredRows($db, $table, "COURIDNO = '".$this->input->post("COURIDNO")."' AND SUBJIDNO = '".$input['SUBJIDNO']."' AND PREREQ = '".$input['PREREQ']."'", "")){
            $data['success'] = false;
            $data['data'] = "Record already exists for this course";
            die(json_encode($data));
        }
		
		
      // die();
		//$input['CURRIDNO'] = $this->lithefire->getNextCharId($db, $table, 'CURRIDNO', 5);
        $data = $this->lithefire->insertRow($db, $table, $input);

        die(json_encode($data));
    }

	function deletePrereq(){
        

        $table = "PREREQ";
        $param = "PRERCODE";
       // $fields = $this->input->post();
		$db = "default";
        $id=$this->input->post('id');
		 $filter = "$param = '$id'";
		//$this->lithefire->deleteRow($db, "CURRSUBJ", "COURIDNO = '$COURIDNO'");
        $data = $this->lithefire->deleteRow($db, $table, $filter);
		

        die(json_encode($data));
    }
	
	function gradeEntryRestriction(){
        
            $data['title'] = 'OGS: Grade Entry Restriction';
            $data['userId'] = $this->session->userdata('userId');
            $data['userName'] = $this->session->userdata('userName');

  
            $this->layout->view('admin/grade_entry_restriction_view', $data);
    }
	
	function getGradeEntryRestriction(){
        

        
        $db = "default";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');
        $filter = "";
        $group = "";

        if(empty($sort) && empty($dir)){
            $sort = "SEMEIDNO DESC, date_from DESC";
        }else{
            $sort = "$sort $dir";
        }

        $fr_db = $this->config->item("fr_db");

        $records = array();
        $table = "GRADEENTRYRESTRICTION a LEFT JOIN $fr_db.FILESEME b ON a.SEMEIDNO = b.SEMEIDNO";
        $fields = array("a.id", "a.SEMEIDNO", "b.SEMESTER", "a.PERIOD", "a.date_from", "a.date_to");

        //$filter = "a.GENDIDNO = b.GENDIDNO";

        if(!empty($querystring))
            $filter = "(SEMESTER LIKE '%$querystring%' OR PERIOD LIKE '%$querystring%' OR date_from LIKE '%$querystring%' OR date_to LIKE '%$querystring%')";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
        if($records){
        foreach($records as $row):
          //  $row['COURSE'] = $this->commonmodel->getFieldWhere($db, "FILECOUR", "COURIDNO", $row['COURIDNO'], "COURSE");
            $temp[] = $row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, "");
        die(json_encode($data));
    }
	
	function addGradeEntryRestriction(){
		
		
		$insert = $this->input->post();
		$insert['DCREATED'] = date("Y-m-d H:i:s");
		$insert['DMODIFIED'] = date("Y-m-d H:i:s");
		$insert['created_by'] = $this->session->userData("userName");
		$insert['modified_by'] = $this->session->userData("userName");
		
		$db = 'default';
		$table = 'GRADEENTRYRESTRICTION';
		
		if($this->lithefire->countFilteredRows($db, $table, "SEMEIDNO = '".$insert['SEMEIDNO']."' AND PERIOD = '".$insert['PERIOD']."'", "")){
			$data['success'] = false;
			$data['data'] = "Restriction already exists for this semester and period";
			die(json_encode($data));
		}
		
		$data = $this->lithefire->insertRow($db, $table, $insert);
		//$data['data'] = "Restricti";
		
		die(json_encode($data));
	}

	function loadGradeEntryRestriction(){
        
        $db = "default";
		$fr_db = $this->config->item("fr_db");
        $table = "GRADEENTRYRESTRICTION a LEFT JOIN $fr_db.FILESEME b ON a.SEMEIDNO = b.SEMEIDNO";
        $fields = array("a.id", "a.SEMEIDNO", "b.SEMESTER", "a.PERIOD", "a.date_from", "a.date_to");

        $id=$this->input->post('id');

        $filter = "id = '$id'";
        //$filter.=" AND a.COURIDNO = FILECOUR.COURIDNO AND a.CITIIDNO = FILECITI.CITIIDNO AND a.RELIIDNO = FILERELI.RELIIDNO";

        $records = array();
        $records = $this->lithefire->getRecordWhere($db, $table, $filter, $fields);



        $temp = array();

        foreach($records as $row):
            
            $data["data"] = $row;


        endforeach;

       // $data['data'] = $temp;
        $data['success'] = true;

        die(json_encode($data));
    }
	
	function updateGradeEntryRestriction(){
        
        $db = 'default';

        $table = "GRADEENTRYRESTRICTION";
        
       // $fields = $this->input->post();

        $id=$this->input->post('id');
        $filter = "id = '$id'";

        $input = array();
        foreach($this->input->post() as $key => $val){
            if($key == 'id')
                continue;
            if(!empty($val)){
                $input[$key] = $val;
            }
        }
        
        

        if($this->lithefire->countFilteredRows($db, $table, "SEMEIDNO = '".$this->input->post("SEMEIDNO")."' AND id != '$id' AND PERIOD = '".$this->input->post("PERIOD")."'", "")){
            $data['success'] = false;
            $data['data'] = "Record already exists";
            die(json_encode($data));
        }
		
		$input['modified_by'] = $this->session->userData("userName");
		$insert['DMODIFIED'] = date("Y-m-d H:i:s");


        
		
		$record_log = $this->lithefire->getRecordWhere($db, $table, $filter, array("id", "date_from", "date_to", "SEMEIDNO", "PERIOD"));
		$log = array("grade_entry_restriction_id"=>$id, "date_from"=>$record_log[0]['date_from'], "date_to"=>$record_log[0]['date_to'], "modified_by"=>$this->session->userData("userName"), "SEMEIDNO"=>$record_log[0]['SEMEIDNO'], "PERIOD"=>$record_log[0]['PERIOD']);
		$this->lithefire->insertRow($db, $table."LOG", $log);
		$data = $this->lithefire->updateRow($db, $table, $input, $filter);

        die(json_encode($data));
    }

    function deleteGradeEntryRestriction(){
        
        $db = 'default';

        $table = "GRADEENTRYRESTRICTION";
        
        $id=$this->input->post('id');
        $filter = "id = '$id'";
		
		$record_log = $this->lithefire->getRecordWhere($db, $table, $filter, array("id", "date_from", "date_to", "SEMEIDNO", "PERIOD"));
		$log = array("grade_entry_restriction_id"=>$id, "date_from"=>$record_log[0]['date_from'], "date_to"=>$record_log[0]['date_to'], "modified_by"=>$this->session->userData("userName"), "SEMEIDNO"=>$record_log[0]['SEMEIDNO'], "PERIOD"=>$record_log[0]['PERIOD']);
		$this->lithefire->insertRow($db, $table."LOG", $log);

        $data = $this->lithefire->deleteRow($db, $table, $filter);

        die(json_encode($data));
    }
	
	function viewStudents(){
            
            $data['title'] = 'OGS: View Students';
            
            $data['userId'] = $this->session->userdata('userId');
            $data['userName'] = $this->session->userdata('userName');

        
            $this->layout->view('admin/admin_student_view', $data);
    }
    
    function getSubjectCombo(){
    	
        
		

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        
        $semester_id = $this->input->post('semester_id');
        $adviser_id = $this->session->userdata('userCode');

        $db = "default";


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');
        $ADVIIDNO = $this->input->post('ADVIIDNO');
		$COURIDNO = $this->input->post('COURIDNO');
		$SECTIDNO = $this->input->post('SECTIDNO');
		$YEAR = $this->input->post('YEAR');

        $filter = "a.SEMEIDNO = '$semester_id'";
		$group = "";
		$having = "";
		
		if($COURIDNO)
		$filter .= " AND a.COURIDNO = '$COURIDNO'";
		
		if($SECTIDNO)
		$filter .= " AND a.SECTIDNO = '$SECTIDNO'";
		
		if($YEAR)
		$filter .= " AND d.YEAR = '$YEAR'";

         if(!empty($querystring))
        $filter .= " AND (a.SUBJCODE  LIKE '%$querystring%' OR  b.COURSEDESC  LIKE '%$querystring%' OR  c.DAYS  LIKE '%$querystring%' OR  d.TIME  LIKE '%$querystring%')";

        if(empty($sort) && empty($dir)){
            $sort = "SUBJCODE";
        }

        $records = array();
		
		$fr_db = $this->config->item("fr_db");
		$default_db = $this->config->item("default_db");
		
        $table = "FILESCHE a LEFT JOIN $fr_db.FILESUBJ b ON a.SUBJIDNO = b.SUBJIDNO LEFT JOIN $fr_db.FILECOUR c ON a.COURIDNO = c.COURIDNO
        LEFT JOIN FILESECT d ON a.SECTIDNO = d.SECTIDNO";
        $fields = array('a.SCHEIDNO', 'a.SUBJCODE', 'b.COURSEDESC', 'a.UNITS_TTL', 'c.COURSE', "d.SECTION");



        
        
        if($this->session->userdata('userType') == "FACU"){
        $filter .= " AND a.ADVIIDNO = '$adviser_id'";
        }else{
        if(!empty($ADVIIDNO))
            $filter .= " AND a.ADVIIDNO = '$ADVIIDNO'";
        }


        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
        if($records){
        foreach($records as $row):
			if(empty($temp)){
                if(empty($querystring) || stristr("All Subjects", $querystring))
                $temp[] = array("id"=>0, "name"=>"All Subjects");
            }
            $tmp_row = array("id"=>$row['SCHEIDNO'], "name"=>$row['SUBJCODE']." (".$row['COURSEDESC'].")", 
            "description"=>$row['COURSEDESC'], 'UNITS_TTL'=>$row['UNITS_TTL'], "COURSE"=>$row['COURSE'],
			"SECTION"=>$row['SECTION']);
            $temp[] = $tmp_row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
    }

	function getStudentsPerSubject(){
        

        
        $db = "default";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        
		$SCHEIDNO=$this->input->post('SCHEIDNO');
		$COURIDNO=$this->input->post('COURIDNO');
		$SECTIDNO=$this->input->post('SECTIDNO');
		$SEMEIDNO=$this->input->post('SEMEIDNO');
		$YEAR=$this->input->post('YEAR');

        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');
        $filter = "";
        $group = "";

        if(empty($sort) && empty($dir)){
            $sort = "b.SUBJCODE ASC, a.NAME";
        }else{
            $sort = "$sort $dir";
        }

        $fr_db = $this->config->item("fr_db");

        $records = array();
		
		$default_db = $this->config->item('default_db');
		$database = $default_db.$SEMEIDNO;
		
        $table = $database.".FILESCHE b LEFT JOIN ".$fr_db.".FILESUBJ c ON b.SUBJIDNO = c.SUBJIDNO
        LEFT JOIN $fr_db.FILEADVI d ON b.ADVIIDNO = d.ADVIIDNO LEFT JOIN
        $fr_db.FILECOUR e ON b.COURIDNO = e.COURIDNO LEFT JOIN ".$database.".FILESECT f ON b.SECTIDNO = f.SECTIDNO LEFT JOIN ".$database.".SCHEDULE a ON a.SCHEIDNO = b.SCHEIDNO";
        $fields = array("a.id", "a.STUDIDNO", "a.IDNO", "a.NAME", "c.SUBJCODE", "c.COURSEDESC", "c.UNITS_TTL", "d.ADVISER", "e.COURSE", "f.YEAR", "f.SECTION");

        //$filter = "a.GENDIDNO = b.GENDIDNO";
		if($SCHEIDNO != 0)
			$filter = "b.SCHEIDNO = $SCHEIDNO";
		if($COURIDNO){
			if(empty($filter))
			$filter = "b.COURIDNO = $COURIDNO";
			else
			$filter .= " AND b.COURIDNO = $COURIDNO";
		}	
		
		if($SECTIDNO){
			if(empty($filter))
			$filter = "b.SECTIDNO = $SECTIDNO";
			else
			$filter .= " AND b.SECTIDNO = $SECTIDNO";
		}
		
		if($YEAR){
			if(empty($filter))
			$filter = "f.YEAR = '$YEAR'";
			else
			$filter .= " AND f.YEAR = '$YEAR'";
		}
			
        if(!empty($querystring)){
        	if(empty($filter))
			$filter = "(NAME LIKE '%$querystring%' OR COURSE LIKE '%$querystring%' OR SUBJECT LIKE '%$querystring%')";
			else
            $filter .= " AND (NAME LIKE '%$querystring%' OR COURSE LIKE '%$querystring%' OR SUBJECT LIKE '%$querystring%')";
		}

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
        $temp_subj = "";
        if($records){
        foreach($records as $row):
			if(empty($temp)){
				$temp_subj = $row['SUBJCODE'];
			}
			
			if($temp_subj != $row['SUBJCODE']){
				$temp[] = array();
				$temp_subj = $row['SUBJCODE'];
			}
          //  $row['COURSE'] = $this->commonmodel->getFieldWhere($db, "FILECOUR", "COURIDNO", $row['COURIDNO'], "COURSE");
            $temp[] = $row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, "");
        die(json_encode($data));
    }

	function getSubjectSummary(){
        

        
        $db = "default";


		$SCHEIDNO=$this->input->post('SCHEIDNO');
		$COURIDNO=$this->input->post('COURIDNO');
		$SECTIDNO=$this->input->post('SECTIDNO');
		$YEAR=$this->input->post('YEAR');


        $filter = "";
        $group = "";

        $fr_db = $this->config->item("fr_db");

        $records = array();
        $table = "FILESCHE b LEFT JOIN FILESECT f ON b.SECTIDNO = f.SECTIDNO LEFT JOIN SCHEDULE a ON a.SCHEIDNO = b.SCHEIDNO";
        

        //$filter = "a.GENDIDNO = b.GENDIDNO";
		if($SCHEIDNO)
			$filter = "b.SCHEIDNO = $SCHEIDNO";
		
		if($COURIDNO){
			if(empty($filter))
			$filter = "b.COURIDNO = $COURIDNO";
			else
			$filter .= " AND b.COURIDNO = $COURIDNO";
		}
		
		if($SECTIDNO){
			if(empty($filter))
			$filter = "b.SECTIDNO = $SECTIDNO";
			else
			$filter .= " AND b.SECTIDNO = $SECTIDNO";
		}
		
		if($YEAR){
			if(empty($filter))
			$filter = "f.YEAR = '$YEAR'";
			else
			$filter .= " AND f.YEAR = '$YEAR'";
		}
		
        if(!empty($querystring))
            $filter .= "";
		$sort = "b.SUBJCODE ASC";
      $fields = array("a.id", "a.STUDIDNO", "a.IDNO", "a.NAME", "b.SUBJCODE");

        

        $records = $this->lithefire->getAllRecords($db, $table, $fields, "", "", $sort, $filter, $group);
       // die($this->db->last_query());


        $temp = array();
		$subj_array = array();
      
        if($records){
        foreach($records as $row):
			if(!empty($subj_array[$row['SUBJCODE']])){
				$subj_array[$row['SUBJCODE']]++;
			}else{
				$subj_array[$row['SUBJCODE']] = 1;
			}

        endforeach;
        }
		
		foreach($subj_array as $key => $val){
			$temp[] = array("DESCRIPTION"=>$key, "TOTAL"=>$val);
		}
		$total = $this->lithefire->countFilteredRows($db, $table, $filter, "");

        $temp[] = array("DESCRIPTION"=>"<span style='font-weight: bold'>OVERALL STUDENTS</span>", "TOTAL"=>"<span style='font-weight: bold'>$total</span>");
        
        
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = 1;
        die(json_encode($data));
    }
    
	function getStudentsPerCourse(){
        

        
        $db = "default";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        
		$SCHEIDNO=$this->input->post('SCHEIDNO');

        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');
		$SEMEIDNO = $this->input->post('SEMEIDNO');
		$COURIDNO = $this->input->post('COURIDNO');
        $filter = "";
        $group = "";

        if(empty($sort) && empty($dir)){
            $sort = "b.SUBJCODE ASC, a.NAME";
        }else{
            $sort = "$sort $dir";
        }

        $fr_db = $this->config->item("fr_db");

        $records = array();
		
		$default_db = $this->config->item("default_db");
		$database = $default_db.$SEMEIDNO;
		
        $table = $database.".FILESCHE b LEFT JOIN ".$fr_db.".FILESUBJ c ON b.SUBJIDNO = c.SUBJIDNO
        LEFT JOIN $fr_db.FILEADVI d ON b.ADVIIDNO = d.ADVIIDNO LEFT JOIN
        $fr_db.FILECOUR e ON b.COURIDNO = e.COURIDNO LEFT JOIN ".$database.".FILESECT f ON b.SECTIDNO = f.SECTIDNO LEFT JOIN ".$database.".SCHEDULE a ON a.SCHEIDNO = b.SCHEIDNO";
        $fields = array("a.id", "a.STUDIDNO", "a.IDNO", "a.NAME", "c.SUBJCODE", "c.COURSEDESC", "c.UNITS_TTL", "d.ADVISER", "e.COURSE", "f.YEAR", "f.SECTION");

        //$filter = "a.GENDIDNO = b.GENDIDNO";
		if($COURIDNO != 0)
			$filter = "b.COURIDNO = '$COURIDNO'";
        if(!empty($querystring))
            $filter .= " AND (NAME LIKE '%$querystring%' OR COURSE LIKE '%$querystring%' OR c.SUBJCODE LIKE '%$querystring%' OR c.COURSEDESC LIKE '%$querystring%')";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
        $temp_subj = "";
        if($records){
        foreach($records as $row):
			if(empty($temp)){
				$temp_subj = $row['SUBJCODE'];
			}
			
			if($temp_subj != $row['SUBJCODE']){
				$temp[] = array();
				$temp_subj = $row['SUBJCODE'];
			}
          //  $row['COURSE'] = $this->commonmodel->getFieldWhere($db, "FILECOUR", "COURIDNO", $row['COURIDNO'], "COURSE");
            $temp[] = $row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, "");
        die(json_encode($data));
    }

	function getCourseSummary(){
        

        
        $db = "default";


		$SEMEIDNO = $this->input->post('SEMEIDNO');
		$COURIDNO = $this->input->post('COURIDNO');
        $filter = "b.SEMEIDNO = '$SEMEIDNO'";
        $group = "";

        $fr_db = $this->config->item("fr_db");

        $records = array();
        $default_db = $this->config->item("default_db");
		$database = $default_db.$SEMEIDNO;
		
        $table = $database.".FILESCHE b LEFT JOIN ".$fr_db.".FILESUBJ c ON b.SUBJIDNO = c.SUBJIDNO
        LEFT JOIN $fr_db.FILEADVI d ON b.ADVIIDNO = d.ADVIIDNO LEFT JOIN
        $fr_db.FILECOUR e ON b.COURIDNO = e.COURIDNO LEFT JOIN ".$database.".FILESECT f ON b.SECTIDNO = f.SECTIDNO LEFT JOIN ".$database.".SCHEDULE a ON a.SCHEIDNO = b.SCHEIDNO";
        $fields = array("a.id", "a.STUDIDNO", "a.IDNO", "a.NAME", "c.SUBJCODE", "c.COURSEDESC", "c.UNITS_TTL", "d.ADVISER", "e.COURSE", "f.YEAR", "f.SECTION");
		
		$sort = "e.COURSE ASC";

        //$filter = "a.GENDIDNO = b.GENDIDNO";
		if($COURIDNO != 0)
			$filter .= " AND b.COURIDNO = '$COURIDNO'";
        if(!empty($querystring))
            $filter .= " AND (NAME LIKE '%$querystring%' OR COURSE LIKE '%$querystring%' OR c.SUBJCODE LIKE '%$querystring%' OR c.COURSEDESC LIKE '%$querystring%')";

      //  $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);
       // die($this->db->last_query());
       
       $records = $this->lithefire->getAllRecords($db, $table, $fields, "", "", $sort, $filter, $group);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
        $temp_course = "";
        $course_ctr = 0;
        $courses = 0;
        $course_array = array();
       // die(print_r($records));
        if($records){
        	//die(print_r($records));
        foreach($records as $row):
       
			if(!empty($course_array[$row['COURSE']])){
				$course_array[$row['COURSE']]++;
			}else{
				$course_array[$row['COURSE']] = 1;
			}

        endforeach;
        }
		
		foreach($course_array as $key => $val){
			$temp[] = array("DESCRIPTION"=>$key, "TOTAL"=>$val);
		}
		$total = $this->lithefire->countFilteredRows($db, $table, $filter, "");

        $temp[] = array("DESCRIPTION"=>"<span style='font-weight: bold'>OVERALL STUDENTS</span>", "TOTAL"=>"<span style='font-weight: bold'>$total</span>");
        
        
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $courses++;
        die(json_encode($data));
    }

	function getAdviserCombo(){
        

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        $db = "fr";
        $filter = "";
        $group = "";


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $query = $this->input->post('query');
        

        if(empty($sort) && empty($dir)){
            $sort = "ADVISER ASC";
        }else{
            $sort = "$sort $dir";
        }

        if(!empty($query)){
            $filter = "(ADVIIDNO LIKE '%$query%' OR ADVISER LIKE '%$query%')";
        }

        $records = array();
        $table = "FILEADVI";
        $fields = array("ADVIIDNO as id", "ADVISER as name");

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
        if($records){
        foreach($records as $row):
          //  $row['COURSE'] = $this->commonmodel->getFieldWhere($db, "FILECOUR", "COURIDNO", $row['COURIDNO'], "COURSE");
		  if(empty($temp)){
                if(empty($querystring) || stristr("All Advisers", $querystring))
                $temp[] = array("id"=>0, "name"=>"All Advisers");
            }
            $temp[] = $row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
    }

	function getStudentsPerAdviser(){
        

        
        $db = "default";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        
		

        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');
		$SEMEIDNO = $this->input->post('SEMEIDNO');
		$ADVIIDNO = $this->input->post('ADVIIDNO');
        $filter = "b.SEMEIDNO = '$SEMEIDNO'";
        $group = "";

        if(empty($sort) && empty($dir)){
            $sort = "b.SUBJCODE ASC, a.NAME";
        }else{
            $sort = "$sort $dir";
        }

        $fr_db = $this->config->item("fr_db");

        $records = array();
		
		$default_db = $this->config->item("default_db");
		$database = $default_db.$SEMEIDNO;
		
        $table = $database.".FILESCHE b LEFT JOIN ".$fr_db.".FILESUBJ c ON b.SUBJIDNO = c.SUBJIDNO
        LEFT JOIN $fr_db.FILEADVI d ON b.ADVIIDNO = d.ADVIIDNO LEFT JOIN
        $fr_db.FILECOUR e ON b.COURIDNO = e.COURIDNO LEFT JOIN ".$database.".FILESECT f ON b.SECTIDNO = f.SECTIDNO LEFT JOIN ".$database.".SCHEDULE a ON a.SCHEIDNO = b.SCHEIDNO";
        $fields = array("a.id", "a.STUDIDNO", "a.IDNO", "a.NAME", "c.SUBJCODE", "c.COURSEDESC", "c.UNITS_TTL", "d.ADVISER", "e.COURSE", "f.YEAR", "f.SECTION");

        //$filter = "a.GENDIDNO = b.GENDIDNO";
		if($ADVIIDNO != 0)
			$filter .= " AND b.ADVIIDNO = '$ADVIIDNO'";
        if(!empty($querystring))
            $filter .= " AND (NAME LIKE '%$querystring%' OR COURSE LIKE '%$querystring%' OR c.SUBJCODE LIKE '%$querystring%' OR c.COURSEDESC LIKE '%$querystring%')";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
        $temp_subj = "";
        if($records){
        foreach($records as $row):
			if(empty($temp)){
				$temp_subj = $row['SUBJCODE'];
			}
			
			if($temp_subj != $row['SUBJCODE']){
				$temp[] = array();
				$temp_subj = $row['SUBJCODE'];
			}
          //  $row['COURSE'] = $this->commonmodel->getFieldWhere($db, "FILECOUR", "COURIDNO", $row['COURIDNO'], "COURSE");
            $temp[] = $row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, "");
        die(json_encode($data));
    }

	function getAdviserSummary(){
        

        
        $db = "default";


		$SEMEIDNO = $this->input->post('SEMEIDNO');
		$ADVIIDNO = $this->input->post('ADVIIDNO');
        $filter = "b.SEMEIDNO = '$SEMEIDNO'";
        $group = "";

        $fr_db = $this->config->item("fr_db");

        $records = array();
        $table = "FILESCHE b LEFT JOIN $fr_db.FILESUBJ c ON b.SUBJIDNO = c.SUBJIDNO
        LEFT JOIN $fr_db.FILEADVI d ON b.ADVIIDNO = d.ADVIIDNO LEFT JOIN
        $fr_db.FILECOUR e ON b.COURIDNO = e.COURIDNO LEFT JOIN FILESECT f ON b.SECTIDNO = f.SECTIDNO LEFT JOIN SCHEDULE a ON a.SCHEIDNO = b.SCHEIDNO";
        $fields = array("a.id", "a.STUDIDNO", "a.IDNO", "a.NAME", "c.SUBJCODE", "c.COURSEDESC", "c.UNITS_TTL", "d.ADVISER", "e.COURSE", "f.YEAR", "f.SECTION");
		
		$sort = "e.COURSE ASC";

        //$filter = "a.GENDIDNO = b.GENDIDNO";
		if($ADVIIDNO != 0)
			$filter .= " AND b.ADVIIDNO = '$ADVIIDNO'";
        if(!empty($querystring))
            $filter .= " AND (NAME LIKE '%$querystring%' OR COURSE LIKE '%$querystring%' OR c.SUBJCODE LIKE '%$querystring%' OR c.COURSEDESC LIKE '%$querystring%')";

      //  $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);
       // die($this->db->last_query());
       
       $records = $this->lithefire->getAllRecords($db, $table, $fields, "", "", $sort, $filter, $group);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
        $temp_course = "";
        $course_ctr = 0;
        $courses = 0;
        $course_array = array();
       // die(print_r($records));
        if($records){
        	//die(print_r($records));
        foreach($records as $row):
       
			if(!empty($course_array[$row['ADVISER']])){
				$course_array[$row['ADVISER']]++;
			}else{
				$course_array[$row['ADVISER']] = 1;
			}

        endforeach;
        }
		
		foreach($course_array as $key => $val){
			$temp[] = array("DESCRIPTION"=>$key, "TOTAL"=>$val);
		}
		$total = $this->lithefire->countFilteredRows($db, $table, $filter, "");

        $temp[] = array("DESCRIPTION"=>"<span style='font-weight: bold'>OVERALL STUDENTS</span>", "TOTAL"=>"<span style='font-weight: bold'>$total</span>");
        
        
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $courses++;
        die(json_encode($data));
    }

	function viewAttendance(){


            $data['title'] = 'OGS: Attendance Report';
            $data['userId'] = $this->session->userdata('userId');
            $data['userName'] = $this->session->userdata('userName');

            
            $this->layout->view('admin/admin_attendance_view', $data);
            
    }
	
	function getAttendancePerStudent(){
        


        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        $db = "default";


        $sortstr = $this->input->post('sort');
        $dirstr = $this->input->post('dir');
        //$SCHEIDNO = $this->input->post('SCHEIDNO');
        $SEMEIDNO = $this->input->post('SEMEIDNO');
		$STUDIDNO = $this->input->post('STUDIDNO');

        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
		
		$fr_db = $this->config->item("fr_db");
		$default_db = $this->config->item("default_db");
		
		$database = $default_db.$SEMEIDNO;

        $querystring = $this->input->post('query');

        $query = array();

         if(!empty($querystring))
        $query = "(c.STUDIDNO LIKE '%$querystring%' OR c.IDNO LIKE '%$querystring%' OR c.NAME LIKE '%$querystring%')";
        //$sort = "SCHEDULEDATE ASC";
        $dir = "";
        if(empty($sortstr) && empty($dirstr)){
            $sort = "SUBJCODE ASC, SCHEDULEDATE ASC";
            
        }else{
            $sort.=", $sortstr $dirstr";
        }

        $records = array();
        $table = "$database.ATTENDANCE b LEFT JOIN $database.SCHEDULE a ON a.id = b.SCHEDULEIDNO LEFT JOIN $database.COLLEGE c ON a.STUDIDNO = c.STUDIDNO 
        LEFT JOIN $database.FILESCHE d ON a.SCHEIDNO = d.SCHEIDNO LEFT JOIN $fr_db.FILEADVI e ON d.ADVIIDNO = e.ADVIIDNO
        LEFT JOIN $fr_db.FILESUBJ f ON d.SUBJIDNO = f.SUBJIDNO";
        $fields = array("b.id, c.STUDIDNO, c.IDNO, c.NAME, b.SCHEDULEDATE, b.STATUS, d.SUBJCODE", "e.ADVISER", "f.COURSEDESC");

        $filter = "b.SCHEDULEDATE BETWEEN '$date_from' AND '$date_to' AND a.STUDIDNO = '$STUDIDNO'";
		$group = "";
		$having = "";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;

        $tmp_subj = $records[0]['SUBJCODE'];
        if($records){
        foreach($records as $row):
            /*if(empty($temp)){
                if(empty($querystring) || stristr("All Employees", $querystring))
                $temp[] = array("id"=>0, "name"=>"All Courses");
            }*/
          
            if($row['SUBJCODE'] != $tmp_subj){
                $temp[] = array();
                $tmp_subj = $row['SUBJCODE'];
            }
            $row['DAY'] = date("l", strtotime($row['SCHEDULEDATE']));

            $temp[] = $row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
    }

	function getStudentAttendanceSummary(){
        


        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        $db = "default";


        $sortstr = $this->input->post('sort');
        $dirstr = $this->input->post('dir');
        //$SCHEIDNO = $this->input->post('SCHEIDNO');
        $SEMEIDNO = $this->input->post('SEMEIDNO');
		$STUDIDNO = $this->input->post('STUDIDNO');

        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
		
		$fr_db = $this->config->item("fr_db");

        $querystring = $this->input->post('query');

        $query = array();

         if(!empty($querystring))
        $query = "(c.STUDIDNO LIKE '%$querystring%' OR c.IDNO LIKE '%$querystring%' OR c.NAME LIKE '%$querystring%')";
        //$sort = "SCHEDULEDATE ASC";
        $dir = "";
        if(empty($sortstr) && empty($dirstr)){
            $sort = "SUBJCODE ASC, SCHEDULEDATE ASC";
            
        }else{
            $sort.=", $sortstr $dirstr";
        }

        $records = array();
		
		$default_db = $this->config->item("default_db");
		$database = $default_db.$SEMEIDNO;
		
        $table = $database.".ATTENDANCE b LEFT JOIN ".$database.".SCHEDULE a ON a.id = b.SCHEDULEIDNO LEFT JOIN ".$database.".COLLEGE c ON a.STUDIDNO = c.STUDIDNO 
        LEFT JOIN ".$database.".FILESCHE d ON a.SCHEIDNO = d.SCHEIDNO LEFT JOIN $fr_db.FILEADVI e ON d.ADVIIDNO = e.ADVIIDNO";
        $fields = array("b.id, c.STUDIDNO, c.IDNO, c.NAME, b.SCHEDULEDATE, b.STATUS, d.SUBJCODE", "e.ADVISER");

        $filter = "b.SCHEDULEDATE BETWEEN '$date_from' AND '$date_to' AND a.STUDIDNO = '$STUDIDNO' AND d.SEMEIDNO = '$SEMEIDNO'";
		$group = "";
		$having = "";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
		$status_array = array();
        
        if($records){
        foreach($records as $row):
           if(empty($status_array[$row['SUBJCODE']]['PRESENT'])){
				$status_array[$row['SUBJCODE']]['PRESENT'] = 0;
		   }
		   if(empty($status_array[$row['SUBJCODE']]['ABSENT'])){
				$status_array[$row['SUBJCODE']]['ABSENT'] = 0;
		   }
		   
				$status_array[$row['SUBJCODE']][$row['STATUS']]++;
			

        endforeach;
        }
        
        foreach($status_array as $key => $value){
        	$temp[] = array("SUBJCODE"=>$key, "PRESENT"=>"<span style='font-weight: bold; color: green'>".$value['PRESENT']."</span>", "ABSENT"=>"<span style='font-weight: bold; color: red'>".$value['ABSENT']."</span>");
        }
        
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
    }

	function getAttendancePerAdviser(){
        


        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        $db = "default";


        $sortstr = $this->input->post('sort');
        $dirstr = $this->input->post('dir');
        //$SCHEIDNO = $this->input->post('SCHEIDNO');
        $SEMEIDNO = $this->input->post('SEMEIDNO');
		$ADVIIDNO = $this->input->post('ADVIIDNO');

        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
		
		$fr_db = $this->config->item("fr_db");

        $querystring = $this->input->post('query');

        $query = array();

         if(!empty($querystring))
        $query = "(c.STUDIDNO LIKE '%$querystring%' OR c.IDNO LIKE '%$querystring%' OR c.NAME LIKE '%$querystring%')";
        //$sort = "SCHEDULEDATE ASC";
        $dir = "";
        if(empty($sortstr) && empty($dirstr)){
            $sort = "SUBJCODE ASC, SCHEDULEDATE ASC";
            
        }else{
            $sort.=", $sortstr $dirstr";
        }

        $records = array();
		
		$default_db = $this->config->item("default_db");
		$database = $default_db.$SEMEIDNO;
		
        $table = $database.".ATTENDANCE b LEFT JOIN ".$database.".SCHEDULE a ON a.id = b.SCHEDULEIDNO LEFT JOIN ".$database.".COLLEGE c ON a.STUDIDNO = c.STUDIDNO 
        LEFT JOIN ".$database.".FILESCHE d ON a.SCHEIDNO = d.SCHEIDNO LEFT JOIN $fr_db.FILEADVI e ON d.ADVIIDNO = e.ADVIIDNO";
        $fields = array("b.id, c.STUDIDNO, c.IDNO, c.NAME, b.SCHEDULEDATE, b.STATUS, d.SUBJCODE", "e.ADVISER");

        $filter = "b.SCHEDULEDATE BETWEEN '$date_from' AND '$date_to' AND d.SEMEIDNO = '$SEMEIDNO'";
		
		if($ADVIIDNO != 0)
		$filter.=" AND d.ADVIIDNO = '$ADVIIDNO'";
		
		$group = "";
		$having = "";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;

        $tmp_subj = $records[0]['SUBJCODE'];
        if($records){
        foreach($records as $row):
            /*if(empty($temp)){
                if(empty($querystring) || stristr("All Employees", $querystring))
                $temp[] = array("id"=>0, "name"=>"All Courses");
            }*/
          
            if($row['SUBJCODE'] != $tmp_subj){
                $temp[] = array();
                $tmp_subj = $row['SUBJCODE'];
            }
            $row['DAY'] = date("l", strtotime($row['SCHEDULEDATE']));

            $temp[] = $row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
    }

	function getAdviserAttendanceSummary(){
        


        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        $db = "default";


        $sortstr = $this->input->post('sort');
        $dirstr = $this->input->post('dir');
        //$SCHEIDNO = $this->input->post('SCHEIDNO');
        $SEMEIDNO = $this->input->post('SEMEIDNO');
		$ADVIIDNO = $this->input->post('ADVIIDNO');

        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
		
		$fr_db = $this->config->item("fr_db");

        $querystring = $this->input->post('query');

        $query = array();

         if(!empty($querystring))
        $query = "(c.STUDIDNO LIKE '%$querystring%' OR c.IDNO LIKE '%$querystring%' OR c.NAME LIKE '%$querystring%')";
        //$sort = "SCHEDULEDATE ASC";
        $dir = "";
        if(empty($sortstr) && empty($dirstr)){
            $sort = "SUBJCODE ASC, SCHEDULEDATE ASC";
            
        }else{
            $sort.=", $sortstr $dirstr";
        }

        $records = array();
        $table = "SCHEDULE a LEFT JOIN ATTENDANCE b ON a.id = b.SCHEDULEIDNO LEFT JOIN COLLEGE c ON a.STUDIDNO = c.STUDIDNO 
        LEFT JOIN FILESCHE d ON a.SCHEIDNO = d.SCHEIDNO LEFT JOIN $fr_db.FILEADVI e ON d.ADVIIDNO = e.ADVIIDNO";
        $fields = array("b.id, c.STUDIDNO, c.IDNO, c.NAME, b.SCHEDULEDATE, b.STATUS, d.SUBJCODE", "e.ADVISER");

        $filter = "b.SCHEDULEDATE BETWEEN '$date_from' AND '$date_to' AND d.SEMEIDNO = '$SEMEIDNO'";
		
		if($ADVIIDNO != 0)
		$filter.=" AND d.ADVIIDNO = '$ADVIIDNO'";
		
		$group = "";
		$having = "";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
		$status_array = array();
        
        if($records){
        foreach($records as $row):
           if(empty($status_array[$row['SUBJCODE']][$row['ADVISER']]['PRESENT'])){
				$status_array[$row['SUBJCODE']][$row['ADVISER']]['PRESENT'] = 0;
		   }
		   if(empty($status_array[$row['SUBJCODE']][$row['ADVISER']]['ABSENT'])){
				$status_array[$row['SUBJCODE']][$row['ADVISER']]['ABSENT'] = 0;
		   }
		   
				$status_array[$row['SUBJCODE']][$row['ADVISER']][$row['STATUS']]++;
			

        endforeach;
        }
        
        foreach($status_array as $key => $value){
        	foreach ($value as $k => $val) {
			$temp[] = array("SUBJCODE"=>$key, "ADVISER"=>$k, 
			"PRESENT"=>"<span style='color: green; font-weight: bold'>".$val['PRESENT']."</span>", 
			"ABSENT"=>"<span style='color: red; font-weight: bold'>".$val['ABSENT']."</span>");	
			}
        	
        }
        
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
    }

	function studentProfileChange(){

            $data['title'] = 'OGS: Student Profile Change Request';
            $data['userId'] = $this->session->userdata('userId');
            $data['userName'] = $this->session->userdata('userName');

       
            $this->layout->view('admin/admin_student_profile_change_view', $data);
    }
	
	function getStudentProfileRequest(){
        

        
        $db = "default";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');
		$student_id = $this->session->userData('userCode');
        $filter = "";
        $group = "";

        if(empty($sort) && empty($dir)){
            $sort = "a.DCREATED DESC, a.TCREATED DESC";
        }else{
            $sort = "$sort $dir";
        }

        

        $records = array();
        $table = "PROFILECHANGE a LEFT JOIN ".$this->config->item("fr_db").".FILERELI c ON a.RELIIDNO = c.RELIIDNO
        LEFT JOIN ".$this->config->item("fr_db").".FILECITI d ON a.CITIIDNO = d.CITIIDNO";
        $fields = array("a.id, a.STUDCODE, a.STUDIDNO, a.FIRSTNAME, a.MIDDLENAME, a.LASTNAME, a.BIRTHDATE, a.BIRTHPLACE, c.RELIGION, d.CITIZENSHIP
        , a.C_ADDR01, a.C_ADDR02, a.C_ADDR03, a.P_ADDR01, a.P_ADDR02, a.P_ADDR03, a.WEBSITE, a.EMAIL, a.STATUS");

        //$filter = "a.GENDIDNO = b.GENDIDNO";

        if(!empty($querystring))
            $filter .= " AND (STUDCODE LIKE '%$querystring%' OR STUDIDNO LIKE '%$querystring%' OR NAME LIKE '%$querystring%' OR FIRSTNAME LIKE '%$querystring%')";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
        if($records){
        foreach($records as $row):
          //  $row['COURSE'] = $this->commonmodel->getFieldWhere($db, "FILECOUR", "COURIDNO", $row['COURIDNO'], "COURSE");
            $temp[] = $row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, "");
        die(json_encode($data));
    }
    
    function denyProfileChange(){
        
        $db = 'default';
		
		$type = $this->input->post('type');
		if($type == 1)
        $table = "PROFILECHANGE";
		elseif($type == 2)
        $table = "ADVISERPROFILECHANGE";
       // $fields = $this->input->post();

        $id=$this->input->post('id');
        $filter = "id = '$id'";

        if($this->lithefire->countFilteredRows($db, $table, "STATUS != 'Pending' AND $filter", "")){
        	$data['data'] = "Application cannot be denied";
			$data['success'] = false;
			die(json_encode($data));
        }
		
		$input['APPROVER'] = $this->session->userData("userName");
		$input['DMODIFIED'] = date("Y-m-d");
		$input['TMODIFIED'] = date("H:i:s");
		$input['STATUS'] = 'Denied';

		$data = $this->lithefire->updateRow($db, $table, $input, $filter);
		
        die(json_encode($data));
    }
	
	function approveProfileChange(){
        
        $db = "fr";
        $table = "COLLHIST";
        $param = "STUDCODE";
		$time = date("H:i:s");
		$date = date("Y-m-d");
       // $fields = $this->input->post();

        $id=$this->input->post('id');
		$temp_id = $id;
        $temp_input = $this->lithefire->getRecordWhere("default", "PROFILECHANGE", "id = '$id'", array("LASTNAME", "FIRSTNAME", "MIDDLENAME", "STUDCODE", "BIRTHDATE",
		"BIRTHPLACE", "CITIIDNO", "RELIIDNO", "C_ADDR01", "C_ADDR02", "C_ADDR03", "C_ZIPCODE", "C_PROVINCE", "COUNIDNO",
		"P_ADDR01", "P_ADDR02", "P_ADDR03", "P_ZIPCODE", "P_PROVINCE", "P_COUNIDNO", "EMAIL", "WEBSITE"));
		$id = $temp_input[0]['STUDCODE'];
        $temp_input[0]['STUDCODE'] = "";
        $input = array();
		//die(print_r($temp_input));
        foreach($temp_input as $key => $val){
        	foreach($val as $k => $v):
            if(!empty($v)){
                $input[$k] = $v;

            }
			endforeach;
        }
   
        $input['FIRSTNAME'] = strtoupper($input['FIRSTNAME']);
        $input['MIDDLENAME'] = strtoupper($input['MIDDLENAME']);
        $input['LASTNAME'] = strtoupper($input['LASTNAME']);

        $input['NAME'] = $input['LASTNAME'].", ".$input['FIRSTNAME']." ".$input['MIDDLENAME'];

        $filter = "STUDCODE = '$id'";
        $records = array();
		
		$old_data = $this->lithefire->getRecordWhere("fr", "COLLHIST", "STUDCODE = '$id'", array("LASTNAME", "FIRSTNAME", "MIDDLENAME", "STUDIDNO", "BIRTHDATE",
		"BIRTHPLACE", "CITIIDNO", "RELIIDNO", "C_ADDR01", "C_ADDR02", "C_ADDR03", "C_ZIPCODE", "C_PROVINCE", "COUNIDNO",
		"P_ADDR01", "P_ADDR02", "P_ADDR03", "P_ZIPCODE", "P_PROVINCE", "P_COUNIDNO", "EMAIL", "WEBSITE"));
		
		$this->lithefire->insertRow("default", "PROFILECHANGELOG", $old_data[0]);
		
        $data = $this->lithefire->updateRow($db, $table, $input, $filter);

		$this->lithefire->updateRow("default", "PROFILECHANGE", array("STATUS"=>'Approved', "APPROVER"=>$this->session->userData("userName"), "DMODIFIED"=>$date, "TMODIFIED"=>$time), "id = '$temp_id'");
		
		$data['data'] = "Request successfully approved";
        die(json_encode($data));
    }

	function adviserProfileChange(){
            
            $data['title'] = 'OGS: Faculty Profile Change Request';
            $data['userId'] = $this->session->userdata('userId');
            $data['userName'] = $this->session->userdata('userName');

        
            $this->layout->view('admin/admin_adviser_profile_change_view', $data);
    }
	
	function getAdviserProfileRequest(){
        

        
        $db = "default";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');
		$adviser_id = $this->session->userData('userCode');
        $filter = "";
        $group = "";

        if(empty($sort) && empty($dir)){
            $sort = "a.DCREATED DESC, a.TCREATED DESC";
        }else{
            $sort = "$sort $dir";
        }

        

        $records = array();

        
        $table = "ADVISERPROFILECHANGE a";
        
        $fields = array("a.ADVIIDNO",  "a.FIRSTNAME", "a.LASTNAME", "a.MIDDLENAME", "a.BIRTHDATE", "STATUS", "DCREATED", "id");


        

        //$filter = "a.GENDIDNO = b.GENDIDNO";

        if(!empty($querystring))
            $filter .= " AND (ADVIIDNO LIKE '%$querystring%' OR ADVISER LIKE '%$querystring%' OR FIRSTNAME LIKE '%$querystring%')";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
        if($records){
        foreach($records as $row):
          //  $row['COURSE'] = $this->commonmodel->getFieldWhere($db, "FILECOUR", "COURIDNO", $row['COURIDNO'], "COURSE");
            $temp[] = $row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, "");
        die(json_encode($data));
    }

    function approveAdviserProfileChange(){
        
        $db = "fr";
        $table = "ADVIPROFILE";
        $param = "ADVIIDNO";
		$time = date("H:i:s");
		$date = date("Y-m-d");
       // $fields = $this->input->post();

        $id=$this->input->post('id');
		$temp_id = $id;
        $temp_input = $this->lithefire->getRecordWhere("default", "ADVISERPROFILECHANGE", "id = '$id'", array("LASTNAME", "FIRSTNAME", "MIDDLENAME", "ADVIIDNO", "BIRTHDATE"));
		$id = $temp_input[0]['ADVIIDNO'];
        $temp_input[0]['ADVIIDNO'] = "";
        $input = array();
		//die(print_r($temp_input));
        foreach($temp_input as $key => $val){
        	foreach($val as $k => $v):
            if(!empty($v)){
                $input[$k] = $v;

            }
			endforeach;
        }
   
        $input['FIRSTNAME'] = strtoupper($input['FIRSTNAME']);
        $input['MIDDLENAME'] = strtoupper($input['MIDDLENAME']);
        $input['LASTNAME'] = strtoupper($input['LASTNAME']);

        $fr_input['ADVISER'] = $input['FIRSTNAME']." ".$input['MIDDLENAME']." ".$input['LASTNAME'];

        $filter = "ADVIIDNO = '$id'";
        $records = array();
		
		$old_data = $this->lithefire->getRecordWhere("fr", "ADVIPROFILE", "ADVIIDNO = '$id'", array("ADVIIDNO", "LASTNAME", "FIRSTNAME", "MIDDLENAME", "BIRTHDATE"));
		
		$this->lithefire->insertRow("default", "ADVISERPROFILECHANGELOG", $old_data[0]);
		
        $data = $this->lithefire->updateRow($db, $table, $input, $filter);
		$this->lithefire->updateRow($db, "FILEADVI", $fr_input, $filter);
		$this->lithefire->updateRow("default", "ADVISERPROFILECHANGE", array("STATUS"=>'Approved', "APPROVER"=>$this->session->userData("userName"), "DMODIFIED"=>$date, "TMODIFIED"=>$time), "id = '$temp_id'");
		
		$data['data'] = "Request successfully approved";
        die(json_encode($data));
    }

	function parentSetup(){
  

        $data['userId'] = $this->session->userdata('userId');
        $data['userName'] = $this->session->userdata('userName');
        $data['title'] = 'OGS: Parent Setup';


        $this->layout->view('admin/parent_setup_view', $data);
    }

    function getParentSetup(){
        
        
        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        $db = "fr";


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $query = $this->input->post('query');
        $queryby = "";
		
		$filter = "";
		$group = "";
		$having = "";

        if(empty($sort) && empty($dir)){
            $sort = "id DESC";
            
        }else{
        	$sort = "$sort $dir";
        }
		
		$fr_db = $this->config->item("fr_db");

        $records = array();
        $table = "STUDENTPARENT a LEFT JOIN PARENTS b ON a.PAREIDNO = b.PAREIDNO LEFT JOIN $fr_db.COLLHIST c ON a.STUDIDNO = c.STUDIDNO";
        $fields = array("a.id", "b.NAME as PARENT", "c.NAME as STUDENT");

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

    function addParentSetup(){
        
        
        $db = "fr";

        $table = "STUDENTPARENT";
        
		$default_db = $this->config->item("default_db");
		
        
        
        $input = array();

        $input = $this->input->post();
        
		
		
		if($this->lithefire->countFilteredRows($db, $table, "PAREIDNO = '".$input['PAREIDNO']."' AND STUDIDNO = '".$input['STUDIDNO']."'", "")){
            $data['success'] = false;
            $data['data'] = "Record already exists";
            die(json_encode($data));
        }

        

        $data = $this->lithefire->insertRow($db, $table, $input);
        die(json_encode($data));
    }

    function loadParentSetup(){
         
        $db = "fr";


        $id=$this->input->post('id');
		$filter = "id = '$id'";
		
		$fr_db = $this->config->item("fr_db");
        $table = "STUDENTPARENT a LEFT JOIN PARENTS b ON a.PAREIDNO = b.PAREIDNO LEFT JOIN $fr_db.COLLHIST c ON a.STUDIDNO = c.STUDIDNO";
        $fields = array("a.id", "a.PAREIDNO", "a.STUDIDNO", "c.NAME as STUDENT", "b.NAME as PARENT");

       

        $records = array();
        $records = $this->lithefire->getRecordWhere($db, $table, $filter, $fields);

        foreach($records as $row):
            
            $data["data"] = $row;


        endforeach;
        $data['success'] = true;

        die(json_encode($data));
    }

    function updateParentSetup(){
        
        $db = 'fr';

        $table = "STUDENTPARENT";

       // $fields = $this->input->post();

        $id=$this->input->post('id');
        $filter = "id = '$id'";

        $input = array();
        foreach($this->input->post() as $key => $val){
            if($key == 'id')
                continue;
            if(!empty($val)){
                $input[$key] = $val;
            }
        }
		
		
		
        if($this->lithefire->countFilteredRows($db, $table, "PAREIDNO = '".$input['PAREIDNO']."' AND STUDIDNO = '".$input['STUDIDNO']."' AND id != '$id'", "")){
            $data['success'] = false;
            $data['data'] = "Record already exists";
            die(json_encode($data));
        }


        $data = $this->lithefire->updateRow($db, $table, $input, $filter);


        die(json_encode($data));
    }

    function deleteParentSetup(){
        
        $db = 'fr';

        $table = "STUDENTPARENT";

        $id=$this->input->post('id');
        $filter = "id = '$id'";

        $data = $this->lithefire->deleteRow($db, $table, $filter);

        die(json_encode($data));
    }
	
	function transcript(){
        

        $data['title'] = 'OGS: Transcript of Records';
        $data['userId'] = $this->session->userdata('userId');
		$data['userType'] = $this->session->userdata('userType');
        $data['code'] = $this->session->userdata('code');
        $data['userName'] = $this->session->userdata('userName');
        

        $this->layout->view('admin/transcript_view', $data);
    }
	
	function loadActiveSemester(){
         
        $db = "fr";


		$filter = "IS_ACTIVE = 1";
		
		$fr_db = $this->config->item("fr_db");
        $table = "FILESEME";
        $fields = array("SEMEIDNO", "SEMESTER as semester", "DESCRIPTIO");

       

        $records = array();
        $records = $this->lithefire->getRecordWhere($db, $table, $filter, $fields);

        foreach($records as $row):
            
            $data["data"] = $row;


        endforeach;
        $data['success'] = true;

        die(json_encode($data));
    }
	
	function financial(){
   
        $data['title'] = 'Student Web Portal: Student Financial Records';
        $data['userId'] = $this->session->userData('userId');
        $data['userName'] = $this->session->userData('userName');


        $this->layout->view('admin/financial_records_view', $data);

    }
	
	function uploadPhoto(){
		//die($_SERVER['SERVER_NAME']);
        if (!empty($_FILES['file']['name']))
		{

            $file_name = $_FILES['file']['name'];

            $image_extensions_allowed = array('jpg', 'jpeg', 'png', 'gif','bmp');
            $ext = strtolower(substr(strrchr($file_name, "."), 1));

            if(!in_array($ext, $image_extensions_allowed))
            {
            $exts = implode(', ',$image_extensions_allowed);
            $error .= "You must upload a file with one of the following extensions: ".$exts;
            $data = array("succses"=>false, "data"=>$error);
            die(json_encode($data));
            }

			$filename = $_FILES['file']['name'];
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/images/facultyPhotos/".$filename;
			$pic = "http://".$_SERVER['SERVER_NAME']."/images/facultyPhotos/".$filename;

			if (!move_uploaded_file($_FILES['file']['tmp_name'], "$uploaddir"))
			{
				$data = array("success"=>false, "data"=> "File was not uploaded." );
				die(json_encode($data));
			}
		}

    
        $data['filename'] = $pic;
        $data['success'] = true;
        $data['data'] = "File successfully uploaded";
        die(json_encode($data));
       

        $data['success'] = false;
        $data['data'] = mysql_error();
        die(json_encode($data));
        

    }

	function uploadStudentPhoto(){
		$STUDIDNO = $this->input->post("PICSTUDIDNO");
		//die($_SERVER['SERVER_NAME']);
        if (!empty($_FILES['file']['name']))
		{

            $file_name = $_FILES['file']['name'];

            $image_extensions_allowed = array('jpg', 'jpeg', 'png', 'gif','bmp');
            $ext = strtolower(substr(strrchr($file_name, "."), 1));

            if(!in_array($ext, $image_extensions_allowed))
            {
            $exts = implode(', ',$image_extensions_allowed);
            $error .= "You must upload a file with one of the following extensions: ".$exts;
            $data = array("succses"=>false, "data"=>$error);
            die(json_encode($data));
            }

			$filename = $_FILES['file']['name'];
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/images/studentPhotos/".$filename;
			$pic = "http://".$_SERVER['SERVER_NAME']."/images/studentPhotos/".$filename;

			if (!move_uploaded_file($_FILES['file']['tmp_name'], "$uploaddir"))
			{
				$data = array("success"=>false, "data"=> "File was not uploaded." );
				die(json_encode($data));
			}
		}

    	$this->lithefire->updateRow("default", "lithefzj_engine.COLLHIST", array("PICTURE"=>$pic), "STUDIDNO = '$STUDIDNO'");
        $data['filename'] = $pic;
        $data['success'] = true;
        $data['data'] = "File successfully uploaded";
        die(json_encode($data));
       

        $data['success'] = false;
        $data['data'] = mysql_error();
        die(json_encode($data));
        

    }

	function subjectassignment(){
   
        $data['title'] = 'Student Web Portal: Subject Assignment';
        $data['userId'] = $this->session->userData('userId');
        $data['userName'] = $this->session->userData('userName');


        $this->layout->view('admin/subject_assignment_view', $data);

    }
	
	function getCourseFaculty(){
        
        $db = "default";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        $COURIDNO=$this->input->post('COURIDNO');
        
        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');
        $filter = "a.COURIDNO = '$COURIDNO'";
        $group = "";

        if(empty($sort) && empty($dir)){
            $sort = "ADVISER ASC";
        }else{
            $sort = "$sort $dir";
        }

        $fr_db = $this->config->item("fr_db");
		$swp_db = $this->config->item("swp_db");

        $records = array();
        $table = "$swp_db.COURADVI a LEFT JOIN $fr_db.FILEADVI b ON a.ADVIIDNO = b.ADVIIDNO";
		
        $fields = array("a.id", "b.IDNO", "b.ADVISER", "b.ADVIIDNO");

        

        if(!empty($querystring))
            $filter .= " AND (b.IDNO LIKE '%$querystring%' OR b.ADVISER LIKE '%$querystring%')";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
        if($records){
        foreach($records as $row):
          //  $row['COURSE'] = $this->commonmodel->getFieldWhere($db, "FILECOUR", "COURIDNO", $row['COURIDNO'], "COURSE");
            $temp[] = $row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, "");
        die(json_encode($data));
	}

	function addCourseFaculty(){        
        $db = 'default';
        
        $swp_db = $this->config->item("swp_db");
		$table = "$swp_db.COURADVI";
		
		$input = $this->input->post();
        if($this->lithefire->countFilteredRows($db, $table, "COURIDNO = '".$this->input->post("COURIDNO")."' AND ADVIIDNO = '".$input['ADVIIDNO']."'", "")){
            $data['success'] = false;
            $data['data'] = "Faculty already exists for this course";
            die(json_encode($data));
        }
        
		//$input['CURRIDNO'] = $this->lithefire->getNextCharId($db, $table, 'CURRIDNO', 5);
        $data = $this->lithefire->insertRow($db, $table, $input);

        die(json_encode($data));
    }
	
	function deleteCourseFaculty(){
        
		$swp_db = $this->config->item("swp_db");
        $table = "$swp_db.COURADVI";
		
        $param = "id";
       // $fields = $this->input->post();
		$db = "default";
        $id=$this->input->post('id');
		
		$filter = "$param = $id";
        $data = $this->lithefire->deleteRow($db, $table, $filter);
		

        die(json_encode($data));
    }
	
	function getFacultySubject(){
        
        $db = "default";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        $ADVIIDNO=$this->input->post('ADVIIDNO');
        
        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');
        $filter = "a.ADVIIDNO = '$ADVIIDNO'";
        $group = "";

        if(empty($sort) && empty($dir)){
            $sort = "SUBJCODE ASC";
        }else{
            $sort = "$sort $dir";
        }

        $fr_db = $this->config->item("fr_db");
		$swp_db = $this->config->item("swp_db");

        $records = array();
        $table = "$swp_db.ADVISUBJ a LEFT JOIN $fr_db.FILESUBJ b ON a.SUBJIDNO = b.SUBJIDNO";
		
        $fields = array("a.id", "b.SUBJCODE", "b.COURSEDESC");

        

        if(!empty($querystring))
            $filter .= " AND (b.SUBJCODE LIKE '%$querystring%' OR b.COURSEDESC LIKE '%$querystring%')";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
        if($records){
        foreach($records as $row):
          //  $row['COURSE'] = $this->commonmodel->getFieldWhere($db, "FILECOUR", "COURIDNO", $row['COURIDNO'], "COURSE");
            $temp[] = $row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, "");
        die(json_encode($data));
	}

	function addFacultySubject(){        
        $db = 'default';
        
        $swp_db = $this->config->item("swp_db");
		$table = "$swp_db.ADVISUBJ";
		
		$input = $this->input->post();
        if($this->lithefire->countFilteredRows($db, $table, "SUBJIDNO = '".$this->input->post("SUBJIDNO")."' AND ADVIIDNO = '".$input['ADVIIDNO']."'", "")){
            $data['success'] = false;
            $data['data'] = "Subject already exists for this faculty";
            die(json_encode($data));
        }
        
		//$input['CURRIDNO'] = $this->lithefire->getNextCharId($db, $table, 'CURRIDNO', 5);
        $data = $this->lithefire->insertRow($db, $table, $input);

        die(json_encode($data));
    }
	
	function deleteFacultySubject(){
        
		$swp_db = $this->config->item("swp_db");
        $table = "$swp_db.ADVISUBJ";
		
        $param = "id";
       // $fields = $this->input->post();
		$db = "default";
        $id=$this->input->post('id');
		
		$filter = "$param = $id";
        $data = $this->lithefire->deleteRow($db, $table, $filter);
		

        die(json_encode($data));
    }
	
	function downloadStudentReport($SCHEIDNO, $SECTIDNO, $COURIDNO, $SEMEIDNO, $YEAR){
		ini_set("memory_limit", "512M");
		$this->load->model('hmvc/MyPDF','',TRUE);	
      	$pdf = new MyPDF("L", "pt", "Legal", true, 'UTF-8', false);
		
		//ini_set("memory_limit","12M");

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Darryl Anaud');
		$pdf->SetTitle('TCPDF Example 001');
		//$pdf->SetSubject('TCPDF Tutorial');
		//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		
		// set default header data
		$pdf->SetHeaderData("LITHEFIRE.jpg", 100, 'Lithefire Solutions Inc.', "www.lithefire.net");
		
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		//set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, 90, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(10);
		$pdf->SetFooterMargin(10);
		
		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		//set some language-dependent strings
		//$pdf->setLanguageArray($l);
		
		// ---------------------------------------------------------
		
		// set default font subsetting mode
		$pdf->setFontSubsetting(false);
		
		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		$pdf->SetFont('helvetica', '', 8, '', true);
		
		// Add a page
		// This method has several options, check the source code documentation for more information.
		$pdf->AddPage();
		
	
		
		
		// ---------------------------------------------------------
		
		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		

        $db = "default";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        
		//$SCHEIDNO=$this->input->post('SUBJIDNO');
		//$COURIDNO=$this->input->post('SUBJCOURIDNO');
		//$SECTIDNO=$this->input->post('SUBJSECTIDNO');
		//$SEMEIDNO=$this->input->post('SEMEIDNO3');
		//$YEAR=$this->input->post('SUBJYEARIDNO');

        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');
        $filter = "";
        $group = "";

        if(empty($sort) && empty($dir)){
            $sort = "f.YEAR, f.SECTION, b.SUBJCODE ASC, a.NAME";
        }else{
            $sort = "$sort $dir";
        }

        $fr_db = $this->config->item("fr_db");

        $records = array();
		
		$default_db = $this->config->item('default_db');
		$database = $default_db.$SEMEIDNO;
		
        $table = $database.".FILESCHE b LEFT JOIN ".$fr_db.".FILESUBJ c ON b.SUBJIDNO = c.SUBJIDNO
        LEFT JOIN $fr_db.FILEADVI d ON b.ADVIIDNO = d.ADVIIDNO LEFT JOIN
        $fr_db.FILECOUR e ON b.COURIDNO = e.COURIDNO LEFT JOIN ".$database.".FILESECT f ON b.SECTIDNO = f.SECTIDNO LEFT JOIN ".$database.".SCHEDULE a ON a.SCHEIDNO = b.SCHEIDNO";
        $fields = array("a.id", "a.STUDIDNO", "a.IDNO", "a.NAME", "c.SUBJCODE", "c.COURSEDESC", "c.UNITS_TTL", "d.ADVISER", "e.COURSE", "f.YEAR", "f.SECTION");

        //$filter = "a.GENDIDNO = b.GENDIDNO";
		if($SCHEIDNO != 0)
			$filter = "b.SCHEIDNO = $SCHEIDNO";
		if($COURIDNO){
			if(empty($filter))
			$filter = "b.COURIDNO = $COURIDNO";
			else
			$filter .= " AND b.COURIDNO = $COURIDNO";
		}	
		
		if($SECTIDNO){
			if(empty($filter))
			$filter = "b.SECTIDNO = $SECTIDNO";
			else
			$filter .= " AND b.SECTIDNO = $SECTIDNO";
		}
		
		if($YEAR){
			if(empty($filter))
			$filter = "f.YEAR = '$YEAR'";
			else
			$filter .= " AND f.YEAR = '$YEAR'";
		}
			
        if(!empty($querystring)){
        	if(empty($filter))
			$filter = "(NAME LIKE '%$querystring%' OR COURSE LIKE '%$querystring%' OR SUBJECT LIKE '%$querystring%')";
			else
            $filter .= " AND (NAME LIKE '%$querystring%' OR COURSE LIKE '%$querystring%' OR SUBJECT LIKE '%$querystring%')";
		}

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
        $temp_subj = "";
		
		$y = 90;
		   			
		$pdf->SetFillColor(255, 255, 255);
		$pdf->SetXY(20, $y);
   		$html = '<table style="text-align: center; border: 1px solid black">';
		
        if($records){
        	$temp_subj = $records[0]['SUBJCODE'];
        	$temp_sect = $records[0]['SECTION'];
			//die($temp_subj);
        foreach($records as $row):
       
			
			
				
			
			
			if($temp_subj != $row['SUBJCODE'] || $temp_sect != $row['SECTION']){
				//$temp[] = array();
				$temp_subj = $row['SUBJCODE'];
				$temp_sect = $row['SECTION'];
				$html.="</table>";
				$pdf->writeHTML($html, true, false, false, false, '');
			//	$pdf->Output('example_001.pdf', 'D');
				$html = '<table style="text-align: center; border: 1px solid black">';
				//$pdf->SetXY(20, $y);
				$pdf->SetX(20);
			}
			
			 $html .= "<tr>";
			$html .= '<td style="border: 1px solid black; width: 70pt;">'.$row['SUBJCODE'].'</td>';
			$html .= '<td style="border: 1px solid black; width: 140pt;">'.$row['COURSEDESC'].'</td>';
			$html .= '<td style="border: 1px solid black; width: 30pt;">'.$row['UNITS_TTL'].'</td>';
			$html .= '<td style="border: 1px solid black; width: 140pt;">'.$row['ADVISER'].'</td>';
			$html .= '<td style="border: 1px solid black; width: 70pt;">'.$row['IDNO'].'</td>';
			$html .= '<td style="border: 1px solid black; width: 190pt;">'.$row['NAME'].'</td>';
			$html .= '<td style="border: 1px solid black; width: 190pt;">'.$row['COURSE'].'</td>';
			$html .= '<td style="border: 1px solid black; width: 70pt;">'.$row['YEAR'].'</td>';
			$html .= '<td style="border: 1px solid black; width: 70pt;">'.$row['SECTION'].'</td>';
			$html .= "</tr>";
			
			//die($check);
			//if($check)
			/*
		  	$xvalue = 20;
            $pdf->SetXY($xvalue, $y);
   								
   			$pdf->Cell(70, 10, $row['SUBJCODE'], 'TBLR', 0, 'C', 1);
			$xvalue = 90;   			
	   		$pdf->SetXY($xvalue, $y);					
	   		$pdf->Cell(140, 10, $row['COURSEDESC'], 'TBLR', 0, 'C', 1);
	   		
	   		$xvalue = 230;   			
	   		$pdf->SetXY($xvalue, $y);				
	   		$pdf->Cell(30, 10, $row['UNITS_TTL'], 'TBLR', 0, 'C', 1);	
	      
	   		$xvalue = 260;   			
	   		$pdf->SetXY($xvalue, $y);					
	   		$pdf->Cell(140, 10, $row['ADVISER'], 'TBLR', 0, 'C', 1);	
			
			$xvalue = 400;   			
	   		$pdf->SetXY($xvalue, $y);					
	   		$pdf->Cell(70, 10, $row['IDNO'], 'TBLR', 0, 'C', 1);	
			
			$xvalue = 470;   			
	   		$pdf->SetXY($xvalue, $y);				
	   		$pdf->Cell(190, 10, $row['NAME'], 'TBLR', 0, 'C', 1);	
			
			$xvalue = 660;   			
	   		$pdf->SetXY($xvalue, $y);					
	   		$pdf->Cell(190, 10, $row['COURSE'], 'TBLR', 0, 'C', 1);	
	   		
	      	$xvalue = 850;   			
	   		$pdf->SetXY($xvalue, $y);				
	   		$pdf->Cell(70, 10, $row['YEAR'], 'TBLR', 0, 'C', 1);	
			
			$xvalue = 920;   			
	   		$pdf->SetXY($xvalue, $y);				
	   		$pdf->Cell(70, 10, $row['SECTION'], 'TBLR', 0, 'C', 1);	
			*/
			//$y += 10;
			
			//$check = $pdf->CheckPageBreak($y);
		  	
	     /*   if ($y == 580)
	        {
			    $pdf->AddPage();
				
				$x = 20;
				$y = 80;
				$pdf->SetXY($x, $y);
				$pdf->SetFillColor(237, 237, 237);
				$pdf->Cell(70, 10, "Subject Code", 'TBLR', 0, 'C', 1);
				
				$xvalue = 90;   			
		   		$pdf->SetXY($xvalue, $y);
		   		$pdf->SetFillColor(237, 237, 237);						
		   		$pdf->Cell(140, 10, "Description", 'TBLR', 0, 'C', 1);
		   		
		   		$xvalue = 230;   			
		   		$pdf->SetXY($xvalue, $y);
		   		$pdf->SetFillColor(237, 237, 237);						
		   		$pdf->Cell(30, 10, "Units", 'TBLR', 0, 'C', 1);	
		      
		   		$xvalue = 260;   			
		   		$pdf->SetXY($xvalue, $y);
		   		$pdf->SetFillColor(237, 237, 237);						
		   		$pdf->Cell(140, 10, "Adviser", 'TBLR', 0, 'C', 1);	
				
				$xvalue = 400;   			
		   		$pdf->SetXY($xvalue, $y);
		   		$pdf->SetFillColor(237, 237, 237);						
		   		$pdf->Cell(70, 10, "Student Id", 'TBLR', 0, 'C', 1);	
				
				$xvalue = 470;   			
		   		$pdf->SetXY($xvalue, $y);
		   		$pdf->SetFillColor(237, 237, 237);						
		   		$pdf->Cell(190, 10, "Student Name", 'TBLR', 0, 'C', 1);	
				
				$xvalue = 660;   			
		   		$pdf->SetXY($xvalue, $y);
		   		$pdf->SetFillColor(237, 237, 237);						
		   		$pdf->Cell(190, 10, "Course", 'TBLR', 0, 'C', 1);	
		   		
		      	$xvalue = 850;   			
		   		$pdf->SetXY($xvalue, $y);
		   		$pdf->SetFillColor(237, 237, 237);						
		   		$pdf->Cell(70, 10, "Year", 'TBLR', 0, 'C', 1);	
				
				$xvalue = 920;   			
		   		$pdf->SetXY($xvalue, $y);
		   		$pdf->SetFillColor(237, 237, 237);						
		   		$pdf->Cell(70, 10, "Section", 'TBLR', 0, 'C', 1);	
	            
	            $y = 90;
	        }*/
          //  $temp[] = $row;
           // $total++;

        endforeach;
        }
$html .= "</table>";
//die($html);
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output('example_001.pdf', 'D');
      /*  $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, "");
        die(json_encode($data));*/
    }
    
    function user_log(){
	$data['title'] = 'User Log | SWP';
        $data['userId'] = $this->session->userData('userId');
        $data['userName'] = $this->session->userData('userName');

        $this->layout->view('admin/user_log_view', $data);
    }
    
    function getUserLog(){
        
        $db = "default";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        
        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');
        $filter = "";
        $group = "";
        $logdb = $this->config->item("log_db");
        if(empty($sort) && empty($dir)){
            $sort = "login_time DESC";
        }else{
            $sort = "$sort $dir";
        }

        $fr_db = $this->config->item("fr_db");

        $records = array();
        $table = "$logdb.USERLOG";
		
        $fields = array("username", "login_time", "logout_time");
        
        if(!empty($querystring))
            $filter = "(username LIKE '%$querystring%' OR login_time LIKE '%$querystring%')";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);


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
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, "");
        die(json_encode($data));
    }
    
    function getTotalUserLogin(){
        
        $db = "default";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        
        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');
        $filter = "";
        $group = "";
        $logdb = $this->config->item("log_db");
        if(empty($sort) && empty($dir)){
            $sort = "login_time DESC";
        }else{
            $sort = "$sort $dir";
        }

        $fr_db = $this->config->item("fr_db");

        $records = array();
        $table = "$logdb.USERLOG";
		
        $fields = array("id", "username", "login_time", "logout_time");
        
        if(!empty($querystring))
            $filter = "(username LIKE '%$querystring%' OR login_time LIKE '%$querystring%')";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);


        $temp = array();
        $total_array = array();
        
        $total = 0;
        if($records){
        foreach($records as $row):
            //$temp[] = $row;
            //$total++;
            if(empty($row['logout_time'])){
                $row['logout_time'] = date("Y-m-d H:i:s", strtotime ($row['login_time']."+5 minutes"));
              //  die("abcde ".gmdate("H:i:s", ));
            }
            
            if(empty($total_array[$row['username']]))
            $total_array[$row['username']] = (strtotime($row['logout_time'])-strtotime($row['login_time'])) ;
            else
            $total_array[$row['username']] += (strtotime($row['logout_time'])-strtotime($row['login_time'])) ;

        endforeach;
        }
        //die(print_r($total_array));
        foreach($total_array as $k => $val):
           
            $temp[] = array("username"=>$k, "total_login_time"=>  gmdate("H:i:s", $val));
        
        endforeach;
        
        
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, "");
        die(json_encode($data));
    }
	
	
}