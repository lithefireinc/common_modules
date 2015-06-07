<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use filereference\department_m;

class Department extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function lists()
    {
        $department = Department_m::query();
        $input = $this->input->get();

        if(isset($input['start']) && isset($input['limit']))
        {
            $department->getQuery()->forPage($input['start'], $input['limit']);
        }

        if(isset($input['query']))
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