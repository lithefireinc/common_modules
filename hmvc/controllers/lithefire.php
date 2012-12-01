<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lithefire extends MY_Controller {
	
	function Lithefire(){
		parent::__construct();
		
	}
	
	function getSemesterCombo(){
        $db = "fr";

        $start=$this->input->post('start');
        $limit=$this->input->post('limit');
        //$db = "fr";


        $sort = $this->input->post('sort');
        $dir = $this->input->post('dir');
        $query = $this->input->post('query');
        $queryby = "";
		
		$filter = "";
		$group = "";
		$having = "";

        if(empty($sort) && empty($dir)){
            $sort = "SEMECODE";
            $dir = "DESC";
        }

        $records = array();
        $table = "FILESEME";
        $fields = array("SEMEIDNO as id", "SEMESTER as name");

        $filter = "ACTIVATED = 1 AND SEMEIDNO <= (SELECT SEMEIDNO FROM FILESEME WHERE IS_ACTIVE = 1)";

        $records = $this->lithefire->getAllRecords($db, $table, $fields, $start, $limit, $sort, $filter, $group, $having);
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
        $data['totalCount'] = $this->lithefire->countFilteredRows($db, $table, $filter, $group);
        die(json_encode($data));
    }
}
?>