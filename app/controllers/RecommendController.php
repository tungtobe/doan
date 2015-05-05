<?php

class RecommendController extends BaseController {

	public function reciveCritique(){
		$input = Input::all();
		return $input;


		$current_item = Input::get('current_item');
		$critique_attr = Input::get('attr');
		
	}
}