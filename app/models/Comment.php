<?php

class Comment extends Eloquent {

    protected $table = 'comments';

    public static function validate($input) {
        $rules = array(
            'content' => 'required'
        );

        return Validator::make($input, $rules);
    }

    // //Define relationship between Video-Comments
    // public function video() {
    //     return $this->belongsTo('Video', 'video_id');
    // }

    // //Define relationship between Comments-User
    // public function user() {
    //     return $this->belongsTo('User', 'created_by');
    // }

}

?>