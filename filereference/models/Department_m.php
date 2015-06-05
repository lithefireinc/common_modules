<?php

class Department_m extends Lithefire_m
{
    protected $title = "Department";
    protected $rules = array(
        "dept_type"=>"required|unique:filedept,description,:id"
    );

    protected $connection = 'fr';
    protected $table = 'filedept';
    public $timestamps = false;
    protected $guarded = array('id');

}