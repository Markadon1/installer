<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prices extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'prices';
    protected $fillable = array(
        'input_id',
        'price'
    );
    public $timestamps = false;
}
