<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use filereference\employeecategory_m;

class EmployeeCategory extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $data['title'] = "Employee Category | HRIS";
        $data['userId'] = $this->session->userData('userId');
        $data['userName'] = $this->session->userData('userName');
        $this->layout->view('filereference/employee_category_view', $data);
    }

    public function getIndex(){

        $employee_category = EmployeeCategory_m::query();
        $input = $this->input->get();

        if(isset($input['start']) && isset($input['limit']))
        {
            $employee_category->getQuery()->forPage($input['start'], $input['limit']);
        }

        if(isset($input['query']))
        {
            $employee_category->where("description", "like", "%".$input['query']."%");
        }

        if(isset($input['sort']))
        {
            $employee_category->getQuery()->orderBy($input['sort'], $input['dir']);
        }

        $data['data'] = $employee_category->get();

        $data['totalCount'] = $employee_category->getQuery()->count();

        die(json_encode($data));
    }

    public function show()
    {
        $id = $this->input->get('id');

        die(json_encode(array("data"=>EmployeeCategory_m::findOrFail($id)->toArray(), "success"=>true)));

    }

    public function store()
    {
        $employee_category = new EmployeeCategory_m;
        if($employee_category->validate($this->input->post()))
        {
            $employee_category->fill($this->input->post());
            $employee_category->save();
            die(json_encode(["data" => $employee_category->add_message, "id" => $employee_category->id, "success" => true]));
        }else {
            $errors = $employee_category->listErrors();
            die(json_encode(["data"=>$errors, "success"=>false]));
        }
    }

    public function update()
    {
        $id = $this->input->post('id');
        $employee_category = EmployeeCategory_m::findOrFail($id);
        if($employee_category->validate($this->input->post(), $id))
        {
            $employee_category->update($this->input->post());
            die(json_encode(["data" => $employee_category->updatedMsg(), "id" => $employee_category->id, "success" => true]));
        }else {
            $errors = $employee_category->listErrors();
            die(json_encode(["data"=>$errors, "success"=>false]));
        }
    }

    public function destroy()
    {
        $ids = json_decode($this->input->post('id'), true);
        $employee_category = new EmployeeCategory_m;
        $employee_category->whereIn("id", $ids["data"])->delete();
        die(json_encode(["success"=>true, "data"=>$employee_category->deletedMsg()]));

    }
}