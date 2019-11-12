<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'subcategory';
    protected $fillable = array(
        'name'
    );
    public $timestamps = false;

    public function input() {
        return $this->belongsToMany('App\SubInput','subcategory_input','subcategory_id','input_id');
    }
}
