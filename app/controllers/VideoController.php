// <?php

// class VideoController extends BaseController {

// 	// caculate video existed time
//     private function existTime($updated_time) {
//         $now = date('Y-m-d H:i:s');
//         $now = strtotime($now);
//         return $now - $updated_time;
//     }

//     // caculate video remaining time
//     private function getCountDown($updated_time) {
//         $date = date('Y-m-d H:i:s');
//         $date = strtotime($date);
//         $existed_time = $date - $updated_time;
//         $max_exist_time = Config::get('params.globalVar.MAX_EXIST_TIME');
//         return $max_exist_time - $existed_time;
//     }

//     // check video is expire
//     private function isExpire($id) {
//         $video = Video::find($id);

//         // check if video has deleted or already deactived
//         if ($video == null || $video->status == "deactive") {
//             return true;
//         }

//         // check if video has expired
//         $updated_time = strtotime($video->updated_at);
//         $exist_time = $this->existTime($updated_time);
//         $max_exist_time = Config::get('params.globalVar.MAX_EXIST_TIME');
//         if ($exist_time > $max_exist_time) { // expired
//             $video->status = "deactive";
//             $video->save();
//             return true;
//         } else {
//             return false; // not expire
//         }
//     }

//     public function showVideo($id) {
//     	$video = Video::find($id);
//     	//check video null
//     	if (is_null($video)) {
//     		return $this->layout->content = View::make('notfound');
//     	}

//         if ($this->isExpire($id)) {
//             $this->layout->content = View::make('video.expired')->with('id', $id);
//         } else {            
//             // get count down time
//             $updated_time = strtotime($video->updated_at);
//             $count_down = $this->getCountDown($updated_time);


//             $comments = $video->comment()->orderBy('id', 'DESC')->get();
//             foreach ($comments as $comment) {
//                 $comment['comment_username'] = $comment->user->username;
//                 $comment['comment_userid'] = $comment->user->unique_id;
//             }

//             $this->layout->content = View::make('video.detail')->with(array(
//                 'video' => $video,
//                 'comments' => $comments,
//                 'count_down' => $count_down
//             ));
//         }
//     }

//     public function upload() {
//         $upload_dir = $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']);
//         $upload_url = 'videoupload/';
//         $temp_name = $_FILES['uploadedfile']['tmp_name'];
//         $file_name = $_FILES['uploadedfile']['name'];
//         $file_name1 = md5(uniqid(rand(), TRUE)) . ".mp4"; //random file name 
//         $file_path = $upload_dir . $upload_url . $file_name1;
//         if (move_uploaded_file($temp_name, $file_path)) {
//             $newvideo = new Video;
//             $newvideo->title = $_POST['video_title'];
//             $newvideo->status = "active";
//             $newvideo->created_by = Auth::user()->id;
//             $newvideo->link = "/../" . $upload_url . $file_name1;
//             $newvideo->save();
//             return Response::json(array(
//                         'status' => "SUCCESS",
//                         'link' => URL::action('VideoController@showVideo', $newvideo->id)
//             ));
//         } else {
//             return Response::json(array(
//                         'status' => "FAIL",
//                         'error_mess' => "Some error has occurred"
//             ));
//         }
//     }

//     public function requestReborn() {
//         $video_id = $_POST['video_id'];
//         $user_id = $_POST['user_id'];
//         $request = RebornRequest::where(array(
//                     'video_id' => $video_id,
//                     'user_id' => $user_id
//                 ))->first();
//         if (is_null($request)) {
//             $new_reborn_request = new RebornRequest;
//             $new_reborn_request->user_id = $user_id;
//             $new_reborn_request->video_id = $video_id;
//             if ($new_reborn_request->save()) {
//                 return Response::json(array(
//                             'msg' => "SUCCESS",
//                             'text' => "Success Request"
//                 ));
//             } else {
//                 return Response::json(array(
//                             'msg' => "FAIL",
//                             'text' => "Request FAIL, plase try again"
//                 ));
//             }
//         } else {
//             return Response::json(array(
//                         'msg' => "DUPLICATE",
//                         'text' => "This video has been requested"
//             ));
//         }
//     }

//     public function reborn($video_id) {
//         $video = Video::find($video_id);
//         if (is_null($video)) {
//             return Redirect::action('UserController@getShow', array(Auth::user()->unique_id));
//         }

//         // edit video status
//         $video->status = "active";
//         $video->save();

//         // delete reborn request
//         $request = RebornRequest::where('video_id', $video_id)->delete();

//         return Redirect::action('UserController@getShow', array(Auth::user()->unique_id));
//     }

//     public function deactive($video_id) {
//         $video = Video::find($video_id);
//         if (is_null($video)) {
//             return Redirect::action('UserController@getShow', array(Auth::user()->unique_id));
//         }

//         // check video owner
//         if ($video->created_by != Auth::user()->id) {
//             return Redirect::action('UserController@getShow', array(Auth::user()->unique_id));
//         }

//         // edit video status
//         $video->status = "deactive";
//         $video->save();
//         return Redirect::action('UserController@getShow', array(Auth::user()->unique_id));
//     }

//     public function delete($video_id) {
//         $video = Video::find($video_id);
//         if (is_null($video)) {
//             return Redirect::action('UserController@getShow', array(Auth::user()->unique_id));
//         }

//         // check video owner
//         if ($video->created_by != Auth::user()->id) {
//             return Redirect::action('UserController@getShow', array(Auth::user()->unique_id));
//         }

//         unlink($video->link);
//         $video->delete();
//         return Redirect::action('UserController@getShow', array(Auth::user()->unique_id));
//     }

// }
