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
		if ($values->isEmpty()) {
			return null;
		}else{
			foreach ($values as $value) {
				$attr_id = $value->attr_id;
				$attr = Attribute::find($attr_id);
				$attr_name = $attr->attr_name;
				$item_attr[$attr_id] = $value->value;
			}
			return $item_attr;
		}
		
	}

	public function getAttributeOption(){
		$item_attr_option = array();
		$attrs = Attribute::all();
		foreach ($attrs as $attr) {
			$attr_name = $attr->attr_name;
			$attr_id = $attr->id;
			$attr_option_array = Value::where('attr_id',$attr_id)->distinct()->get(array('value'))->toArray();
			$item_attr_option[$attr_id] = $attr_option_array;
		}

		return $item_attr_option;

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

	public function getItemsVote($items){
		$item_vote_array = array();
		foreach ($items as $item) {
			$item_vote_array[$item->id]['good'] = Vote::where(array(
																'item_id' => $item->id,
																'type' => 1
																))->count();
			$item_vote_array[$item->id]['bad'] = Vote::where(array(
																'item_id' => $item->id,
																'type' => 2
																))->count();
		}
		return $item_vote_array;
	}

	public function makeExampleVector($item_id, $critique_array){
		$exampleVector = array();
		if (is_null($critique_array)) {
			$attr_values = Value::where('item_id',$item_id)->get()->toArray();
			foreach ($attr_values as $attr_value) {
				$exampleVector[$attr_value['attr_id']] = $attr_value['value'];
			}
		}else{
			foreach ($critique_array as $key => $value) {
				if ($value == "") {
					$attr_value = Value::where(array('item_id'=>$item_id , 'attr_id'=>$key))->first();
					$exampleVector[$key] = $attr_value->value;
				}else{
					$exampleVector[$key] = $value;
				}
			}
		}
		return $exampleVector;
	}

	public function getRecommendList($example_vector, $weight_vector){
		$recommend_list = array();
		$items = Item::all();
		
		foreach ($items as $item) {
			// so sánh các thuộc tính mỗi sản phẩm vs sản phẩm mẫu
			$compared_vector = $this->compareSimilar($item, $example_vector);


			// tính điểm tương đồng của sản phẩm
			$item_similar_point = 0;
			foreach ($compared_vector as $key => $value) {
				if(is_null($weight_vector )){// khi không có vector trọng số
					$item_similar_point = $item_similar_point + $value;
				}else{ // khi có vector trọng số
					$item_similar_point = $item_similar_point + ($value * $weight_vector[$key]) ;
				}
			}
			
			$recommend_list[$item->id] = $item_similar_point;
			
		}
		return $recommend_list;
	}

	// Tính độ tương tự của 1 sản phẩm với sản phẩm mẫu
	// Đầu vào: Sản phẩm - Sản phẩm mẫu
	// Đẩu ra : Vector có key là attr_id, value là độ tương tự của attribute đó tính theo thang 1
	public function compareSimilar($item, $example_vector){
		$compared_vector = array();
		foreach ($example_vector as $key => $value) {
			$item_attr = Value::where(array('attr_id'=> $key, 'item_id' => $item->id))->first();
			// var_dump($item_attr);die;
			if ($item_attr) {
				$point = $this->compareAttribute($key, $value, $item_attr->value);
			}else{
				$point = 0;
			}
			$compared_vector[$key] = $point;
		}
		// var_dump($compared_vector);die;
		return $compared_vector;
	}

	public function compareAttribute($attr_id, $example_attr, $item_attr){
		$attr = Attribute::find($attr_id);
		
		if ($attr->attr_type == "Varchar" || $attr->attr_type == "Boolean") {// tính độ tương đồng thuộc tính dạng text
			if ($example_attr == $item_attr) {
				return 1;
			}else{
				return 0;
			}
		}else{//tính độ tương đồng thuộc tính dạng số
			$max_value = Value::orderBy(DB::raw(' Cast(value AS UNSIGNED) ') ,'DESC' )->where('attr_id',$attr_id)->first()->value;

			return $point = 1 - ( abs($example_attr - $item_attr) / $max_value);
		}
	}

}
