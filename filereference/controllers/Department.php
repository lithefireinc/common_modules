<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use filereference\department_m;

class Department extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $data['title'] = "Department | HRIS";
        $data['userId'] = $this->session->userData('userId');
        $data['userName'] = $this->session->userData('userName');
        $this->layout->view('filereference/department_view', $data);
    }

    public function lists()
    {
        $department = Department_m::query();
        $input = $this->input->get();

        if(isset($input['start']) && isset($input['limit']))
        {
            $department->getQuery()->forPage($input['start'], $input['limit']);
        }

        if(isset($input['query']) && !empty($input['query']))
        {
            $department->where("dept_type", "like", "%".$input['query']."%");
        }

        if(isset($input['sort']))
        {
            $department->getQuery()->orderBy($input['sort'], $input['dir']);
        }

        $data['data'] = $department->get();

        $data['totalCount'] = $department->getQuery()->count();

        die(json_encode($data));
    }
}