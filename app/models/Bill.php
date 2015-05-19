<?php 
class Bill extends Eloquent {

  
    protected $table = 'Bill';

    

    //Define relationship between Bill - BillItems
    public function value() {
        return $this->hasMany('BillItem', 'bill_id');
    }

    public function user(){
        return $this->belongsTo('User','user_id');
    }
}