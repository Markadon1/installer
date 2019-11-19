<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempInputs extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'temp-inputs';
    protected $fillable = array(
        'name',
        'value'
    );
    public $timestamps = false;
}
