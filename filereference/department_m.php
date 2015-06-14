<?php namespace filereference;

use \Lithefire_m;

class Department_m extends Lithefire_m
{
    protected $title = "Department";
    protected $rules;

    public function __construct(){
        parent::__construct();
        $this->rules = array(
            "dept_type"=>"required|unique:filedept,dept_type"
        );
    }

    protected $connection = 'fr';
    protected $table = 'filedept';
    public $timestamps = false;
    protected $guarded = array('dept_idno');
    protected $primaryKey = 'dept_idno';

    public function subdepartment(){
        return $this->hasMany('filereference\subdepartment_m', 'department_id', 'dept_idno');
    }
}