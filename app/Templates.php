<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Templates extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'templates';
    protected $fillable = array(
        'name',
        'type'
    );
    public $timestamps = false;


    public function inputs() {
        return $this->belongsToMany('App\TempInputs','template_input','template_id','input_id');
    }
}
