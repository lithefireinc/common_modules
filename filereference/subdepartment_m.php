<?php namespace filereference;

use \Lithefire_m;

class Subdepartment_m extends Lithefire_m
{
    protected $title = "Sub-Department";
    protected $rules;

    public function __construct(){
        parent::__construct();
        $this->rules = array(
            "description"=>"required|unique:filesubdept,description,NULL,id,department_id,1",
        );
    }
    protected $connection = 'fr';
    protected $table = 'filesubdept';
    protected $guarded = array('id');

    public function department(){
        return $this->belongsTo('filereference\department_m', 'department_id', 'dept_idno');
    }
}