<?php 


class Logout {
    public function index(){
        Session::destroy('user');
        Redirect::to('');
    }
}