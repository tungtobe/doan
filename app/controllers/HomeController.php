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
		// $items = Item::orderByRaw("RAND()")->Paginate(12);
		$items = Item::Paginate(12);
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

	public function showAdminMenu(){
		$this->layout->content = View::make('adminmenu');
	}

}
