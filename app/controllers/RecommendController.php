<?php

class RecommendController extends BaseController {

	public function reciveCritique(){
		$current_item_id = Input::get('current_item');
		$critique_attr = Input::get('attr');

		$example_vector = $this->makeExampleVector($current_item_id, $critique_attr);
		$weight_vector = $this->makeWeightVector($critique_attr);
		$recommend_list = $this->getRecommendList($current_item_id, $example_vector, $weight_vector);
		$sort_list = $this->getSortRecommendList($recommend_list);

        return View::make('item.recommend')->with(array('recommend_list'=>$sort_list, 'critique_attr' => $critique_attr));
	}

	public function critique(){
		$current_item_id = Input::get('current_item');
		$critique_attr = Input::get('attr');

		$example_vector = $this->makeExampleVector($current_item_id, $critique_attr);
		$weight_vector = $this->makeWeightVector($critique_attr);
		$recommend_list = $this->getRecommendList($current_item_id, $example_vector, $weight_vector);
		$sort_list = $this->getSortRecommendList($recommend_list);

		$this->layout->content = View::make('item.critique')->with(array('recommend_list'=>$sort_list, 'critique_attr' => $critique_attr));
	}

	public function getFirstRecommend(){
        // get first recommend list
        $id = Input::get('id');
        $example_vector = $this->makeExampleVector($id, null);
        $recommend_list = $this->getRecommendList($id,$example_vector, null);
        $sort_list = $this->getSortRecommendList($recommend_list);
		return View::make('item.recommend')->with('recommend_list',$sort_list);
	}

    public function getSortRecommendList($recommend_list){
    	$number_of_item = 9;
    	arsort($recommend_list);
  		// return sorted array
  		return $newArray = array_slice($recommend_list, 0, $number_of_item, true);
    }

    public function makeWeightVector($critique_attr){
    	$weight_array = array();
    	$unchange_var = Setting::where('key','unchange')->first();
        if ($unchange_var == null) {
            $unchange = 1;
        }else{
            $unchange = $unchange_var->value;
        }

        $changed_var = Setting::where('key','changed')->first();
        if ($changed_var == null) {
            $changed = 2;
        }else{
            $changed = $changed_var->value;
        }

    	foreach ($critique_attr as $key => $value) {
			if ($value == "") {
				$weight_array[$key] = $unchange;
			}else{
				$weight_array[$key] = $changed;
			}
		}
		return $weight_array;
    }

    public function makeExampleVector($item_id, $critique_attr){
		$exampleVector = array();
		if (is_null($critique_attr)) {
			$attr_values = Value::where('item_id',$item_id)->get()->toArray();
			foreach ($attr_values as $attr_value) {
				$exampleVector[$attr_value['attr_id']] = $attr_value['value'];
			}
		}else{
			foreach ($critique_attr as $key => $value) {
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

	public function getRecommendList($current_item_id,$example_vector, $weight_vector){
		$recommend_list = array();
		$items = Item::select('id')->where('id','!=', $current_item_id )->get()->toArray();

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