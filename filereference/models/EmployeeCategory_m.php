<?php

class EmployeeCategory_m extends Lithefire_m
{
    protected $title = "Employee Category";
    protected $rules = array(
        "description"=>"required|unique:fileemca,description,:id"
    );

    protected $connection = 'fr';
    protected $table = 'fileemca';
    public $timestamps = false;
    protected $guarded = array('id');


}