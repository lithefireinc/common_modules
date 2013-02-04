<?php
class UserMatrix extends MY_Controller
{
    function UserMatrix(){
        parent::__construct();
        
    }

    function index()
    {
    
        $data['header'] = 'Header Section';
		$data['title'] = $this->config->item("sysname").': User Access Control';
        $data['footer'] = 'Footer Section';


        $data['userId'] = $this->session->userdata('userId');
        $data['userName'] = $this->session->userdata('userName');

        //$this->load->view('header_view', $data);
        //$this->load->view('menu_view', $data);
        $this->layout->view('userMatrix/userMatrix_view', $data);
        //$this->load->view('login_view');
        //$this->load->view('footer_view', $data);
    }
	
	public function scaffolding()
    {
   
		$data['title'] = 'Scaffolding | User Matrix';
        


        $data['userId'] = $this->session->userdata('userId');
        $data['userName'] = $this->session->userdata('userName');

    
        $this->layout->view('userMatrix/scaffolding_view', $data);
    }

    function getModuleGroup(){
        $db = "default";
        $table = "module_group";
        $fields = "*";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $query = $this->input->post('query');
        $filter = "";
		$group = "";
		$having = "";

        if(empty($sort) && empty($dir)){
            $sort = "id DESC";
        }else{
        	$sort = "$sort $dir";
        }

        if(!empty($query)){
            $filter = "description LIKE '%$query%'";
        }



        $records = array();
        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);



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

    function insertModuleGroup(){
        $db = "default";
        $table = "module_group";

        $input = array();
        foreach($this->input->post() as $key => $val){
            if(!empty($val)){
                $input[$key] = $val;
            }
        }

        $data = $this->lithefire->insertRow($db, $table, $input);
        die(json_encode($data));

    }

