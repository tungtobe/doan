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


	public function showWelcome()
	{
		$items = Item::Paginate(12);
		$items_attr = $this->getItemAttributes($items);
		$this->layout->content = View::make('hello')->with(array('items_attr' => $items_attr,
																 'items' => $items
																));
	}

	public function showAdminMenu(){
		$this->layout->content = View::make('adminmenu');
	}

}
