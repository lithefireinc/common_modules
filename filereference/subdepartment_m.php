<?php namespace filereference;

use \Lithefire_m;

class Subdepartment_m extends Lithefire_m
{
    protected $title = "Sub-Department";
    protected $rules = array(
        "description"=>"required|unique:filesubdept,description,:id"
    );

    protected $connection = 'fr';
    protected $table = 'filesubdept';
    protected $guarded = array('id');

    public function department(){
        return $this->belongsTo('filereference\department_m', 'department_id', 'dept_idno');
    }
}