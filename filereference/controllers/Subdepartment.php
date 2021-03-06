<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use filereference\subdepartment_m;
use Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Validation\Factory as Validator;
use \Symfony\Component\Translation\Translator;

class Subdepartment extends MY_Controller
{
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
        $subdepartment->join("filedept", "filesubdept.department_id", "=", "filedept.dept_idno");
        $subdepartment->select(["filesubdept.*", "filedept.dept_type"]);
        if(isset($input['start']) && isset($input['limit']))
        {
            $subdepartment->getQuery()->forPage($input['start'], $input['limit']);
        }

        if(isset($input['query']))
        {
            $subdepartment->where("description", "like", "%".$input['query']."%")
            ->orWhere("dept_type", "like", "%".$input['query']."%");
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
        $subdepartment = Subdepartment_m::findOrFail($id);

        die(json_encode(array("data"=>$subdepartment->toArray()+["department_name"=>$subdepartment->department->dept_type], "success"=>true)));

    }

    public function store()
    {
        $subdepartment = new Subdepartment_m;
        $subdepartment->setRules(array("description"=>"required|unique:filesubdept,description,NULL,id,department_id,".$this->input->post('department_id'),));
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
        $department = $this->input->post('department_id');

        $subdepartment = Subdepartment_m::findOrFail($id);
        $subdepartment->setRules(array("description"=>"required|unique:filesubdept,description,$id,id,department_id,$department",));
        if($subdepartment->validate($this->input->post()))
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

    public function lists()
    {
        $query = subdepartment_m::query();
        $input = $this->input->get();

        $query->where("department_id", "=", $input['department_id']);

        if(isset($input['start']) && isset($input['limit']))
        {
            $query->getQuery()->forPage($input['start'], $input['limit']);
        }

        if(isset($input['query']) && !empty($input['query']))
        {
            $query->where("description", "like", "%".$input['query']."%");
        }

        if(isset($input['sort']))
        {
            $query->getQuery()->orderBy($input['sort'], $input['dir']);
        }
        $query->select(["id", "description as name"]);
        $data['data'] = $query->get();

        $data['totalCount'] = $query->getQuery()->count();

        die(json_encode($data));
    }

    public function validate($data, $id = null)
    {
        $ci = &get_instance();
        $factory = new Validator(new Translator('en'));
        $v = $factory->make($data, $this->getValidationRules($id), $this->messages);
        $manager = $ci->db->capsule->getDatabaseManager();
        $manager->setDefaultConnection('fr');
        $v->setPresenceVerifier(new \Illuminate\Validation\DatabasePresenceVerifier($manager));
        if($v->fails())
        {
            $this->errors = $v->errors();
            return false;
        }
        return true;
    }
}