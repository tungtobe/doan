<?php 
class BillItem extends Eloquent {

  
    protected $table = 'BillItem';

    

    //Define invert of relationship between Bill - BillItems
    public function value() {
        return $this->belongsTo('Bill', 'bill_id');
    }

	public function item(){
    	return $this->belongsTo('Item','item_id');
    }


}