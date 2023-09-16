<?php

class Dashboard extends Controller {
    public function index(){
        if(!Authorization::isLogin('user')) return Redirect::to('');
        if(!Authorization::permission('user',0)) return Redirect::to('');
        $datas['title'] = 'Dashboard petugas';
        $datas['months'] = getMonths();
        $this->view('templates/header',$datas);
        $this->view('petugas/Dashboard',$datas);
        $this->view('templates/footer');
    }
}