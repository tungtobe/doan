<?php

class ItemController extends BaseController {

    public function showItem(){
        
    }


    public function getShow($id){
    	$item = Item::find($id);
    	$item_attr = $this->getOneItemAttributes($item);
    	$item_attr_type = $this->getAttributeType();
		$this->layout->content = View::make('item.detail')->with(array('item'=> $item,
																		'item_attr' => $item_attr,
																		'item_attr_type' => $item_attr_type
																		));
    }

    public function addFavorite(){
    	
        $item_id = Input::get('id');
        $user_id = Auth::user()->id;
        $favorite_item = Favoriteitem::where(array('user_id' => $user_id,
        											'item_id' => $item_id
        	))->first();
        if (is_null ($favorite_item)) {
        	$add_item = new Favoriteitem();
        	$add_item->user_id = $user_id;
        	$add_item->item_id = $item_id;
        	$add_item->save();
        	return Response::json ( array (
                'mes' => 'Item has been added to your favorite'
        	));
        }else{
        	return Response::json ( array (
                'mes' => 'Item already in your favorite'
        	));
        }
    }

   

}
