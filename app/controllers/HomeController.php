<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/


	public function showWelcome(){
		$items = Item::orderByRaw("RAND()")->Paginate(12);
		$items_attr = $this->getItemAttributes($items);
		$items_vote_arr = $this->getItemsVote($items);
		$this->layout->content = View::make('hello')->with(array('items_attr' => $items_attr,
																 'items' => $items,
																 'items_vote_arr' => $items_vote_arr
																));
	}

	public function search(){
		$searchText = Input::get("search");
		$items = Item::where('name', 'LIKE', '%'.$searchText.'%')->Paginate(12);
		if ($items->isEmpty()) {
			$this->layout->content = View::make('hello')->with(array('items' => null));
		}else{
			$items_attr = $this->getItemAttributes($items);
			$items_vote_arr = $this->getItemsVote($items);
			$this->layout->content = View::make('hello')->with(array('items_attr' => $items_attr,
																	 'items' => $items->appends(Input::except('page')),
																	 'items_vote_arr' => $items_vote_arr
																	));
		}
	}

	public function advanceSearch(){
		$manufacturer = $this->getOneAttributeOption(5);
		$os = $this->getOneAttributeOption(7);
		$cameras = $this->getOneAttributeOption(24);
		$this->layout->content = View::make('user.advancesearch')->with(array(
																		"manufacturer" => $manufacturer,
																		"cameras" =>  $cameras,
																		"os" => $os,
																			));	
	}

	public function postAdvanceSearch(){
		$adv_search_array = array();
		$adv_search_items = Item::select('id')->get()->toArray();
		foreach ($adv_search_items as $key => $value) {
			array_push($adv_search_array, $value['id']);
		}

		$manufacturer = Input::get('manufacturer');
		$manufacturer_array = array();
		if (!is_null($manufacturer)) {
			$manu_items = Value::select('item_id')->where('attr_id', 5)->whereIN('value',$manufacturer)->get()->toArray();
			if (!is_null($manu_items) ) {
				foreach ($manu_items as $key => $value) {
					array_push($manufacturer_array, $value['item_id']);
				}
				$adv_search_array = array_intersect($adv_search_array, $manufacturer_array);
			}else{ // have no item fit with search
				return "break";
			}
		}else{
			$manufacturer_array = null;  // no adv search for manufacturer
		}

		if (count($adv_search_array) == 0) {
			return View::make('user.advancesearchresult')->with(array('status' => null));
		}
		$os = Input::get('os');
		$os_array = array();
		if (!is_null($os)) {
			$os_items = Value::select('item_id')->where('attr_id', 7)->whereIN('value',$os)->get()->toArray();
			if (count($os_items) > 0 ) {
				foreach ($os_items as $key => $value) {
					array_push($os_array, $value['item_id']);
				}
				$adv_search_array = array_intersect($adv_search_array, $os_array);
			}else{
				return "break2";
			}
		}else{
			$os_array = null; // no adv search for os
		}
		
		if (count($adv_search_array) == 0) {
			return View::make('user.advancesearchresult')->with(array('status' => null));
		}

		$cameras = Input::get('cameras');
		$camera_array = array();
			if (!is_null($cameras)) {
			$camera_items = Value::select('item_id')->where('attr_id', 24)->whereIN('value',$cameras)->get()->toArray();

			if (count($camera_items) > 0 ) {
				foreach ($camera_items as $key => $value) {
					array_push($camera_array, $value['item_id']);
				}
				$adv_search_array = array_intersect($adv_search_array, $camera_array);
			}else{
				return "break3";
			}

		}else{
			$camera_array = null; // no adv search for camera
		}
		
		if (count($adv_search_array) == 0) {
			return View::make('user.advancesearchresult')->with(array('status' => null));
		}

		$price = Input::get('price');
		$price_array = array();
		if(!is_null($price)){
			switch ($price) {
			    case 1: //<3.000.000
			        $price_items = Value::select('item_id')->where('attr_id', 20)->where(DB::raw('CAST(value AS SIGNED)'), '<', 3000000)->get()->toArray();
			        break;
			    case 2: // 3.000.000 -> 5.000.000
			        $price_items = Value::select('item_id')->where('attr_id', 20)->where(DB::raw('CAST(value AS SIGNED)'), '>=', 3000000)->where(DB::raw('CAST(value AS SIGNED)'), '<', 5000000)->get()->toArray();
			        break;
			    case 3: // 5.000.000 -> 10.000.000
			        $price_items = Value::select('item_id')->where('attr_id', 20)->where(DB::raw('CAST(value AS SIGNED)'), '>=', 5000000)->where(DB::raw('CAST(value AS SIGNED)'), '<', 10000000)->get()->toArray();
			        break;
			    case 4: // 10.000.000 -> 20.000.000
			        $price_items = Value::select('item_id')->where('attr_id', 20)->where(DB::raw('CAST(value AS SIGNED)'), '>=', 10000000)->where(DB::raw('CAST(value AS SIGNED)'), '<', 20000000)->get()->toArray();
			        break;
			    case 5: // > 20.000.000
			        $price_items = Value::select('item_id')->where('attr_id', 20)->where(DB::raw('CAST(value AS SIGNED)'), '>', 20000000)->get()->toArray();
			        break;
			}

			if (count($price_items) > 0) {
				foreach ($price_items as $key => $value) {
					array_push($price_array, $value['item_id']);
				}

				$adv_search_array = array_intersect($adv_search_array, $price_array);

			}else{
				return "break4";
			}
		}else{
			$price_array = null;
		}
		
		if (count($adv_search_array) == 0) {
			return View::make('user.advancesearchresult')->with(array('status' => null));
		}else{

			$items = Item::whereIN('id', $adv_search_array)->get();
			$items_attr = $this->getItemAttributes($items);
			$items_vote_arr = $this->getItemsVote($items);
			return View::make('user.advancesearchresult')->with(array('status' => 'OK',
																	'items_attr' => $items_attr,
																	 'items' => $items,
																	 'items_vote_arr' => $items_vote_arr
																	));
		}
	}
}
