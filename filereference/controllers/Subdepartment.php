<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subdepartment extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('filereference/Subdepartment_m');

    }

    public function index()
    {
        $data['title'] = "Sub-Department | HRIS";
        $data['userId'] = $this->session->userData('userId');
        $data['userName'] = $this->session->userData('userName');
        $this->layout->view('filereference/subdepartment_view', $data);
    }

    public function getIndex(){

        $subdepartment = Subdepartment_m::query();
        $input = $this->input->get();

        if(isset($input['start']) && isset($input['limit']))
        {
            $subdepartment->getQuery()->forPage($input['start'], $input['limit']);
        }

        if(isset($input['query']))
        {
            $subdepartment->where("description", "like", "%".$input['query']."%");
        }

        if(isset($input['sort']))
        {
            $subdepartment->getQuery()->orderBy($input['sort'], $input['dir']);
        }

        $data['data'] = $subdepartment->get();

        $data['totalCount'] = $subdepartment->getQuery()->count();

        die(json_encode($data));
    }

    public function show()
    {
        $id = $this->input->get('id');

        die(json_encode(array("data"=>Subdepartment_m::findOrFail($id)->toArray(), "success"=>true)));

    }

    public function store()
    {
        $subdepartment = new Subdepartment_m;
        if($subdepartment->validate($this->input->post()))
        {
            $subdepartment->fill($this->input->post());
            $subdepartment->save();
            die(json_encode(["data" => $subdepartment->addMsg(), "id" => $subdepartment->id, "success" => true]));
        }else {
            $errors = $subdepartment->listErrors();
            die(json_encode(["data"=>$errors, "success"=>false]));
        }
    }

    public function update()
    {
        $id = $this->input->post('id');
        $subdepartment = Subdepartment_m::findOrFail($id);
        if($subdepartment->validate($this->input->post(), $id))
        {
            $subdepartment->update($this->input->post());
            die(json_encode(["data" => $subdepartment->updatedMsg(), "id" => $subdepartment->id, "success" => true]));
        }else {
            $errors = $subdepartment->listErrors();
            die(json_encode(["data"=>$errors, "success"=>false]));
        }
    }

    public function destroy()
    {
        $ids = json_decode($this->input->post('id'), true);
        $subdepartment = new Subdepartment_m;
        $subdepartment->whereIn("id", $ids["data"])->delete();
        die(json_encode(["success"=>true, "data"=>$subdepartment->deletedMsg()]));

    }
}