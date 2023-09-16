<?php

class Authorization{
    public static function isLogin($name){
        $login = Session::exits($name);
        return $login ? true : false;
        }

    public static function permission($name,$userHasAccess) {
        $user = Session::get($name);
        return $user['level'] == $userHasAccess ? true : false;
    }
}