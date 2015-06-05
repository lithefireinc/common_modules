<?php

class Subdepartment_m extends Lithefire_m
{
    protected $title = "Sub-Department";
    protected $rules = array(
        "description"=>"required|unique:FILESUBDEPT,description,:id"
    );

    protected $connection = 'fr';
    protected $table = 'FILESUBDEPT';
    public $timestamps = false;
    protected $guarded = array('id');


}