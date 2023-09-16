<?php 


class Register extends Controller{


    public function index(){
        $this->view('templates/header');
        $this->view('register');
        $this->view('templates/footer');
    }

    public function register(){
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username'])){
            $url = url('login');
            $email = $_POST['email'];
            $password = $_POST['password'];
            $username = $_POST['username'];
            $level = $_POST['level'];
            if(!passwordValidation(8,$password)){
                 Flasher::setFlasher('Password minimal harus 8 karakter','register','error');
                 return Redirect::to('register');
            } 

            
            $password = password_hash($password,PASSWORD_BCRYPT);
            $this->model('PetugasModel')->createPetugas($username,$email,$password,$level);
            Flasher::setFlasher("Login berhasil. Silahkan <a href='{$url}'>login</a>",'register_petugas','success');
        }
        Redirect::to('register');
        
    }
}