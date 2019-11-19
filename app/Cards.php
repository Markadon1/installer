<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'cards';
    protected $fillable = array(
        'name',
        'logo'
    );
    public $timestamps = false;



    public function category() {
        return $this->belongsToMany('App\Category','category_card','card_id','category_id');
    }
    public function temp_values() {
        return $this->belongsToMany('App\TempToCard','temp-card-val','card_id','value_id');
    }
    public function prices() {
        return $this->belongsToMany('App\Prices','card_price','card_id','price_id');
    }
}
