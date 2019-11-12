<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'category';
    protected $fillable = array(
        'name'
    );
    public $timestamps = false;


    public function subcategory() {
        return $this->belongsToMany('App\SubCategory','category_subcategory','category_id','subcategory_id');
    }
}


