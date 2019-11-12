<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubInput extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'subcat-input';
    protected $fillable = array(
        'name'
    );
    public $timestamps = false;
}
