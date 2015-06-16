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

    public function getIndex(){

        $query = Department_m::query();
        $input = $this->input->get();

        if(isset($input['start']) && isset($input['limit']))
        {
            $query->getQuery()->forPage($input['start'], $input['limit']);
        }

        if(isset($input['query']))
        {
            $query->where("dept_type", "like", "%".$input['query']."%");
        }

        if(isset($input['sort']))
        {
            $query->getQuery()->orderBy($input['sort'], $input['dir']);
        }

        $data['data'] = $query->get();

        $data['totalCount'] = $query->getQuery()->count();

        die(json_encode($data));
    }

    public function show()
    {
        $id = $this->input->get('id');
        $department = Department_m::findOrFail($id);
        die(json_encode(array("data"=>$department->toArray(), "success"=>true)));

    }

    public function store()
    {
        $department = new Department_m;

        if($department->validate($this->input->post()))
        {
            $department->fill($this->input->post());
            $department->save();
            die(json_encode(["data" => $department->addMsg(), "id" => $department->id, "success" => true]));
        }else {
            $errors = $department->listErrors();
            die(json_encode(["data"=>$errors, "success"=>false]));
        }
    }

    public function update()
    {
        $input = $this->input->post();

        $department = Department_m::findOrFail($input['dept_idno']);
        $department->setRules(array("dept_type"=>"required|unique:filedept,dept_type,".$input['dept_idno'].",dept_idno",));
        if($department->validate($this->input->post()))
        {
            $department->update($input);
            die(json_encode(["data" => $department->updatedMsg(), "id" => $department->id, "success" => true]));
        }else {
            $errors = $department->listErrors();
            die(json_encode(["data"=>$errors, "success"=>false]));
        }
    }

    public function destroy()
    {
        $ids = json_decode($this->input->post('id'), true);

        $department = new Department_m;
        $department->whereIn("dept_idno", $ids["data"])->delete();
        die(json_encode(["success"=>true, "data"=>$department->deletedMsg()]));

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