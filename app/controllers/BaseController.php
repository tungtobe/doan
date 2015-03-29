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

}
