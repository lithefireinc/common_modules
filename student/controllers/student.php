<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends MY_Controller {
	
	private $current_date;
    private $current_time;
	
	function Student(){
		parent::__construct();
		$this->current_date = date("Y-m-d");
        $this->current_time = date("H:i:s");
		
	}

	function profile(){
   		
        $data['title'] = $this->config->item("app_name").': Student Profile';
        $data['userId'] = $this->session->userData('userId');
		
        $username = $this->session->userdata('userName');
		$username_identity = $this->session->userdata($this->config->item('session_identifier', 'ion_auth').'_userName');
		if(isset($username_identity) && !empty($username_identity)){
			$data['userName'] = $username_identity;
		}elseif(isset($username)){
        	$data['userName'] = $username;
		}
		
		$data['add'] = 0;
		$data['edit'] = 0;
		$data['delete'] = 0;
		$data['view'] = 1;
       $record = $this->lithefire->getRecordWhere("default", "tbl_access", "username = '".$data['userName']."'", array("*"));
	   if($record){
	   	$data['add'] = $record[0]['add'];
		$data['edit'] = $record[0]['edit'];
		$data['delete'] = $record[0]['delete'];
		$data['view'] = $record[0]['view'];
	   } 
       $this->layout->view('student/student_profile_view', $data);
    }
	
	function getStudentInfo(){
        

        
        $db = "fr";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');
        $filter = "";
        $group = "";

        if(empty($sort) && empty($dir)){
            $sort = "STUDCODE DESC";
        }else{
            $sort = "$sort $dir";
        }

        

        $records = array();
        $table = "COLLHIST a LEFT JOIN FILEGEND b ON a.GENDIDNO = b.GENDIDNO";
        $fields = array("a.STUDCODE, a.STUDIDNO, a.NAME, a.FIRSTNAME, a.MIDDLENAME, a.LASTNAME, b.GENDER, a.BIRTHDATE, a.BIRTHPLACE, a.IDNO");

        //$filter = "a.GENDIDNO = b.GENDIDNO";

        if(!empty($querystring))
            $filter = "(STUDCODE LIKE '%$querystring%' OR STUDIDNO LIKE '%$querystring%' OR NAME LIKE '%$querystring%' OR FIRSTNAME LIKE '%$querystring%')";

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
    
    function getMyInformation(){
        
        $db = "fr";
		
		
		$SEMEIDNO = $this->input->post("SEMEIDNO");
		
		if(empty($SEMEIDNO))
			$SEMEIDNO = $this->lithefire->getFieldWhere($db, "FILESEME", "IS_ACTIVE = 1", "SEMEIDNO");
		
		$ogs_db = $this->config->item('ogs_db');
		$database = $ogs_db.$SEMEIDNO;
		$table = "$database.COLLEGE";
		$default_db = $this->config->item('default_db');
		$swp_db = $this->config->item('swp_db');
		
        $table = "COLLHIST a LEFT JOIN FILECITI ON a.CITIIDNO = FILECITI.CITIIDNO LEFT JOIN FILERELI ON a.RELIIDNO = FILERELI.RELIIDNO LEFT JOIN FILECOUR ON a.COURIDNO = FILECOUR.COURIDNO
        LEFT JOIN $database.COLLEGE b ON a.STUDIDNO = b.STUDIDNO LEFT JOIN FILESTTY ON a.STTYIDNO = FILESTTY.STTYIDNO
        LEFT JOIN FILEDEPARTMENT ON a.DEPTIDNO = FILEDEPARTMENT.DEPTIDNO LEFT JOIN FILECOUN c ON a.COUNIDNO = c.COUNIDNO
        LEFT JOIN FILECOUN d ON a.P_COUNIDNO = d.COUNIDNO LEFT JOIN FILEOCCU e ON a.F_OCCUIDNO = e.OCCUIDNO
        LEFT JOIN FILEOCCU f ON a.M_OCCUIDNO = f.OCCUIDNO LEFT JOIN FILESCHOLAR ON a.SCHOLARIDNO = FILESCHOLAR.SCHOLARIDNO
        LEFT JOIN $swp_db.REQUIREMENTS REQ ON a.STUDIDNO = REQ.STUDIDNO LEFT JOIN FILESTLE ON a.YEAR = FILESTLE.YEAR";
		
        $fields = "a.*, FILECITI.CITIZENSHIP, FILERELI.RELIGION, FILECOUR.COURSE, b.SECTION, STUDTYPE, DEPARTMENT, c.DESCRIPTION as COUNTRY, d.DESCRIPTION AS P_COUNTRY,
        e.OCCUPATION as F_OCCUPATION, f.OCCUPATION as M_OCCUPATION, SCHOLARSHIP, REQ.MEDICAL, REQ.CARD, REQ.GOODMORAL,
        REQ.PIC, REQ.BIRTHCERT, REQ.TOR, REQ.HONODISM, REQ.ENTREXAM, REQ.ENGLEXAM, REQ.MEDICAL_NOTES, REQ.DOCUMENT_NOTES,
        REQ.EXAM_NOTES, FILESTLE.DESCRIPTIO AS YEAR, FILESTLE.YEAR AS STLE";

        $id=$this->session->userData('userCode');

        $filter = "a.STUDIDNO = '$id'";
        //$filter.=" AND a.COURIDNO = FILECOUR.COURIDNO AND a.CITIIDNO = FILECITI.CITIIDNO AND a.RELIIDNO = FILERELI.RELIIDNO";

        $records = array();
        $records = $this->lithefire->getRecordWhere($db, $table, $filter, $fields);



        $temp = array();

        foreach($records as $row):

       // $filename = $this->lithefire->getFieldWhere("default", "tbl_student_photo", "student_id = '".$row['STUDIDNO']."'", "filename");
        if(!empty($row['PICTURE'])){
        $row['filename'] = base_url().$filename;
        }else{
            $row['filename'] = "/images/icon_pic.jpg";
        }
            $temp[] = $row;


        endforeach;

        $data['data'] = $temp;
        $data['success'] = true;

        die(json_encode($data));
    }
    
    function uploadPhoto(){
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

           // $extension = $ext;


	/*if ($_FILES['file']['type'] != 'image/jpeg')
	{ $data = array("success"=>false, "data"=> "Please upload a photo in a Jpeg format.");
	   die(json_encode($data));
	}*/
			//$data = array("success"=>false, "data"=> "Die here..." );
			//sdie(json_encode($data));
			/*
			if ($_FILES['enovaphoto']['type'] != 'image/jpeg')
			{
				$data = array("success"=>false, "data"=> "Please upload a photo in a Jpeg format.");
				die(json_encode($data));
			}
			*/
			//$uploadfile = "INFOBAHN_Reference"."_".date('B')."_".$_FILES['refdoc']['name'];
			$filename = $_FILES['file']['name'];
			$uploaddir = "studentPhotos/".$filename;

			if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir))
			{
				$data = array("success"=>false, "data"=> "File was not uploaded." );
				die(json_encode($data));
			}
	}

        $id=$this->input->post('student_id');
		
		$fr_db = $this->config->item("fr_db");
		$default_db = $this->config->item("default_db");

        
        if(!empty($id)){
         $input['student_id'] = $id;
        }else{
        	
        $db = $fr_db;
        $table = "COLLHIST";

        $input['student_id'] = $this->commonmodel->getNextId($db, $table);
        }
        $input['filename'] = $uploaddir;

        $db = "default";
        $table = "tbl_student_photo";

        $filter = array("student_id"=>$input['student_id']);
        $param = 'student_id';

        if($this->commonmodel->getNumRecords($db, $table, "", "", $filter)){
            $data = $this->commonmodel->updateRecord($db, $table, $input, $param, $input['student_id']);
        }else{
            $data = $this->commonmodel->insertRecord($db, $table, $input);
        }




        $data['filename'] = base_url().$uploaddir;
        $data['success'] = true;
        $data['data'] = "File successfully uploaded";
        die(json_encode($data));
       

        $data['success'] = false;
        $data['data'] = mysql_error();
        die(json_encode($data));
        

    }

    function getStudent(){
        
        $db = "default";
        
        $fields = array("STUDCODE as id",  "NAME as name", "STUDIDNO");
        $filter = "";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        $SEMEIDNO=$this->input->post('SEMEIDNO');


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $query = $this->input->post('query');
        

        if(empty($sort) && empty($dir)){
            $sort = "NAME ASC";
        }else{
            $sort = "$sort $dir";
        }
        
        if(!empty($query)){
            $filter = "(STUDIDNO LIKE '%$query%' OR NAME LIKE '%$query%')";
        }

        $group = array();
		
		$default_db = $this->config->item('default_db');
		$database = $default_db.$SEMEIDNO;
		$table = "$database.COLLEGE";

        $records = array();
        $records = $this->lithefire->getAllRecords($db, $table, $fields,  $start, $limit, $sort, $filter, $group);
		$temp = array();

        if($records){
        foreach($records as $row):

            $temp[] = $row;


        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
    }

    function getSchoolYear(){
        
        $db = "default";
        $table = "tbl_school_year";
        $fields = "*";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $query = $this->input->post('query');
        $queryby = "";

        if(empty($sort) && empty($dir)){
            $sort = "description";
            $dir = "ASC";
        }

        if(!empty($query)){
            $queryby = array("description");

        }
        $records = array();
        $records = $this->commonmodel->getAllRecords($db, $table, $sort, $dir, $queryby, $query,  $fields, $start, $limit);



        $temp = array();
        if($records){
        foreach($records as $row):

            $temp[] = array("id"=>$row['id'], "name"=>$row['description']);


        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->commonmodel->getNumRecords($db, $table, $queryby, $query);
        die(json_encode($data));
    }

    function getSemester(){
        
        $db = "default";
        $table = "tbl_semester";
        $fields = "*";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $query = $this->input->post('query');
        $queryby = "";

        if(empty($sort) && empty($dir)){
            $sort = "description";
            $dir = "ASC";
        }

        if(!empty($query)){
            $queryby = array("description");

        }
        $records = array();
        $records = $this->commonmodel->getAllRecords($db, $table, $sort, $dir, $queryby, $query,  $fields, $start, $limit);



        $temp = array();
        if($records){
        foreach($records as $row):

            $temp[] = array("id"=>$row['id'], "name"=>$row['description']);


        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->commonmodel->getNumRecords($db, $table, $queryby, $query);
        die(json_encode($data));
    }

    function getCourse(){
        
        $db = "default";
        $table = "tbl_course";
        $fields = "*";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $query = $this->input->post('query');
        $queryby = "";

        if(empty($sort) && empty($dir)){
            $sort = "description";
            $dir = "ASC";
        }

        if(!empty($query)){
            $queryby = array("description");

        }
        $records = array();
        $records = $this->commonmodel->getAllRecords($db, $table, $sort, $dir, $queryby, $query,  $fields, $start, $limit);



        $temp = array();
        if($records){
        foreach($records as $row):

            $temp[] = array("id"=>$row['id'], "name"=>$row['description']);


        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->commonmodel->getNumRecords($db, $table, $queryby, $query);
        die(json_encode($data));
    }

    function getSection(){
        
        $db = "default";
        $table = "tbl_section";
        $fields = "*";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $query = $this->input->post('query');
        $queryby = "";

        if(empty($sort) && empty($dir)){
            $sort = "description";
            $dir = "ASC";
        }

        if(!empty($query)){
            $queryby = array("description");

        }
        $records = array();
        $records = $this->commonmodel->getAllRecords($db, $table, $sort, $dir, $queryby, $query,  $fields, $start, $limit);



        $temp = array();
        if($records){
        foreach($records as $row):

            $temp[] = array("id"=>$row['id'], "name"=>$row['description']);


        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->commonmodel->getNumRecords($db, $table, $queryby, $query);
        die(json_encode($data));
    }

    function insertStudentInfo(){
        $db = "fr";
        $table = "COLLHIST";
        
        $input = array();
        foreach($this->input->post() as $key => $val){
 
                $input[$key] = strtoupper($val);
            
        }

        if(!empty($input['SAME']))
            $input['SAME'] = 1;
        else
            $input['SAME'] = 0;
        
        $input['FIRSTNAME'] = strtoupper($input['FIRSTNAME']);
        $input['MIDDLENAME'] = strtoupper($input['MIDDLENAME']);
        $input['LASTNAME'] = strtoupper($input['LASTNAME']);

        $input['NAME'] = $input['LASTNAME'].", ".$input['FIRSTNAME']." ".$input['MIDDLENAME'];
		
		unset($input['SECTIDNO']);
		unset($input['searchby_scho']);
		unset($input['searchby_honor']);
		
		$reqt_input = array("STUDIDNO"=>$input['STUDIDNO'], "MEDICAL_NOTES"=>$input['MEDICAL_NOTES'], "DOCUMENT_NOTES"=>$input['DOCUMENT_NOTES'], "EXAM_NOTES"=>$input['EXAM_NOTES']);
		
		unset($input['DOCUMENT_NOTES']);
		unset($input['EXAM_NOTES']);
		unset($input['MEDICAL_NOTES']);
		
		if(isset($input['MEDICAL'])){
			$reqt_input['MEDICAL'] = 1;
			unset($input['MEDICAL']);
		}else{
			$reqt_input['MEDICAL'] = 0;
		}
		
		if(isset($input['CARD'])){
			$reqt_input['CARD'] = 1;
			unset($input['CARD']);
		}else{
			$reqt_input['CARD'] = 0;
		}

		if(isset($input['GOODMORAL'])){
			$reqt_input['GOODMORAL'] = 1;
			unset($input['GOODMORAL']);
		}else{
			$reqt_input['GOODMORAL'] = 0;
		}
		
		if(isset($input['PIC'])){
			$reqt_input['PIC'] = 1;
			unset($input['PIC']);
		}else{
			$reqt_input['PIC'] = 0;
		}
		
		if(isset($input['BIRTHCERT'])){
			$reqt_input['BIRTHCERT'] = 1;
			unset($input['BIRTHCERT']);
		}else{
			$reqt_input['BIRTHCERT'] = 0;
		}
		
		if(isset($input['TOR'])){
			$reqt_input['TOR'] = 1;
			unset($input['TOR']);
		}else{
			$reqt_input['TOR'] = 0;
		}
		
		if(isset($input['HONODISM'])){
			$reqt_input['HONODISM'] = 1;
			unset($input['HONODISM']);
		}else{
			$reqt_input['HONODISM'] = 0;
		}
		
		if(isset($input['ENTREXAM'])){
			$reqt_input['ENTREXAM'] = 1;
			unset($input['ENTREXAM']);
		}else{
			$reqt_input['ENTREXAM'] = 0;
		}
		
		if(isset($input['ENGLEXAM'])){
			$reqt_input['ENGLEXAM'] = 1;
			unset($input['ENGLEXAM']);
		}else{
			$reqt_input['ENGLEXAM'] = 0;
		}
		
		if($this->lithefire->countFilteredRows($db, $table, "STUDIDNO = '".$input['STUDIDNO']."'", "")){
			$data['success'] = false;
			$data['data'] = "Student ID already exists";
			die(json_encode($data));
		}
		
        $data = $this->lithefire->insertRow($db, $table, $input);
		$this->lithefire->insertRow("default", "REQUIREMENTS", $reqt_input);
        die(json_encode($data));

    }

    function loadStudent(){
        
        $db = "fr";
		
		
		$SEMEIDNO = $this->input->post("SEMEIDNO");
		
		if(empty($SEMEIDNO))
			$SEMEIDNO = $this->lithefire->getFieldWhere($db, "FILESEME", "IS_ACTIVE = 1", "SEMEIDNO");
		
		$ogs_db = $this->config->item('ogs_db');
		$database = $ogs_db.$SEMEIDNO;
		$table = "$database.COLLEGE";
		$default_db = $this->config->item('default_db');
		$swp_db = $this->config->item('swp_db');
		
        $table = "COLLHIST a LEFT JOIN FILECITI ON a.CITIIDNO = FILECITI.CITIIDNO LEFT JOIN FILERELI ON a.RELIIDNO = FILERELI.RELIIDNO LEFT JOIN FILECOUR ON a.COURIDNO = FILECOUR.COURIDNO
        LEFT JOIN $database.COLLEGE b ON a.STUDIDNO = b.STUDIDNO LEFT JOIN FILESTTY ON a.STTYIDNO = FILESTTY.STTYIDNO
        LEFT JOIN FILEDEPARTMENT ON a.DEPTIDNO = FILEDEPARTMENT.DEPTIDNO LEFT JOIN FILECOUN c ON a.COUNIDNO = c.COUNIDNO
        LEFT JOIN FILECOUN d ON a.P_COUNIDNO = d.COUNIDNO LEFT JOIN FILEOCCU e ON a.F_OCCUIDNO = e.OCCUIDNO
        LEFT JOIN FILEOCCU f ON a.M_OCCUIDNO = f.OCCUIDNO LEFT JOIN FILESCHOLAR ON a.SCHOLARIDNO = FILESCHOLAR.SCHOLARIDNO
        LEFT JOIN $swp_db.REQUIREMENTS REQ ON a.STUDIDNO = REQ.STUDIDNO LEFT JOIN FILESTLE ON a.YEAR = FILESTLE.YEAR";
		
        $fields = "a.*, FILECITI.CITIZENSHIP, FILERELI.RELIGION, FILECOUR.COURSE, b.SECTION, STUDTYPE, DEPARTMENT, c.DESCRIPTION as COUNTRY, d.DESCRIPTION AS P_COUNTRY,
        e.OCCUPATION as F_OCCUPATION, f.OCCUPATION as M_OCCUPATION, SCHOLARSHIP, REQ.MEDICAL, REQ.CARD, REQ.GOODMORAL,
        REQ.PIC, REQ.BIRTHCERT, REQ.TOR, REQ.HONODISM, REQ.ENTREXAM, REQ.ENGLEXAM, REQ.MEDICAL_NOTES, REQ.DOCUMENT_NOTES,
        REQ.EXAM_NOTES, FILESTLE.DESCRIPTIO AS YEAR, FILESTLE.YEAR AS STLE";

        $id=$this->input->post('id');

        $filter = "a.STUDIDNO = '$id'";
        //$filter.=" AND a.COURIDNO = FILECOUR.COURIDNO AND a.CITIIDNO = FILECITI.CITIIDNO AND a.RELIIDNO = FILERELI.RELIIDNO";

        $records = array();
        $records = $this->lithefire->getRecordWhere($db, $table, $filter, $fields);



        $temp = array();

        foreach($records as $row):

       // $filename = $this->lithefire->getFieldWhere("default", "tbl_student_photo", "student_id = '".$row['STUDIDNO']."'", "filename");
        if(!empty($row['PICTURE'])){
        $row['filename'] = $row['PICTURE'];
        }else{
            $row['filename'] = "/images/icon_pic.jpg";
        }
            $data["data"] = $row;


        endforeach;

       // $data['data'] = $temp;
        $data['success'] = true;

        die(json_encode($data));
    }
    
    function loadStudentId(){
        
        $db = "fr";
        $table = "information_schema.tables";
        $fields = "AUTO_INCREMENT";
        
		$fr_db = $this->config->item("fr_db");
		$default_db = $this->config->item("default_db");
		
		$filter = "table_name = 'COLLHIST' AND table_schema = '$fr_db'";


        //$filter.=" AND a.COURIDNO = FILECOUR.COURIDNO AND a.CITIIDNO = FILECITI.CITIIDNO AND a.RELIIDNO = FILERELI.RELIIDNO";

        $records = array();
        $records = $this->lithefire->getRecordWhere($db, $table, $filter, $fields);





            $data["data"] = array("STUDIDNO"=>str_pad($records[0]['AUTO_INCREMENT']+1, 10, '0', STR_PAD_LEFT));




       // $data['data'] = $temp;
        $data['success'] = true;

        die(json_encode($data));
    }

    function updateStudent(){
        
        $db = "fr";
        $table = "COLLHIST";
        $param = "STUDCODE";
       // $fields = $this->input->post();

        $id=$this->input->post('id');
        $temp_input = $this->input->post();
        $temp_input['id'] = null;
        $input = array();
        foreach($temp_input as $key => $val){
            if($val !== null){
                $input[$key] = strtoupper($val);
            }
        }
        if(!empty($input['SAME']))
            $input['SAME'] = 1;
        else
            $input['SAME'] = 0;
        $input['FIRSTNAME'] = strtoupper($input['FIRSTNAME']);
        $input['MIDDLENAME'] = strtoupper($input['MIDDLENAME']);
        $input['LASTNAME'] = strtoupper($input['LASTNAME']);

        $input['NAME'] = $input['LASTNAME'].", ".$input['FIRSTNAME']." ".$input['MIDDLENAME'];

        $filter = "STUDIDNO = '$id'";
        $records = array();
		
		if($this->lithefire->countFilteredRows($db, $table, "IDNO = '".$input['STUDIDNO']."' AND STUDIDNO != '$id'", "")){
			$data['success'] = false;
			$data['data'] = "Student ID already exists";
			die(json_encode($data));
		}
		
		unset($input['SECTIDNO']);
		unset($input['searchby_scho']);
		unset($input['searchby_honor']);
		
		$reqt_input = array("STUDIDNO"=>$input['STUDIDNO'], "MEDICAL_NOTES"=>$input['MEDICAL_NOTES'], "DOCUMENT_NOTES"=>$input['DOCUMENT_NOTES'], "EXAM_NOTES"=>$input['EXAM_NOTES']);
		
		unset($input['DOCUMENT_NOTES']);
		unset($input['EXAM_NOTES']);
		unset($input['MEDICAL_NOTES']);
		
		if(isset($input['MEDICAL'])){
			$reqt_input['MEDICAL'] = 1;
			unset($input['MEDICAL']);
		}else{
			$reqt_input['MEDICAL'] = 0;
		}
		
		if(isset($input['CARD'])){
			$reqt_input['CARD'] = 1;
			unset($input['CARD']);
		}else{
			$reqt_input['CARD'] = 0;
		}

		if(isset($input['GOODMORAL'])){
			$reqt_input['GOODMORAL'] = 1;
			unset($input['GOODMORAL']);
		}else{
			$reqt_input['GOODMORAL'] = 0;
		}
		
		if(isset($input['PIC'])){
			$reqt_input['PIC'] = 1;
			unset($input['PIC']);
		}else{
			$reqt_input['PIC'] = 0;
		}
		
		if(isset($input['BIRTHCERT'])){
			$reqt_input['BIRTHCERT'] = 1;
			unset($input['BIRTHCERT']);
		}else{
			$reqt_input['BIRTHCERT'] = 0;
		}
		
		if(isset($input['TOR'])){
			$reqt_input['TOR'] = 1;
			unset($input['TOR']);
		}else{
			$reqt_input['TOR'] = 0;
		}
		
		if(isset($input['HONODISM'])){
			$reqt_input['HONODISM'] = 1;
			unset($input['HONODISM']);
		}else{
			$reqt_input['HONODISM'] = 0;
		}
		
		if(isset($input['ENTREXAM'])){
			$reqt_input['ENTREXAM'] = 1;
			unset($input['ENTREXAM']);
		}else{
			$reqt_input['ENTREXAM'] = 0;
		}
		
		if(isset($input['ENGLEXAM'])){
			$reqt_input['ENGLEXAM'] = 1;
			unset($input['ENGLEXAM']);
		}else{
			$reqt_input['ENGLEXAM'] = 0;
		}

		$swp_db = $this->config->item("swp_db");
		if($this->lithefire->countFilteredRows("default", $swp_db.'.REQUIREMENTS', "STUDIDNO = '".$input['STUDIDNO']."'", "")){
			$this->lithefire->updateRow("default", $swp_db.'.REQUIREMENTS', $reqt_input, "STUDIDNO = '".$input['STUDIDNO']."'");	
		}else{
			$this->lithefire->insertRow("default", "$swp_db.REQUIREMENTS", $reqt_input);
		}
		
		
        $data = $this->lithefire->updateRow($db, $table, $input, $filter);


        die(json_encode($data));
    }

    function deleteStudent(){
        
        $db = "fr";
        $table = "COLLHIST";

        $id=$this->input->post('id');

       $filter = "STUDCODE = '$id'";

        $data = $this->commonmodel->deleteRow($db, $table, $filter);


        die(json_encode($data));
    }

    function getSubject(){
        
        $db = "default";
        $table = "tbl_subject";
        $fields = "DISTINCT tbl_subject.*";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $query = $this->input->post('query');
        $queryby = "";

        if(empty($sort) && empty($dir)){
            $sort = "description";
            $dir = "ASC";
        }

        if(!empty($query)){
            $queryby = array("description");

        }

     

        $filter = array();

        $join = array();

        $records = array();
        $records = $this->commonmodel->getFilteredRecords($db, $table, $sort, $dir, $queryby, $query,  $fields, $start, $limit, $filter, $join);



        $temp = array();
        if($records){
        foreach($records as $row):

            $temp[] = array("id"=>$row['id'], "name"=>$row['code']." - ".$row['description']);


        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->commonmodel->getFilteredNumRecords($db, $table, $sort, $dir, $queryby, $query,  $fields, $start, $limit, $filter, $join);
        die(json_encode($data));
    }

	function addStudentSchool(){
        
		$swp_db = $this->config->item('swp_db');
        $db = 'default';
        $table = "$swp_db.SCHOHIST";
		$input = $this->input->post();
        if($this->lithefire->countFilteredRows($db, $table, "STUDIDNO = '".$input["STUDIDNO"]."' AND SCHOIDNO = '".$input['SCHOIDNO']."'", "")){
            $data['success'] = false;
            $data['data'] = "Record already exists";
            die(json_encode($data));
        }
        
		//$input['BOTYIDNO'] = $this-> lithefire->getNextCharId($db, $table, 'BOTYIDNO', 3);
        $data = $this->lithefire->insertRow($db, $table, $input);

        die(json_encode($data));
    }

	function addStudentHonors(){
        
		$swp_db = $this->config->item('swp_db');
        $db = 'default';
        $table = "$swp_db.STUDHONORS";
		$input = $this->input->post();
        if($this->lithefire->countFilteredRows($db, $table, "STUDIDNO = '".$input["STUDIDNO"]."' AND HONORS = '".$input['HONORS']."'", "")){
            $data['success'] = false;
            $data['data'] = "Record already exists";
            die(json_encode($data));
        }
        
		//$input['BOTYIDNO'] = $this-> lithefire->getNextCharId($db, $table, 'BOTYIDNO', 3);
        $data = $this->lithefire->insertRow($db, $table, $input);

        die(json_encode($data));
    }

	function getSchoolHistory(){
        
        $db = 'default';
		$STUDIDNO = $this->input->post('STUDIDNO');
        $filter = "STUDIDNO = '$STUDIDNO'";
        $group = "";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');



        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');


        if(empty($sort) && empty($dir)){
            $sort = "SCHOOL_YEAR DESC";
        }else{
            $sort = "$sort $dir";
        }

        if(!empty($querystring)){
            $filter .= "AND (b.SCHOOL LIKE '%$querystring%' OR b.SCHOIDNO LIKE '%$querystring%')";
        }
        
		$fr_db = $this->config->item('fr_db');
		$swp_db = $this->config->item('swp_db');
		
        $records = array();
        $table = "$swp_db.SCHOHIST a LEFT JOIN $fr_db.FILESCHO b ON a.SCHOIDNO = b.SCHOIDNO";
        $fields = array("a.SCHOIDNO", "b.SCHOOL as SCHOOL_HIST", "a.SCHOOL_YEAR", "a.LEVEL");

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
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
    }

    function getHonorsHistory(){
        
        $db = 'default';
		$STUDIDNO = $this->input->post('STUDIDNO');
        $filter = "STUDIDNO = '$STUDIDNO'";
        $group = "";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');



        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');


        if(empty($sort) && empty($dir)){
            $sort = "HONOR_YEAR DESC";
        }else{
            $sort = "$sort $dir";
        }

        if(!empty($querystring)){
            $filter .= "AND (HONORS LIKE '%$querystring%' OR DESCRIPTION LIKE '%$querystring%')";
        }
        
		$fr_db = $this->config->item('fr_db');
		$swp_db = $this->config->item('swp_db');
		
        $records = array();
        $table = "$swp_db.STUDHONORS";
        $fields = array("*");

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
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
    }

	function deleteSchoolHistory(){
        
        
		$swp_db = $this->config->item('swp_db');
        $table = "$swp_db.SCHOHIST";
        $param = "SCHOIDNO";
       // $fields = $this->input->post();
		$db = "default";
        $id=$this->input->post('id');
		$STUDIDNO = $this->input->post('STUDIDNO');
		$filter = "$param = '$id' AND STUDIDNO = '$STUDIDNO'";

        $data = $this->lithefire->deleteRow($db, $table, $filter);

        die(json_encode($data));
    }
	
	function deleteHonors(){
        
        
		$swp_db = $this->config->item('swp_db');
        $table = "$swp_db.STUDHONORS";
        $param = "HONOCODE";
       // $fields = $this->input->post();
		$db = "default";
        $id=$this->input->post('id');
		$STUDIDNO = $this->input->post('STUDIDNO');
		$filter = "$param = '$id' AND STUDIDNO = '$STUDIDNO'";

        $data = $this->lithefire->deleteRow($db, $table, $filter);

        die(json_encode($data));
    }
	
	function financial(){
   
        $data['title'] = 'Student Web Portal: Student Profile';
        $data['userId'] = $this->session->userData('userId');
        $data['userName'] = $this->session->userData('userName');


        $this->layout->view('student/financial_records_view', $data);

    }
	
	function curriculum(){
   
        $data['title'] = 'Student Web Portal: Student Profile';
        $data['userId'] = $this->session->userData('userId');
        $data['userName'] = $this->session->userData('userName');


        $this->layout->view('student/curriculum_view', $data);

    }
	
	function getCurriculumSubjects(){
        
        $db = "default";
		$fr_db = $this->config->item("fr_db");
		
		$studidno = $this->session->userdata('userCode');
		
		$COURIDNO = $this->lithefire->getFieldWhere("fr", "COLLHIST", "STUDIDNO = '$studidno'", "COURIDNO");
		
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

        

        $records = array();
        $table = "CURRSUBJ a LEFT JOIN $fr_db.FILESTLE b ON a.YEAR = b.YEAR LEFT JOIN $fr_db.FILESUBJ c ON a.SUBJIDNO = c.SUBJIDNO";
		
        $fields = array("a.YEAR", "a.SUBJIDNO", "a.COURIDNO", "c.SUBJCODE", "c.COURSEDESC", "b.DESCRIPTIO", "c.UNITS_TTL", "c.UNITS_LAB");

        

        if(!empty($querystring))
            $filter .= "AND (YEAR LIKE '%$querystring%' OR SUBJCODE LIKE '%$querystring%' OR COURSEDESC LIKE '%$querystring%')";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
		
		
        if($records){
        		$first_level = $records[0]['YEAR'];
				$ctr = 0;
				$units_ttl = 0;
				$units_lab_ttl = 0;
				$year_units_ttl = 0;
				$year_units_lab_ttl = 0;
        	
        foreach($records as $row):
          //  $row['COURSE'] = $this->commonmodel->getFieldWhere($db, "FILECOUR", "COURIDNO", $row['COURIDNO'], "COURSE");
          $row['SUBJECT'] = "(".$row['SUBJCODE'].") ".$row['COURSEDESC'];
		  if($row['YEAR'] == $first_level && $ctr != 0)
		  $row['YEAR'] = "";
		  else{
		  $first_level = $row['YEAR'];
		  
		  if($ctr != 0){
		  if(!empty($year_units_ttl))
		  $temp[] = array("SUBJECT"=>"<span style='font-weight: bold'>Total Units: </span>", "UNITS"=>$year_units_ttl." ($year_units_lab_ttl)");
		  $temp[] = array();
		  }
		  $year_units_ttl = 0;
		  $year_units_lab_ttl = 0;
		  }
		  
		  if(!empty($row['YEAR']))
		  $row['YEAR'] = $row['YEAR']." - ".$row['DESCRIPTIO'];
		  
		  //if($row['UNITS_LAB'] != '0')
		  	$row['UNITS'] = $row['UNITS_TTL']." (".$row['UNITS_LAB'].")";
		 // else
		 // 	$row['UNITS'] = $row['UNITS_TTL'];
		 $prereq = $this->lithefire->getAllRecords("default", "PREREQ", array("PREREQ"), "", "", "", "SUBJIDNO = '".$row['SUBJIDNO']."' AND COURIDNO = '".$row['COURIDNO']."'", "");
		  if($prereq){
		  $prerequisite = array();
		  foreach($prereq as $r){
		  	$prerequisite[] = $r['PREREQ'];
		  }
		  	$row['PREREQ'] = implode(',', $prerequisite);
		  }
		  	$row['SEMESTER'] = $this->lithefire->getFieldWhere("default", "TRANSCRIPT", "SUBJCODE = '".$row['SUBJCODE']."' AND STUDIDNO = '$studidno'", "SEMESTER");
            $temp[] = $row;
            $total++;
            $ctr++;
			$units_ttl+=(int)$row['UNITS_TTL'];
			$year_units_ttl+=(int)$row['UNITS_TTL'];
			$units_lab_ttl+=(int)$row['UNITS_LAB'];
			$year_units_lab_ttl+=(int)$row['UNITS_LAB'];

        endforeach;
        }
        if(!empty($units_ttl)){
		$temp[] = array("SUBJECT"=>"<span style='font-weight: bold'>Total Units: </span>", "UNITS"=>$year_units_ttl." ($year_units_lab_ttl)");
		$temp[] = array();
		$temp[] = array("SUBJECT"=>"<span style='font-weight: bold'>Overall Total Units: </span>", "UNITS"=>$units_ttl." ($units_lab_ttl)");
		}
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, "");
        die(json_encode($data));
	}

	function borrowingHistory(){



        $data['userId'] = $this->session->userdata('userId');
		$data['IDNO'] = $this->session->userdata('userCode');
        $data['userName'] = $this->session->userdata('userName');
        $data['title'] = 'ILS: File Reference';


        
        $this->layout->view('student/borrowing_history_view', $data);
        
    }

	function account($activeTab){


        $data['title'] = 'OGS: User Account';
        $data['userId'] = $this->session->userdata('userId');
		$data['userType'] = $this->session->userdata('userType');
        $data['code'] = $this->session->userdata('code');
		$data['userCode'] = $this->session->userdata('userCode');
        $data['userName'] = $this->session->userdata('userName');
        $data['activeTab'] = $activeTab;


        $this->layout->view('student/account_view', $data);
    }

    function getSubjectsPerStudent(){
        
        
        //$this->load->library('encrypt');

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        $db = "default";


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');

        $STUDIDNO = $this->input->post('STUDIDNO');

        if(empty($STUDIDNO))
        $STUDIDNO = $this->session->userData('userCode');
        
        $SEMEIDNO = $this->input->post('SEMEIDNO');

        $querystring = $this->input->post('query');

        $filter = "b.STUDIDNO = '$STUDIDNO'";
		$group = "";
		$having = "";

         if(!empty($querystring))
        $filter .= " AND (e.COURSEDESC LIKE '%$querystring%' OR e.SUBJCODE LIKE '%$querystring%' OR f.days LIKE '%$querystring%')";

        if(empty($sort) && empty($dir)){
            $sort = "NAME";
        }else{
        	$sort = "$sort $dir";
        }
		
		$fr_db = $this->config->item("fr_db");


        $records = array();
		
		$default_db = $this->config->item("ogs_db");
		$database = $default_db.$SEMEIDNO;
		
        $table = $database.".GRADES b LEFT JOIN ".$database.".FILESCHE d ON b.SCHEIDNO = d.SCHEIDNO
            LEFT JOIN ".$fr_db.".FILESUBJ e ON d.SUBJIDNO = e.SUBJIDNO
            LEFT JOIN $fr_db.FILEDAYS f ON d.DAYSIDNO = f.DAYSIDNO
            LEFT JOIN $fr_db.FILETIME g ON d.TIMEIDNO = g.TIMEIDNO
            LEFT JOIN $fr_db.FILEADVI h ON d.ADVIIDNO = h.ADVIIDNO
            LEFT JOIN $fr_db.FILEROOM i ON d.ROOMIDNO = i.ROOMIDNO";
        $fields = array("b.SCHEDULEIDNO as id, b.STUDIDNO, b.IDNO, b.NAME, 
            b.PRELIM, b.MIDTERM, b.FINAL, b.AVERAGE, b.REMARKS, e.SUBJCODE, 
            e.COURSEDESC, e.UNITS_TTL, f.DAYS, g.TIME, h.ADVISER,
            i.ROOM");

        
        
      //      $filter['SCHEIDNO'] = $SCHEIDNO;

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
        if($records){
        foreach($records as $row):
            /*if(empty($temp)){
                if(empty($querystring) || stristr("All Employees", $querystring))
                $temp[] = array("id"=>0, "name"=>"All Courses");
            }*/
          //  if(!($this->lithefire->decryptString($row['PRELIM'], $row['STUDIDNO'].$this->config->item('grade_key')) === false))
            $row['PRELIM'] = $this->lithefire->decryptString($row['PRELIM'], $row['STUDIDNO'].$this->config->item('grade_key'));

         //   if(!($this->lithefire->decryptString($row['MIDTERM'], $row['STUDIDNO'].$this->config->item('grade_key')) === false))
            $row['MIDTERM'] = $this->lithefire->decryptString($row['MIDTERM'], $row['STUDIDNO'].$this->config->item('grade_key'));

          //  if(!($this->lithefire->decryptString($row['FINAL'], $row['STUDIDNO'].$this->config->item('grade_key')) === false))
            $row['FINAL'] = $this->lithefire->decryptString($row['FINAL'], $row['STUDIDNO'].$this->config->item('grade_key'));
			
		//	if(!($this->lithefire->decryptString($row['AVERAGE'], $row['STUDIDNO'].$this->config->item('grade_key')) === false))
        //    $row['AVERAGE'] = $this->encrypt->decode($row['AVERAGE'], $row['STUDIDNO'].$this->config->item('grade_key'));
        
        	$PRELIM_FROM = $this->lithefire->getFieldWhere("default", "$database.GRADEENTRYRESTRICTION", "SEMEIDNO = '$SEMEIDNO' AND PERIOD = 'PRELIM'", "date_from");
			$PRELIM_TO = $this->lithefire->getFieldWhere("default", "$database.GRADEENTRYRESTRICTION", "SEMEIDNO = '$SEMEIDNO' AND PERIOD = 'PRELIM'", "date_to");
			
			$MIDTERM_FROM = $this->lithefire->getFieldWhere("default", "$database.GRADEENTRYRESTRICTION", "SEMEIDNO = '$SEMEIDNO' AND PERIOD = 'MIDTERM'", "date_from");
			$MIDTERM_TO = $this->lithefire->getFieldWhere("default", "$database.GRADEENTRYRESTRICTION", "SEMEIDNO = '$SEMEIDNO' AND PERIOD = 'MIDTERM'", "date_to");
			//die($this->checkDate($MIDTERM_FROM, $MIDTERM_TO));
			//die("checkdate: ".$this->checkDate($PRELIM_FROM, $PRELIM_TO));
			$FINAL_FROM = $this->lithefire->getFieldWhere("default", "$database.GRADEENTRYRESTRICTION", "SEMEIDNO = '$SEMEIDNO' AND PERIOD = 'FINAL'", "date_from");
			$FINAL_TO = $this->lithefire->getFieldWhere("default", "$database.GRADEENTRYRESTRICTION", "SEMEIDNO = '$SEMEIDNO' AND PERIOD = 'FINAL'", "date_to");
			//$row['PRELIM_EDITABLE'] = $this->checkDate($PRELIM_FROM, $PRELIM_TO);
			//$row['MIDTERM_EDITABLE'] = $this->checkDate($MIDTERM_FROM, $MIDTERM_TO);
			
			if($row['PRELIM'] > 0)
			$row['PRELIM_EDITABLE'] = 0;
			else
			$row['PRELIM_EDITABLE'] = 1;
			
			if($row['MIDTERM'] > 0)
			$row['MIDTERM_EDITABLE'] = 0;
			else
			$row['MIDTERM_EDITABLE'] = 1;
			
			$date = date("Y-m-d");
			if($row['FINAL'] > 0)
			$row['FINAL_EDITABLE'] = 0;
			else
			$row['FINAL_EDITABLE'] = 1;
			
			$row['PRELIM_TO'] = $PRELIM_TO;
			$row['MIDTERM_TO'] = $MIDTERM_TO;
			$row['FINAL_TO'] = $FINAL_TO;
			
            $temp[] = $row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
    }

    function getAttendancePerSubject(){
        


        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        $db = "default";
		
		$SEMEIDNO = $this->input->post('SEMEIDNO');


        $sortstr = $this->input->post('sort');
        $dirstr = $this->input->post('dir');
        $SCHEDULEIDNO = $this->input->post('SCHEDULEIDNO');


        $querystring = $this->input->post('query');

        $query = array();

         if(!empty($querystring)){
         $query = "(b.SCHEDULEDATE LIKE '%$querystring%' OR b.STATUS LIKE '%$querystring%')";
      


         }
        $sort = "SCHEDULEDATE ASC";
        $dir = "";
        if(empty($sortstr) && empty($dirstr)){
            $sort="SCHEDULEDATE ASC";

        }

        $records = array();
		$ogs_db = $this->config->item("ogs_db").$SEMEIDNO;
        $table = "$ogs_db.SCHEDULE a JOIN $ogs_db.ATTENDANCE b ON a.id = b.SCHEDULEIDNO JOIN $ogs_db.COLLEGE c ON a.STUDIDNO = c.STUDIDNO";
        $fields = array("b.id, c.STUDIDNO, c.IDNO, c.NAME, b.SCHEDULEDATE, b.STATUS");

        $filter = "b.SCHEDULEIDNO = '$SCHEDULEIDNO'";





        $records = $this->faculty_model->getAllRows($db, $table, $fields, $start, $limit, $sort, $dir, $query, $filter);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;

       
        if($records){
        foreach($records as $row):
            /*if(empty($temp)){
                if(empty($querystring) || stristr("All Employees", $querystring))
                $temp[] = array("id"=>0, "name"=>"All Courses");
            }*/
         
            
            $row['DAY'] = date("l", strtotime($row['SCHEDULEDATE']));

            $temp[] = $row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->faculty_model->countFilteredRows($db, $table, $query, $filter);
        die(json_encode($data));
    }

	function transcript(){
        

        $data['title'] = 'OGS: Transcript of Records';
        $data['userId'] = $this->session->userdata('userId');
        $data['code'] = $this->session->userdata('code');
        $data['userName'] = $this->session->userdata('userName');
        //$data['activeTab'] = $activeTab;

     
        $this->layout->view('student/transcript_view', $data);
    }
	
	function getTranscript(){
        
        
		
       // $this->load->library('encrypt');

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        $db = "default";
		
		$swp_db = $this->config->item("swp_db");


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');

        $STUDIDNO = $this->input->post('STUDIDNO');

        if(empty($STUDIDNO))
        $STUDIDNO = $this->session->userData('userCode');
        
        $SEMEIDNO = $this->input->post('SEMEIDNO');

        $querystring = $this->input->post('query');

        $query = array();
		$filter = "STUDIDNO = '$STUDIDNO'";
         if(!empty($querystring))
        $filter .= " AND (SEMESTER LIKE '%$querystring%' OR SUBJCODE LIKE '%$querystring%' OR COURSEDESC LIKE '%$querystring%')";

        if(empty($sort) && empty($dir)){
            $sort = "SEMEIDNO ASC, SCHEIDNO";
        }else{
        	$sort = "SEMEIDNO ASC, $sort $dir";
        }
		
		$fr_db = $this->config->item("fr_db");
		$default_db = $this->config->item("default_db");

        $records = array();
        $table = "$swp_db.TRANSCRIPT";
        $fields = array("SEMESTER", "SUBJCODE", "COURSEDESC", "UNITS_TTL", "AVERAGE");

        
        
		$group = "";
		$having = "";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
        $temp_sem = "";
        if($records){
        foreach($records as $row):
        	if(empty($temp)){
        		$temp_sem = $row['SEMESTER'];
        		$temp[] = array("SEMESTER"=>'<span style="font-weight: bold">'.$row['SEMESTER'].'</span>');
        	}
        	
        	if($temp_sem != $row['SEMESTER']){
        		$temp[] = array("SEMESTER"=>'<span style="font-weight: bold">'.$row['SEMESTER'].'</span>');
        		$temp_sem = $row['SEMESTER'];
        	}
  
			$row['SEMESTER'] = "";
            $temp[] = $row;
            $total++;

        endforeach;
        }
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
    }

	function profileChange(){
        

        $data['title'] = 'OGS: Profile Change Request';
        $data['userId'] = $this->session->userdata('userId');
        $data['code'] = $this->session->userdata('code');
        $data['userName'] = $this->session->userdata('userName');
  

 
        $this->layout->view('student/profile_change_request_view', $data);
    }
   
    function submitProfileChange(){
        

        $db = "default";
        $table = "PROFILECHANGE";
       // $param = "SCHEDULEIDNO";
        $data = array();
        $user_name = $this->session->userdata('userName');

        $update_data = str_replace('\\', '', $this->input->post('data'));

        $update_data = json_decode($update_data, true);

        //die(print_r($update_data));
        $date = date("Y-m-d");
		$time = date("H:i:s");

        $input = array();
        $log_input = array();

        foreach($update_data as $key => $value):
        //die($this->encrypt->encode($value['PRELIM']));
       // $time_out = date('H:i:s', strtotime($value['time_in']."+9 hours"));
		$RELIGION = $this->lithefire->getFieldWhere("fr", "FILERELI", "RELIGION = '".$value['RELIGION']."'", "RELIIDNO");
		$CITIZENSHIP = $this->lithefire->getFieldWhere("fr", "FILECITI", "CITIZENSHIP = '".$value['CITIZENSHIP']."'", "CITIIDNO");
		if($this->lithefire->countFilteredRows($db, $table, "STUDCODE = '".$value['STUDCODE']."' AND STATUS = 'Pending'", "")){
			$this->lithefire->updateRow($db, $table, array("STATUS"=>"Cancelled"), "STUDCODE = '".$value['STUDCODE']."' AND STATUS = 'Pending'");
		}
        $input = array("STUDCODE"=>$value['STUDCODE'], "STUDIDNO"=>$value['STUDIDNO'], "LASTNAME"=>strtoupper($value['LASTNAME']),
		"FIRSTNAME"=>strtoupper($value['FIRSTNAME']), "MIDDLENAME"=>strtoupper($value['MIDDLENAME']), "BIRTHDATE"=>date('Y-m-d', strtotime(substr($value['BIRTHDATE'], 0, 10))),
		"BIRTHPLACE"=>strtoupper($value['BIRTHPLACE']), "RELIIDNO"=>$RELIGION, "CITIIDNO"=>$CITIZENSHIP, "C_ADDR01"=>strtoupper($value['C_ADDR01']),
		"C_ADDR02"=>strtoupper($value['C_ADDR02']), "C_ADDR03"=>strtoupper($value['C_ADDR03']), "P_ADDR01"=>strtoupper($value['P_ADDR01']),
		"P_ADDR02"=>strtoupper($value['P_ADDR02']), "P_ADDR03"=>strtoupper($value['P_ADDR03']), "WEBSITE"=>$value['WEBSITE'], "EMAIL"=>$value['EMAIL'], "STATUS"=>"Pending",
		"DCREATED"=>$date, "TCREATED"=>$time, "REQUESTED_BY"=>$user_name);
        
        $data = $this->lithefire->insertRow($db, $table, $input);
		$data['data'] = "Request submitted successfully";
        //$log_input = array("SCHEDULEIDNO"=>$value['id'], "MODIFIED_BY"=>$user_name, "DMODIFIED"=>$this->current_date, "TMODIFIED"=>$this->current_time);
        //$this->faculty_model->insertRow($db, "grade_log", $log_input);
        endforeach;

        die(json_encode($data));
    }

	function checkDate($date_from, $date_to){
		$today = date("Y-m-d");
		if($today >= $date_from && $today <= $date_to)
		return 1;
		
		return 0;
	}
	
	function getFinancialSubjects(){
		$start=$this->input->post('start');
        $limit=$this->input->post('limit');
        $db = "fr";


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');

        $STUDIDNO = $this->input->post('STUDIDNO');

        if(empty($STUDIDNO))
        $STUDIDNO = $this->session->userData('userCode');
        
        $SEMEIDNO = $this->input->post('SEMEIDNO');
		
		if(empty($SEMEIDNO))
			$SEMEIDNO = SEMEIDNO;
		//die($SEMEIDNO);
        $querystring = $this->input->post('query');
		
		$default_db = $this->config->item("ogs_db");
		$database = $default_db.$SEMEIDNO;

        $filter = "SUBJIDNO IN (SELECT SUBJIDNO FROM $database.FILESCHE WHERE SCHEIDNO IN (SELECT SCHEIDNO FROM $database.SCHEDULE WHERE STUDIDNO = '$STUDIDNO'))";
		$group = "";
		$having = "";

        // if(!empty($querystring))
       // $filter .= " AND (e.COURSEDESC LIKE '%$querystring%' OR e.SUBJCODE LIKE '%$querystring%' OR f.days LIKE '%$querystring%')";

        if(empty($sort) && empty($dir)){
            $sort = "";
        }else{
        	$sort = "$sort $dir";
        }
		
		$fr_db = $this->config->item("fr_db");

        $records = array();
		
		
		
        $table = "FILESUBJ";
        $fields = array("SUBJCODE", "COURSEDESC", "UNITS_TTL", "FEE_TUI");

        
        
      //      $filter['SCHEIDNO'] = $SCHEIDNO;

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;
		$units_ttl = 0;
		$fee_ttl = 0;
		
        if($records){
        foreach($records as $row):
        	if(is_numeric($row['UNITS_TTL']))
        		$units_ttl+=$row['UNITS_TTL'];
			$row['FEE_TUI'] = number_format($row['FEE_TUI'],2,'.',',');			
			$fee_ttl+=$row['UNITS_TTL']*$row['FEE_TUI'];
				
            $temp[] = $row;
            $total++;

        endforeach;
        }
		
		$total_paid = $this->lithefire->getFieldWhere("default", "COLLMISV", "PARTICULAR = 'Tuition.Enrollment' AND STUDIDNO = '$STUDIDNO'", "TOTALPAID");
		
		$temp[] = array("COURSEDESC"=>"<span style='font-weight: bold'>Total</span>", "UNITS_TTL"=>"<span style='font-weight: bold'>$units_ttl</span>", "FEE_TUI"=>"<span style='font-weight: bold'>".number_format($fee_ttl,2)."</span>", "PAID"=>"<span style='font-weight: bold'>".number_format($total_paid,2)."</span>");
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
	}

	function getLabFee(){
		$start=$this->input->post('start');
        $limit=$this->input->post('limit');
        $db = "default";


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');

        $STUDIDNO = $this->input->post('STUDIDNO');

        if(empty($STUDIDNO))
        $STUDIDNO = $this->session->userData('userCode');
        
        $SEMEIDNO = $this->input->post('SEMEIDNO');
		
		if(empty($SEMEIDNO))
			$SEMEIDNO = SEMEIDNO;
		//die($SEMEIDNO);
        $querystring = $this->input->post('query');
		
		$default_db = $this->config->item("ogs_db");
		$database = $default_db.$SEMEIDNO;

        $filter = "a.STUDIDNO = '$STUDIDNO'";
		$group = "";
		$having = "";

        // if(!empty($querystring))
       // $filter .= " AND (e.COURSEDESC LIKE '%$querystring%' OR e.SUBJCODE LIKE '%$querystring%' OR f.days LIKE '%$querystring%')";

        if(empty($sort) && empty($dir)){
            $sort = "LABORATORY";
        }else{
        	$sort = "$sort $dir";
        }
		
		$fr_db = $this->config->item("fr_db");

        $records = array();
		
		$YEAR = $this->lithefire->getFieldWhere("default", "$database.COLLEGE", "STUDIDNO = '$STUDIDNO'", "YEAR");
		
        $table = "COLLMISV a JOIN FEESLABO b ON a.PARTIDNO =  b.FELAIDNO";
        $fields = array("PARTICULAR AS LABORATORY", "TOTAL as FEE", "TOTALPAID AS PAID");

        
        
      //      $filter['SCHEIDNO'] = $SCHEIDNO;

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;

		$pets_db = $this->config->item("financial_db");
		$fee_db = $pets_db.$SEMEIDNO;
		
        if($records){
        foreach($records as $row):
   
			$row['BALANCE'] = number_format($row['FEE']-$row['PAID'], 2);
			$row['FEE'] = number_format($row['FEE'], 2, '.', ',');
   			$row['PAID'] = number_format($row['PAID'], 2, '.', ',');	
            $temp[] = $row;
            $total++;

        endforeach;
        }
		
		//$total_paid = $this->lithefire->getFieldWhere("default", "COLLMISV", "PARTICULAR = 'Tuition.Enrollment' AND STUDIDNO = '$STUDIDNO'", "TOTALPAID");
		
		//$temp[] = array("COURSEDESC"=>"<span style='font-weight: bold'>Total</span>", "UNITS_TTL"=>"<span style='font-weight: bold'>$units_ttl</span>", "FEE_TUI"=>"<span style='font-weight: bold'>".number_format($fee_ttl,2)."</span>", "PAID"=>"<span style='font-weight: bold'>".number_format($total_paid,2)."</span>");
		
		
		
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
	}

	function getMiscFee(){
		$start=$this->input->post('start');
        $limit=$this->input->post('limit');
        $db = "default";


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');

        $STUDIDNO = $this->input->post('STUDIDNO');

        if(empty($STUDIDNO))
        $STUDIDNO = $this->session->userData('userCode');
        
        $SEMEIDNO = $this->input->post('SEMEIDNO');
		
		if(empty($SEMEIDNO))
			$SEMEIDNO = SEMEIDNO;
		//die($SEMEIDNO);
        $querystring = $this->input->post('query');
		
		$default_db = $this->config->item("ogs_db");
		$database = $default_db.$SEMEIDNO;

        $filter = "a.STUDIDNO = '$STUDIDNO'";
		$group = "";
		$having = "";

        // if(!empty($querystring))
       // $filter .= " AND (e.COURSEDESC LIKE '%$querystring%' OR e.SUBJCODE LIKE '%$querystring%' OR f.days LIKE '%$querystring%')";

        if(empty($sort) && empty($dir)){
            $sort = "a.PARTICULAR";
        }else{
        	$sort = "$sort $dir";
        }
		
		$fr_db = $this->config->item("fr_db");

        $records = array();
		
		$YEAR = $this->lithefire->getFieldWhere("default", "$database.COLLEGE", "STUDIDNO = '$STUDIDNO'", "YEAR");
		
        $table = "COLLMISV a JOIN FEESMISC b ON a.PARTIDNO =  b.FEMIIDNO";
        $fields = array("a.PARTICULAR AS MISC", "TOTAL as FEE", "TOTALPAID AS PAID");

        
        
      //      $filter['SCHEIDNO'] = $SCHEIDNO;

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;

		$pets_db = $this->config->item("financial_db");
		$fee_db = $pets_db.$SEMEIDNO;
		
        if($records){
        foreach($records as $row):
			$row['BALANCE'] = number_format($row['FEE']-$row['PAID'], 2);
			$row['FEE'] = number_format($row['FEE'], 2, '.', ',');
   			$row['PAID'] = number_format($row['PAID'], 2, '.', ',');
            $temp[] = $row;
            $total++;

        endforeach;
        }
		
		//$total_paid = $this->lithefire->getFieldWhere("default", "COLLMISV", "PARTICULAR = 'Tuition.Enrollment' AND STUDIDNO = '$STUDIDNO'", "TOTALPAID");
		
		//$temp[] = array("COURSEDESC"=>"<span style='font-weight: bold'>Total</span>", "UNITS_TTL"=>"<span style='font-weight: bold'>$units_ttl</span>", "FEE_TUI"=>"<span style='font-weight: bold'>".number_format($fee_ttl,2)."</span>", "PAID"=>"<span style='font-weight: bold'>".number_format($total_paid,2)."</span>");
		
		
		
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
	}

	function getOtherFee(){
		$start=$this->input->post('start');
        $limit=$this->input->post('limit');
        $db = "default";


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');

        $STUDIDNO = $this->input->post('STUDIDNO');

        if(empty($STUDIDNO))
        $STUDIDNO = $this->session->userData('userCode');
        
        $SEMEIDNO = $this->input->post('SEMEIDNO');
		
		if(empty($SEMEIDNO))
			$SEMEIDNO = SEMEIDNO;
		//die($SEMEIDNO);
        $querystring = $this->input->post('query');
		
		$default_db = $this->config->item("ogs_db");
		$database = $default_db.$SEMEIDNO;

        $filter = "a.STUDIDNO = '$STUDIDNO'";
		$group = "";
		$having = "";

        // if(!empty($querystring))
       // $filter .= " AND (e.COURSEDESC LIKE '%$querystring%' OR e.SUBJCODE LIKE '%$querystring%' OR f.days LIKE '%$querystring%')";

        if(empty($sort) && empty($dir)){
            $sort = "a.PARTICULAR";
        }else{
        	$sort = "$sort $dir";
        }
		
		$fr_db = $this->config->item("fr_db");

        $records = array();
		
		$YEAR = $this->lithefire->getFieldWhere("default", "$database.COLLEGE", "STUDIDNO = '$STUDIDNO'", "YEAR");
		
        $table = "COLLMISV a JOIN FEESOTHE b ON a.PARTIDNO =  b.FEOTIDNO";
        $fields = array("a.PARTICULAR AS OTHER", "TOTAL as FEE", "TOTALPAID AS PAID");

        
        
      //      $filter['SCHEIDNO'] = $SCHEIDNO;

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);
       // die($this->db->last_query());


        $temp = array();
        $total = 0;

		$pets_db = $this->config->item("financial_db");
		$fee_db = $pets_db.$SEMEIDNO;
		
        if($records){
        foreach($records as $row):
   
			$row['BALANCE'] = number_format($row['FEE']-$row['PAID'], 2);
			$row['FEE'] = number_format($row['FEE'], 2, '.', ',');
   			$row['PAID'] = number_format($row['PAID'], 2, '.', ',');	
            $temp[] = $row;
            $total++;

        endforeach;
        }
		
		//$total_paid = $this->lithefire->getFieldWhere("default", "COLLMISV", "PARTICULAR = 'Tuition.Enrollment' AND STUDIDNO = '$STUDIDNO'", "TOTALPAID");
		
		//$temp[] = array("COURSEDESC"=>"<span style='font-weight: bold'>Total</span>", "UNITS_TTL"=>"<span style='font-weight: bold'>$units_ttl</span>", "FEE_TUI"=>"<span style='font-weight: bold'>".number_format($fee_ttl,2)."</span>", "PAID"=>"<span style='font-weight: bold'>".number_format($total_paid,2)."</span>");
		
		
		
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
	}

	function getFeeSummary(){

        $db = "default";


        $STUDIDNO = $this->input->post('STUDIDNO');

        if(empty($STUDIDNO))
        $STUDIDNO = $this->session->userData('userCode');
        
        $SEMEIDNO = $this->input->post('SEMEIDNO');
		
		if(empty($SEMEIDNO))
			$SEMEIDNO = SEMEIDNO;
		

		
		$fr_db = $this->config->item("fr_db");
		$default_db = $this->config->item("default_db");
		$financial_db = $this->config->item("financial_db").$SEMEIDNO;

		
		$lab = $this->lithefire->getRecordWhere("default", "$financial_db.COLLMISV", "PARTIDNO IN (SELECT FELAIDNO FROM $default_db.FEESLABO) AND STUDIDNO = '$STUDIDNO'", "SUM(TOTAL) AS TOTAL, SUM(TOTALPAID) AS TOTALPAID");
		$lab_total = $lab[0]['TOTAL'];
		$lab_total_paid = $lab[0]['TOTALPAID'];
		
		$tuition = $this->lithefire->getRecordWhere("default", "$financial_db.COLLMISV", "PARTIDNO IN ('00001') AND STUDIDNO = '$STUDIDNO'", "SUM(TOTAL) AS TOTAL, SUM(TOTALPAID) AS TOTALPAID");
		$tuition_total = $tuition[0]['TOTAL'];
		$tuition_total_paid = $tuition[0]['TOTALPAID'];
		
		$misc = $this->lithefire->getRecordWhere("default", "$financial_db.COLLMISV", "PARTIDNO IN (SELECT FEMIIDNO FROM $default_db.FEESMISC) AND STUDIDNO = '$STUDIDNO'", "SUM(TOTAL) AS TOTAL, SUM(TOTALPAID) AS TOTALPAID");
		$misc_total = $misc[0]['TOTAL'];
		$misc_total_paid = $misc[0]['TOTALPAID'];
		
		$other = $this->lithefire->getRecordWhere("default", "$financial_db.COLLMISV", "PARTIDNO IN (SELECT FEOTIDNO FROM $default_db.FEESOTHE) AND STUDIDNO = '$STUDIDNO'", "SUM(TOTAL) AS TOTAL, SUM(TOTALPAID) AS TOTALPAID");
		$other_total = $other[0]['TOTAL'];
		$other_total_paid = $other[0]['TOTALPAID'];

		
		//$row['BALANCE'] = number_format($row['FEE']-$row['PAID'], 2);
		$grand_total = $tuition_total+$lab_total+$misc_total+$other_total;
		$grand_total_paid = $tuition_total_paid+$lab_total_paid+$misc_total_paid+$other_total_paid;
		
		$lab_total1 = number_format($lab_total, 2, '.', ',');
		$lab_total_paid1 = number_format($lab_total_paid, 2, '.', ',');
		$misc_total1 = number_format($misc_total, 2, '.', ',');
		$misc_total_paid1 = number_format($misc_total_paid, 2, '.', ',');
		$tuition_total1 = number_format($tuition_total, 2, '.', ',');
		$tuition_total_paid1 = number_format($tuition_total_paid, 2, '.', ',');
		$other_total1 = number_format($other_total, 2, '.', ',');
		$other_total_paid1 = number_format($other_total_paid, 2, '.', ',');
		
		$temp[] = array("DESCRIPTION"=>"Tuition", "TOTAL"=>$tuition_total1, "TOTALPAID"=>$tuition_total_paid1, "BALANCE"=>number_format($tuition_total-$tuition_total_paid, 2));
        $temp[] = array("DESCRIPTION"=>"Laboratory", "TOTAL"=>$lab_total1, "TOTALPAID"=>$lab_total_paid1, "BALANCE"=>number_format($lab_total-$lab_total_paid, 2));
        $temp[] = array("DESCRIPTION"=>"Miscellaneous", "TOTAL"=>$misc_total1, "TOTALPAID"=>$misc_total_paid1, "BALANCE"=>number_format($misc_total-$misc_total_paid, 2));
		$temp[] = array("DESCRIPTION"=>"Other Fees", "TOTAL"=>$other_total1, "TOTALPAID"=>$other_total_paid1, "BALANCE"=>number_format($other_total-$other_total_paid, 2));
		$temp[] = array("DESCRIPTION"=>"<span style='font-weight: bold'>Total</span>", 
		"TOTAL"=>"<span style='font-weight: bold'>".number_format($grand_total,2)."</span>", "TOTALPAID"=>"<span style='font-weight: bold'>".number_format($grand_total_paid,2)."</span>", "BALANCE"=>"<span style='font-weight: bold'>".number_format($grand_total-$grand_total_paid, 2)."</span>");
        
		
		
		
        $data['data'] = $temp;
        $data['success'] = true;
        $data['totalCount'] = 5;
        die(json_encode($data));
	}
	
	function getReceipts(){
        $db = 'default';
        
        $group = "";
		
		$SEMEIDNO = $this->input->post("SEMEIDNO");
		$STUDIDNO = $this->input->post("STUDIDNO");
		
		if(empty($STUDIDNO))
			$STUDIDNO = $this->session->userData('userCode');
		
		$financial_db = $this->config->item("financial_db").$SEMEIDNO;

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');


		$filter = "STUDIDNO = '$STUDIDNO'";
        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $querystring = $this->input->post('query');


        if(empty($sort) && empty($dir)){
            $sort = "DATE DESC";
        }else{
            $sort = "$sort $dir";
        }

        if(!empty($querystring)){
            $filter .= " AND (ORNO LIKE '%$querystring%' OR DATE LIKE '%$querystring%' OR PARTICULAR LIKE '%$querystring%')";
        }
        

        $records = array();
        $table = "$financial_db.COLLECT";
        $fields = array("DATE", "ORNO", "PARTICULAR", "TOTAL");

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
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
    }
	
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */