<?php

class RecommendController extends BaseController {

	public function reciveCritique(){
		$input = Input::all();
		return $input;
	}
}