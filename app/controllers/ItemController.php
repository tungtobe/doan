<?php

class ItemController extends BaseController {

    public function showItem(){
        
    }


    public function getShow($id){
    	$item = Item::find($id);
        if($item == null) {
            return Response::json(404);
        }

        // get item attribute
    	$item_attr = $this->getOneItemAttributes($item);
    	$item_attr_type = $this->getAttributeType();
        $item_attr_option = $this->getAttributeOption();
        //get item comment
        $comments = $item->comment;

        //get item vote
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $vote = Vote::where(array(
                                'user_id'=> $user_id,
                                'item_id'=> $id
                                ))->first();
            if (is_null($vote)) {
                $vote_type = null;
            }else{
                $vote_type = $vote->type;
            }

        }else{
            $vote_type=null;
        }


		$this->layout->content = View::make('item.detail')->with(array('item'=> $item,
																		'item_attr' => $item_attr,
																		'item_attr_type' => $item_attr_type,
                                                                        'item_attr_option' => $item_attr_option,
                                                                        'comments'=> $comments,
                                                                        'vote_type'=> $vote_type
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

    public function vote(){
        $item_id = Input::get('id');
        $user_id = Auth::user()->id;
        $vote_type = Input::get('type');
        $vote = Vote::where(array(
                            'item_id' => $item_id,
                            'user_id' => $user_id,
                            ))->first();

        if (is_null($vote)) {
            $new_vote = new Vote;
            $new_vote->item_id = $item_id;
            $new_vote->user_id = $user_id;
            $new_vote->type = $vote_type;
            $new_vote->save();
            return Response::json ( array (
                'mes' => 'OK'
            ) );
        }else{
            if ($vote->type == $vote_type) {
                $vote->delete();
                return Response::json ( array (
                'mes' => 'unvote'
                ) );
            }else{
                $vote->type = $vote_type;
                $vote->save();
                return Response::json ( array (
                'mes' => 'OK'
                ) );
            }
        }
    }
}
