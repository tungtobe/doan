<?php

class UserController extends BaseController {

    public function getShow($id) {
        $users = User::where('id', $id)->get();
        $user = $users[0];

        
    }

}
