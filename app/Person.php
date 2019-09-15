<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model {

    public $table = "person";

    protected $fillable = ["fname", "lname", "birth_year", "parent_id"];

    protected $dates = [];

    public static $rules = [
        "fname" => "required",
        "birth_year" => "required|integer",
    ];

}
