<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempToCard extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'card_temp-val';
    protected $fillable = array(
        'template_id',
        'template_name',
        'value'
    );
    public $timestamps = false;
}
