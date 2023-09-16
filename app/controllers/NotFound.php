<?php 

class NotFound extends Controller {
    public function index(){
        $this->view('templates/Header');
        $this->view('NotFound');
        $this->view('templates/Footer');
    }
}