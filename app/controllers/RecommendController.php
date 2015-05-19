<?php

class RecommendController extends BaseController {

	public function reciveCritique(){
		$input = Input::all();
		return $input;


		$current_item = Input::get('current_item');
		$critique_attr = Input::get('attr');
		
	}

	public function getFirstRecommend(){
        // get first recommend list
        $id = Input::get('id');
        $example_vector = $this->makeExampleVector($id, null);
        $recommend_list = $this->getRecommendList($example_vector, null);
        arsort($recommend_list);
        return "abcd";
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

		// $items = Item::all();
		
		$items = Item::select('id')->get()->toArray();

		// var_dump($items);die;
		
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
			
			$recommend_list[$item['id']] = $item_similar_point;
			
		}
		return $recommend_list;
	}

	// Tính độ tương tự của 1 sản phẩm với sản phẩm mẫu
	// Đầu vào: Sản phẩm - Sản phẩm mẫu
	// Đẩu ra : Vector có key là attr_id, value là độ tương tự của attribute đó tính theo thang 1
	public function compareSimilar($item, $example_vector){
		$compared_vector = array();
		foreach ($example_vector as $key => $value) {
			$item_attr = Value::where(array('attr_id'=> $key, 'item_id' => $item['id']))->first();
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