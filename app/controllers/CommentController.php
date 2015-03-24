<?php

class CommentController extends BaseController {

    public function postStore() {
        $input = Input::all();
        $comment = new Comment;
        $comment->content = $input['content'];
        $comment->video_id = $input['video_id'];
        $comment->created_by = Auth::user()->id;
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