    function loadModuleGroup(){

        $db = "default";
        $table = "module_group";
        $param = "id";
        $fields = "*";

        $id=$this->input->post('id');


		$filter = "$param = '$id'";
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

    function updateModuleGroup(){
        $db = "default";
        $table = "module_group";
        $param = "id";
       // $fields = $this->input->post();

        $id=$this->input->post('id');

        $input = array();
        foreach($this->input->post() as $key => $val){
            if(!empty($val)){
                $input[$key] = $val;

            }
        }
		$filter = "$param = '$id'";
		
        $records = array();
        $data = $this->lithefire->updateRow($db, $table, $input, $filter);


        die(json_encode($data));
    }

    function deleteModuleGroup(){
        $db = "default";
        $table = "module_group";
        $param = "id";

        $id=$this->input->post('id');

		$filter = "$param = '$id'";

        $data = $this->lithefire->deleteRow($db, $table, $filter);


        die(json_encode($data));
    }

    function getModuleGroupUsers(){
        $db = "default";
        $table = "module_group_users";
        $fields = "*";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $query = $this->input->post('query');
        $queryby = "";
        $id = $this->input->post('id');
		
		$filter = "group_id = '$id'";
		$group = "";
		$having = "";

        if(empty($sort) && empty($dir)){
            $sort = "username ASC";
        }else{
        	$sort = "$sort $dir";
        }

        if(!empty($query)){
            $filter .= "AND (username LIKE '%$query%')";
        }
       // $filter = "";
        //$filter = array("group_id"=>$id);
        //$join = array();

        $records = array();
        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);



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

    function insertModuleGroupUsers(){
        $db = "default";
        $table = "module_group_users";

        $input = array();
        foreach($this->input->post() as $key => $val){
            if(!empty($val)){
                $input[$key] = $val;
            }
        }

        $data = $this->lithefire->insertRow($db, $table, $input);
        die(json_encode($data));

    }

    function deleteModuleGroupUsers(){
        $db = "default";
        $table = "module_group_users";
        $param = "id";

        $id=$this->input->post('id');

		$filter = "$param = '$id'";

        $data = $this->lithefire->deleteRow($db, $table, $filter);


        die(json_encode($data));
    }

    function getUserName(){
        $db = "default";
        $table = "tbl_user";
        $fields = "*";

        


        $start=$this->input->post('start');
        $limit=$this->input->post('limit');


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $query = $this->input->post('query');
        

        $id = $this->input->post('id');

        if(empty($sort) && empty($dir)){
            $sort = "username ASC";
        }else{
        	$sort = "$sort $dir";
        }

        $filter = "username NOT IN (SELECT username from module_group_users WHERE group_id = $id)";
		$group = "";
		$having = "";
		
		if(!empty($query))
		$filter .= " AND username LIKE '%$query%'";




        $records = array();
        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);

        


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

    function getModuleGroupAccess(){
        $db = "default";
        $table = "module_group_access a LEFT JOIN module b ON a.module_id = b.id LEFT JOIN module_category c ON b.category_id = c.id";
        $fields = "a.id, b.description as module, c.description as category";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $query = $this->input->post('query');
        $queryby = "";
        $id = $this->input->post('id');
		$filter = "a.group_id = '$id' AND b.is_public = 0";
		$group = "";
		$having = "";

        if(empty($sort) && empty($dir)){
            $sort = "b.description";
        }else{
        	$sort = "$sort $dir";
        }

        if(!empty($query)){
            $filter .= " AND (b.description LIKE '%$query%' OR c.description LIKE '%$query%')";
        }
        //$filter = array("module.is_public"=>0, "module_group_access.group_id"=>$id);
        //$filter = array("is_delete"=>0);

        //$join = array("module"=>"module.id = module_group_access.module_id", "module_category b"=>"module.category_id = b.id");

        $records = array();
        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);


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

    function insertModuleGroupAccess(){
        $db = "default";
        $table = "module_group_access";
        $group_id = $this->input->post("groupid");

        /*$input = array();
        foreach($this->input->post() as $key => $val){
            if(!empty($val)){
                $input[$key] = $val;
            }
        }*/
        $selected_items_json = $this->input->post('selected_items');

	$selected_items_json = str_replace("\\", "", $selected_items_json);
	$selected_item = json_decode($selected_items_json);

	if(empty($selected_item)){
		die(json_encode(array("success"=> false, "data" => "Unable to retrieve selected item.")));
	}
        $input = array();
        $input['group_id'] = $group_id;
        foreach($selected_item->data as $key => $value){
			try{
			$input['module_id'] = $value;
                        $data = $this->lithefire->insertRow($db, $table, $input);
			}catch(Exception $e){
				continue;
			}
	}


        die(json_encode($data));

    }

    function deleteModuleGroupAccess(){
        $db = "default";
        $table = "module_group_users";
        $param = "id";

        $id=$this->input->post('id');

		$filter = "$param = '$id'";

        $data = $this->lithefire->deleteRow($db, $table, $filter);


        die(json_encode($data));
    }

    function getModule(){
        $db = "default";
        $table = "module a LEFT JOIN module_category b ON a.category_id = b.id";
        $fields = array("a.id, a.description AS module, b.description AS category, a.link");
        $id = $this->input->post('id');

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
		$filter = "a.id NOT IN (SELECT module_id FROM module_group_access WHERE group_id = '$id') AND a.is_public = 0";
		$group = "";
		$having = "";


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $query = $this->input->post('query');
        
       

        if(empty($sort) && empty($dir)){
            $sort = "a.description";
        }else{
        	$sort = "$sort $dir";
        }

        if(!empty($query)){
            $filter .= " AND (a.description LIKE '%$query%' OR b.description LIKE '%$query%')";
        }

        //$filter = array("is_delete"=>0);


        $records = array();
        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);
        


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

    function deleteModule(){
        $db = "default";
        $table = "module_group_access";
        $param = "id";

        $id=$this->input->post('id');


		$filter = "$param = '$id'";
        $data = $this->lithefire->deleteRow($db, $table, $filter);


        die(json_encode($data));
    }

    function administration()
    {
        $data['header'] = 'Header Section';
        $data['title'] = $this->config->item("sysname").': User Administration';
        $data['footer'] = 'Footer Section';


        $data['userId'] = $this->session->userdata('userId');
        $data['userName'] = $this->session->userdata('userName');

     
        $this->layout->view('userMatrix/user_administration_view', $data);
    
    }

    function getUsers(){
        
        $db = "default";
        $filter = "";
        $group = "";

        $start = $this->input->post("start");
        $limit = $this->input->post("limit");
        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');


        if(empty($sort) && empty($dir)){
            $sort = "user_type ASC, username ASC";

        }else{
            $sort = "$sort $dir";
        }

        $query = $this->input->post('query');

        if(!empty($query))
            $filter = "(username LIKE '%$query%')";

     //   $table = "tbl_user a LEFT JOIN COLLEGE b ON a.STUDCODE = b.STUDCODE LEFT JOIN tbl_user_type c ON a.user_type_code = c.code";
      //  $fields = "a.id, a.username, a.ADVICODE, b.NAME as STUD_NAME, c.description as user_type, c.code";
         $table = "tbl_user a LEFT JOIN tbl_user_type b ON a.user_type_code = b.code";
        $fields = array("a.id", "username", "b.description as user_type", "b.code");

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
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
    }

    function loadUser(){
        
        $db = "default";
        $table = "tbl_user a LEFT JOIN tbl_user_type b ON a.user_type_code = b.code";
        $fields = array("a.id", "username", "b.description as user_type", "b.code");

        $id=$this->input->post('id');

        $filter = "a.id = '$id'";
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

    function getUserTypeCombo(){
        
        $db = "default";
        $filter = "";
        $group = "";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        //$db = "fr";


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir'); 
        $query = $this->input->post('query');


        if(empty($sort) && empty($dir)){
            $sort = "description ASC";
            
        }else{
            $sort = "$sort $dir";
        }

        if(!empty($query))
            $filter = "(code LIKE '%$query%' OR description LIKE '%$query%')";

        $records = array();
        $table = "tbl_user_type";
        $fields = array("code as id", "description as name");


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

    function changePassword(){
        
        $db = "default";
        $table = "tbl_user";

        $id = $this->input->post('id');

        $new_password = $this->ion_auth->hash_password($_POST['new_pass']);



        $input = array("password"=>$new_password);
        $filter = "id = '$id'";

        $data = $this->lithefire->updateRow($db, $table, $input, $filter);
        $data['data'] = "Password Successfully changed";

        die(json_encode($data));

    }

    function updateUserName(){
        
        $db = "default";
        $table = "tbl_user";

        $id = $this->input->post('id');
		$user_type = $this->input->post('USERTYPE');
        
        $old_username = $this->lithefire->getFieldWhere("default", "tbl_user", "id = '$id'","username");
        $username = $this->input->post('username');

        if($this->lithefire->countFilteredRows($db, $table, "id != '$id' AND username = '$username'", "")){
            $data['success'] = false;
            $data['data'] = "Username already exists";
            die(json_encode($data));
        }


        $input = array("username"=>$username, "user_type_code"=>$user_type);
        $filter = "id = '$id'";

        $data = $this->lithefire->updateRow($db, $table, $input, $filter);
        $data = $this->lithefire->updateRow($db, "module_group_users", array("username"=>$username), "username = '$old_username'");
        $data['data'] = "Username successfully updated";

        die(json_encode($data));

    }

	function updatePassword(){
        $db = "default";
        $table = "tbl_user";

        $id = $this->input->post('id');
        $password = $this->ion_auth->hash_password_db($id, $_POST['oldpass']);
		//die($password);
        $new_password = $this->ion_auth->hash_password($_POST['pass']);

        if(!$this->lithefire->countFilteredRows($db, $table, "id = '$id' AND password = '$password'", "")){
        	//die($this->lithefire->currentQuery());
            $data['success'] = false;
            $data['data'] = "Old password does not match";
            die(json_encode($data));
        }

        $input = array("password"=>$new_password);
        $filter = "id = '$id'";

        $data = $this->lithefire->updateRow($db, $table, $input, $filter);
        $data['data'] = "Password Successfully changed";

        die(json_encode($data));
        
    }
	
	function employeePassword(){
		$employees = $this->lithefire->getAllRecords("default", "tbl_user", array("id", "username", "password"), "", "", "", "", "", "");
		
		foreach($employees as $e){
			$password = $this->ion_auth->hash_password($e['username']."321");
			$input = array("password"=>$password);
			$filter = "id = '".$e['id']."'";
			
			$this->lithefire->updateRow("default", "tbl_user", $input, $filter);
			
		}
		die("booyah");
		
	}
	
	function updateGradePassword(){
        $db = "default";
        $table = "GRADEENTRYPASSWORD";

        $id = $this->input->post('id');
        $password = md5($_POST['oldpass']);
		//die($password);
        $new_password = md5($_POST['pass']);

        if(!$this->lithefire->countFilteredRows($db, $table, "ADMINPASSWORD = '$password'", "")){
        	//die($this->lithefire->currentQuery());
            $data['success'] = false;
            $data['data'] = "Old password does not match";
            die(json_encode($data));
        }

        $input = array("ADMINPASSWORD"=>$new_password);
        $filter = "id = 1";

        $data = $this->lithefire->updateRow($db, $table, $input, $filter);
		
		$this->lithefire->insertRow($db, "GRADEPASSWORDLOG", array("USERNAME"=>$this->session->userData("userName")));
        $data['data'] = "Password Successfully changed";

        die(json_encode($data));
        
    }
	
	function getScaffoldingLog(){
        $db = "fr";
        $table = "scaffolding_log";
        $fields = array("id", "table_name", "date_created", "created_by");

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $query = $this->input->post('query');
        $filter = "";
		$group = "";
		$having = "";

        if(empty($sort) && empty($dir)){
            $sort = "id DESC";
        }else{
        	$sort = "$sort $dir";
        }

        if(!empty($query)){
            $filter = "description LIKE '%$query%'";
        }



        $records = array();
        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);



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

    function insertScaffoldingLog(){
        $db = "fr";
        $table = "scaffolding_log";

        $input = array();
        foreach($this->input->post() as $key => $val){
            if(!empty($val)){
                $input[$key] = $val;
            }
        }
        $data = $this->lithefire->insertRow($db, $table, $input);
        die(json_encode($data));

    }
	
	public function generateScaffolding()
	{
		$value=$this->input->post("table_name");
		$columns = $this->lithefire->fetchAllRecords("default", "information_schema.columns", "table_name = '$value'", array("COLUMN_NAME", "TABLE_SCHEMA"));
		$ctr = count($columns);	
		
		if($ctr == 0){
			$data['data'] = "Table does not exist!";
	        $data['success'] = false;
        	die(json_encode($data));
		}
		$fp = fopen(APPPATH."controllers/$value.php", "w");
		fwrite($fp, "<?php\nclass $value extends MY_Controller{\n");
		
		$db = $this->lithefire->getFieldWhere("fr", "database_mapping", "mysql_name = '".$columns[0]['TABLE_SCHEMA']."'", "CI_name");
		$pk = $this->lithefire->getFieldWhere("default", "information_schema.columns", "COLUMN_KEY = 'PRI' AND table_name = '$value'", "COLUMN_NAME");
		
		fwrite($fp, "
		function $value(){
			parent::__construct();
		}\n\n");
		
		
		fwrite($fp, "
		public function index()
		{
			\$data['title'] = \"$value | E-Online\";
			\$data['userId'] = \$this->session->userData('userId');
			\$data['userName'] = \$this->session->userData('userName');
			\$this->layout->view('".$value."/".$value."_view', \$data);
		}\n");
		
		fwrite($fp, "
		function get$value(){
        
	        \$start=\$this->input->post('start');
	        \$limit=\$this->input->post('limit');
	
	        \$sort = \$this->input->post('sort');
	        \$dir = \$this->input->post('dir');
	        \$query = \$this->input->post('query');
	
	        \$records = array();
	        \$table = \"$value\";
	        \$fields = array(");
	    foreach($columns as $row):
			fwrite($fp, "\"".$row['COLUMN_NAME']."\",");
		endforeach;
		
	    fwrite($fp, ");
	        \$db = '$db';
	        \$filter = \"\";
	        \$group = \"\";
			if(empty(\$sort) && empty(\$dir)){
	            \$sort = \"$pk DESC\";
	        }else{
	        	\$sort = \"\$sort \$dir\";
	        }
			
			if(!empty(\$query)){\n \t\t\t\t\"(");
	            //\$filter = \"(QUCLIDNO LIKE '%\$query%' OR QUCLCODE LIKE '%\$query%' OR description LIKE '%\$query%')\";""
	            $i = 0;
	            foreach($columns as $row):
					fwrite($fp, $row['COLUMN_NAME']." LIKE '%\$query%'");
					if(++$i != $ctr){
						fwrite($fp, " OR ");
					}
				endforeach;
	            
	    fwrite($fp,")\";
	    	}
			 
			
			
			\$records = \$this->lithefire->getAllRecords(\$db, \$table, \$fields, \$start, \$limit, \$sort, \$filter, \$group);
	
	        \$data['totalCount'] = \$this->lithefire->countFilteredRows(\$db, \$table, \$filter, \$group);
	
	        \$temp = array();
	        \$total = 0;
	        if(\$records){
	        foreach(\$records as \$row):
	
	            \$temp[] = \$row;
	            \$total++;
	
	        endforeach;
	        }
	        \$data['data'] = \$temp;
	        \$data['success'] = true;
	        die(json_encode(\$data));
	    }\n
		");
		
		fwrite($fp, "function add$value(){
	        \$db = '$db';
	        \$table = \"$value\";
			\$input = \$this->input->post();
			
			/* uncomment for checking duplicates (change \$fieldname)
			\$fieldname = 'description';
	        if(\$this->lithefire->countFilteredRows(\$db, \$table, \"\$fieldname = '\".\$this->input->post(\"\$fieldname\").\"'\", \"\")){
	            \$data['success'] = false;
	            \$data['data'] = \"Record already exists\";
	            die(json_encode(\$data));
	        }*/
	        
	        //uncomment for FRs
			//\$input['IDNO'] = \$this->lithefire->getNextCharId(\$db, \$table, 'IDNO', 5);
			
	        \$data = \$this->lithefire->insertRow(\$db, \$table, \$input);
	
	        die(json_encode(\$data));
    	}\n");
		
		fwrite($fp, "
		function load$value(){
	        \$db = \"$db\";
	        
	
	        \$id=\$this->input->post('id');
	        \$table = \"$value\";
			\$param = \"$pk\";
	
	        \$filter = \"\$param = '\$id'\";
	        \$fields = array(");
	    foreach($columns as $row):
			fwrite($fp, "\"".$row['COLUMN_NAME']."\",");
		endforeach;
		
	    fwrite($fp, ");
	        \$records = array();
	        \$records = \$this->lithefire->getRecordWhere(\$db, \$table, \$filter, \$fields);
	
	        \$temp = array();
	
	        foreach(\$records as \$row):
	            \$data[\"data\"] = \$row;
	        endforeach;
	        \$data['success'] = true;
	
	        die(json_encode(\$data));
	    }\n");
		
		fwrite($fp, "
		function update$value(){
	        \$db = '$db';
	
	        \$table = \"$value\";
	        
			\$param = \"$pk\";
	        \$id=\$this->input->post('id');
	        \$filter = \"\$param = '\$id'\";
	
	        \$input = array();
	        foreach(\$this->input->post() as \$key => \$val){
	            if(\$key == 'id')
	                continue;
	            if(!empty(\$val)){
	                \$input[\$key] = \$val;
	            }
	        }
			//check for duplicates (change \$fieldname)
			\$fieldname = 'description';
	        if(\$this->lithefire->countFilteredRows(\$db, \$table, \"\$fieldname = '\".\$this->input->post(\"\$fieldname\").\"' AND $pk != '\$id'\", \"\")){
	            \$data['success'] = false;
	            \$data['data'] = \"Record already exists\";
	            die(json_encode(\$data));
	        }
	
	
	        \$data = \$this->lithefire->updateRow(\$db, \$table, \$input, \$filter);
	
	
	        die(json_encode(\$data));
	    }\n");
		
		fwrite($fp, "
		function delete$value(){
	        \$table = \"$value\";
	        \$param = \"$pk\";
	       
			\$db = \"$db\";
	        \$id=\$this->input->post('id');
			\$filter = \"\$param = '\$id'\";
	
	        \$data = \$this->lithefire->deleteRow(\$db, \$table, \$filter);
	
	        die(json_encode(\$data));
	    }\n");

		fwrite($fp, "\n}");
		fclose($fp);
		if(!is_dir(APPPATH."views/".$value."/")){
			mkdir(APPPATH."views/".$value."/");
		}
		$file = fopen(APPPATH."views/".$value."/".$value."_view.php", "w");
		
		fwrite($file, "
		<div id=\"mainBody\"></div>
		<script type=\"text/javascript\">
		 Ext.namespace(\"$value\");
		 $value.app = function()
		 {
		 	return{
	 		init: function()
	 		{
	 			ExtCommon.util.init();
	 			ExtCommon.util.quickTips();
	 			this.getGrid();
	 		},
	 		getGrid: function()
	 		{
	 			ExtCommon.util.renderSearchField('searchby');
	
	 			var Objstore = new Ext.data.Store({
	 						proxy: new Ext.data.HttpProxy({
	 							url: \"<?php echo site_url('$value/get$value') ?>\",
	 							method: \"POST\"
	 							}),
	 						reader: new Ext.data.JsonReader({
	 								root: \"data\",
	 								id: \"id\",
	 								totalProperty: \"totalCount\",
	 								fields: [
		");
		
		   		$i = 0;
	            foreach($columns as $row):
					fwrite($file, "{ name: '".$row['COLUMN_NAME']."'}");
					if(++$i != $ctr){
						fwrite($file, ",");
					}
				endforeach;
		fwrite($file, "
		]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});
		");
		
		fwrite($file, "
		var colModel = new Ext.grid.ColumnModel([
		");
		
		$i = 0;
	            foreach($columns as $row):
					fwrite($file, "{header: \"".$row['COLUMN_NAME']."\", width: 100, sortable: true, dataIndex: '".$row['COLUMN_NAME']."'}");
					if(++$i != $ctr){
						fwrite($file, ",");
					}
				endforeach;
		fwrite($file, "
		]);

 			var grid = new Ext.grid.GridPanel({
 				id: '".$value."grid',
 				height: 300,
 				width: '100%',
 				border: true,
 				ds: Objstore,
 				cm:  colModel,
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,
 	        	bbar:
 	        		new Ext.PagingToolbar({
 		        		autoShow: true,
 				        pageSize: 25,
 				        store: Objstore,
 				        displayInfo: true,
 				        displayMsg: 'Displaying Results {0} - {1} of {2}',
 				        emptyMsg: \"No Data Found.\"
 				    }),
 				tbar: [new Ext.form.ComboBox({
                    fieldLabel: 'Search',
                    hiddenName:'searchby-form',
                    id: 'searchby',
                    typeAhead: true,
                    triggerAction: 'all',
                    emptyText:'Search By...',
                    selectOnFocus:true,
                    store: new Ext.data.SimpleStore({
				         id:0
				        ,fields:
				            [
				             'myId',   //numeric value is the key
				             'myText' //the text value is the value

				            ]


				         , data: [['id', 'ID'], ['sd', 'Short Description'], ['ld', 'Long Description']]

			        }),
				    valueField:'myId',
				    displayField:'myText',
				    mode:'local',
                    width:100,
                    hidden: true

                }), {
					xtype:'tbtext',
					text:'Search:'
				},'   ', new Ext.app.SearchField({ store: Objstore, width:250}),
 					    {
 					     	xtype: 'tbfill'
 					 	},{
 					     	xtype: 'tbbutton',
 					     	text: 'ADD',
							icon: '/images/icons/application_add.png',
 							cls:'x-btn-text-icon',

 					     	handler: ".$value.".app.Add

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'EDIT',
							icon: '/images/icons/application_edit.png',
 							cls:'x-btn-text-icon',

 					     	handler: ".$value.".app.Edit

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'DELETE',
							icon: '/images/icons/application_delete.png',
 							cls:'x-btn-text-icon',

 					     	handler: ".$value.".app.Delete

 					 	}
 	    			 ]
 	    	});

 			".$value.".app.Grid = grid;
 			".$value.".app.Grid.getStore().load({params:{start: 0, limit: 25}});

 			var _window = new Ext.Panel({
 		        title: 'Question Classification',
 		        width: '100%',
 		        height:'auto',
 		        renderTo: 'mainBody',
 		        draggable: false,
 		        layout: 'fit',
 		        items: [".$value.".app.Grid],
 		        resizable: false
 	        });

 	        _window.render();


 		},
		");
		
		fwrite($file, "
		setForm: function(){

 		    var form = new Ext.form.FormPanel({
 		        labelWidth: 150,
 		        url: \"<?php echo site_url('".$value."/add".$value."') ?>\",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        frame: true,
 		        items: [ {
 					xtype:'fieldset',
 					title:'Fields w/ Asterisks are required.',
 					width:'auto',
 					height:'auto',
 					items:[");
		
		$i = 0;
	            foreach($columns as $row):
					fwrite($file, "
				{
                    xtype:'textfield',
 		            fieldLabel: '".$row['COLUMN_NAME']."*',
 		            name: '".$row['COLUMN_NAME']."',
 		            allowBlank:false,
 		            anchor:'95%',  // anchor width by percentage
 		            id: '".$row['COLUMN_NAME']."'
 		        }");
					if(++$i != $ctr){
						fwrite($file, ",");
					}
				endforeach;
		fwrite($file, "    
 		        

 		        		]
 					}
 					]
 		    });

 		    ".$value.".app.Form = form;
 		},
		");
		$form_height = 140+($ctr*25);
		fwrite($file, "
 		Add: function(){

 			".$value.".app.setForm();

 		  	var _window;

 		    _window = new Ext.Window({
 		        title: 'New $value',
 		        width: 510,
 		        height: $form_height,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: ".$value.".app.Form,
 		        buttons: [{
 		         	text: 'Save',
                    icon: '/images/icons/disk.png',  
                    cls:'x-btn-text-icon',
 	                handler: function () {
 			            if(ExtCommon.util.validateFormFields(".$value.".app.Form)){//check if all forms are filled up
 		                ".$value.".app.Form.getForm().submit({
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
                  		    	 Ext.Msg.show({
  								     title: 'Status',
 								     msg: action.result.data,
  								     buttons: Ext.Msg.OK,
  								     icon: 'icon'
  								 });
 				                ExtCommon.util.refreshGrid(".$value.".app.Grid.getId());
 				                _window.destroy();
 			                },
 			                failure: function(f,a){
 								Ext.Msg.show({
 									title: 'Error Alert',
 									msg: a.result.data,
 									icon: Ext.Msg.ERROR,
 									buttons: Ext.Msg.OK
 								});
 			                },
 			                waitMsg: 'Saving Data...'
 		                });
 	                }else return;
 	                }
 	            },{
 		            text: 'Cancel',
                    icon: '/images/icons/cancel.png', 
                    cls:'x-btn-text-icon',
 		            handler: function(){
 			            _window.destroy();
 		            }
 		        }]
 		    });
 		  	_window.show();
 		},
		");
		
		fwrite($file, "
		Edit: function(){
 			if(ExtCommon.util.validateSelectionGrid(".$value.".app.Grid.getId())){//check if user has selected an item in the grid
 			var sm = ".$value.".app.Grid.getSelectionModel();
 			var id = sm.getSelected().data.".$pk.";

 			".$value.".app.setForm();
 		    _window = new Ext.Window({
 		        title: 'Update Classification',
 		        width: 510,
 		        height:".$form_height.",
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: ".$value.".app.Form,
 		        buttons: [{
 		         	text: 'Save',
                    icon: '/images/icons/disk.png',  
                    cls:'x-btn-text-icon',
 		            handler: function () {
 			            if(ExtCommon.util.validateFormFields(".$value.".app.Form)){//check if all forms are filled up
 		                ".$value.".app.Form.getForm().submit({
 			                url: \"<?php echo site_url('".$value."/update".$value."') ?>\",
 			                params: {id: id},
 			                method: 'POST',
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
 				                ExtCommon.util.refreshGrid(".$value.".app.Grid.getId());
 				                _window.destroy();
 			                },
 			                failure: function(f,a){
 								Ext.Msg.show({
 									title: 'Error Alert',
 									msg: a.result.data,
 									icon: Ext.Msg.ERROR,
 									buttons: Ext.Msg.OK
 								});
 			                },
 			                waitMsg: 'Updating Data...'
 		                });
 	                }else return;
 		            }
 		        },{
 		            text: 'Cancel',
                            icon: '/images/icons/cancel.png', cls:'x-btn-text-icon',

 		            handler: function(){
 			            _window.destroy();
 		            }
 		        }]
 		    });

 		  	".$value.".app.Form.getForm().load({
 				url: \"<?php echo site_url('".$value."/load".$value."') ?>\",
 				method: 'POST',
 				params: {id: id},
 				timeout: 300000,
 				waitMsg:'Loading...',
 				success: function(form, action){
                                    _window.show();
 				},
 				failure: function(form, action) {
         					Ext.Msg.show({
 									title: 'Error Alert',
 									msg: \"A connection to the server could not be established\",
 									icon: Ext.Msg.ERROR,
 									buttons: Ext.Msg.OK,
 									fn: function(){ _window.destroy(); }
 								});
     			}
 			});
 			}else return;
 		},
		");
		
		fwrite($file, "
		Delete: function(){


			if(ExtCommon.util.validateSelectionGrid(".$value.".app.Grid.getId())){//check if user has selected an item in the grid
			var sm = ".$value.".app.Grid.getSelectionModel();
			var id = sm.getSelected().data.".$pk.";
			Ext.Msg.show({
   			title:'Delete Selected',
  			msg: 'Are you sure you want to delete this record?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){
   			Ext.Ajax.request({
                            url: \"<?php echo site_url('".$value."/delete".$value."') ?>\",
							params:{ id: id},
							method: \"POST\",
							timeout:300000000,
			                success: function(responseObj){
                		    	var response = Ext.decode(responseObj.responseText);
						if(response.success == true)
						{
							".$value.".app.Grid.getStore().load({params:{start:0, limit: 25}});
							return;

						}
						else if(response.success == false)
						{
							Ext.Msg.show({
								title: 'Error!',
								msg: \"There was an error encountered in deleting the record. Please try again\",
								icon: Ext.Msg.ERROR,
								buttons: Ext.Msg.OK
							});

							return;
						}
							},
			                failure: function(f,a){
								Ext.Msg.show({
									title: 'Error Alert',
									msg: \"There was an error encountered in deleting the record. Please try again\",
									icon: Ext.Msg.ERROR,
									buttons: Ext.Msg.OK
								});
			                },
			                waitMsg: 'Deleting Data...'
						});
   			}
   			},

   			icon: Ext.MessageBox.QUESTION
			});

	                }else return;


		}
		");
		
		fwrite($file, "
		}
		}();

	 Ext.onReady(".$value.".app.init, ".$value.".app);
	
	</script>
		");
		fclose($file);
		
		$db = "fr";
        $table = "scaffolding_log";
        $table_name = $this->input->post("table_name");
		$input = array("table_name"=>$table_name, "date_created"=>date("Y-m-d H:i:s"), "created_by"=>$this->session->userdata("userName"));
		
		$category = $this->lithefire->insertRow("default", "module_category", array("description"=>$value, "icon"=>"/images/icons/application.png", "is_public"=>1));
		$module = $this->lithefire->insertRow("default", "module", array("description"=>$value, "link"=>$value, "category_id"=>$category['id'], "is_public"=>1));
		
		$data = $this->lithefire->insertRow($db, $table, $input);
		
		
        die(json_encode($data));
	}
}

?>
