<?php namespace filereference;

use \Lithefire_m;

class Subdepartment_m extends Lithefire_m
{
    protected $title = "Sub-Department";
    protected $rules = array(
        "description"=>"required|unique:FILESUBDEPT,description,:id"
    );

    protected $connection = 'fr';
    protected $table = 'FILESUBDEPT';
    protected $guarded = array('id');

    public function department(){
        return $this->belongsTo('filereference\department_m', 'department_id', 'dept_idno');
    }
}