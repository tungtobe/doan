<?php

class BaseController extends Controller {
	protected $layout = 'layouts.public';
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	// get items attribute 
	// Input: array of items object
	// Output: array of items attributes
	protected function getItemAttributes($items){
		$items_attr  = array();
		foreach ($items as $item) {
			$values = Value::where('item_id', $item->id)->get();
			foreach ($values as $value) {
				$attr_name = Attribute::find($value->attr_id)->attr_name;
				$items_attr[$item->id][$attr_name] = $value->value;
			}
		}
		return $items_attr;
	}
	
	// get item attribute 
	// Input: item object
	// Output: array of one item attributes
    protected function getOneItemAttributes($item){
		$items_attr  = array();
		
		$values = Value::where('item_id', $item->id)->get();
		foreach ($values as $value) {
			$attr = Attribute::find($value->attr_id);
			$attr_name = $attr->attr_name;
			$item_attr[$attr_name] = $value->value;
			
		}
		return $item_attr;
	}

	public function getAttributeType(){
		$item_attr_type = array();
		$attrs = Attribute::all();
		foreach ($attrs as $attr) {
			$attr_name = $attr->attr_name;
			$attr_type = $attr->attr_type;
			$item_attr_type[$attr_name] = $attr_type;
		}
		return $item_attr_type;
		
	}

}
