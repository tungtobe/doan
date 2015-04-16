<?php

class CommentController extends BaseController {

    public function postStore() {
        $input = Input::all();
        $comment = new Comment;
        $comment->content = $input['content'];
        $comment->item_id = $input['item_id'];
        $comment->user_id = Auth::user()->id;
        $validation = Comment::validate($input);

        if ($validation->passes()) {
            $comment->save();
            $data ['msg'] = 'SUCCESS';
            $data ['content'] = $comment->content;
        } else {
            $data ['msg'] = 'FAIL';
            $data ['content'] = $validation->messages()->toArray();
        }

        return Response::json($data);
    }

}
