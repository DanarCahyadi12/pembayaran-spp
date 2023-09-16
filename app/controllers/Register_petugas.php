<?php 


class Register_petugas extends Controller{


    public function index(){
        $this->view('templates/header');
        $this->view('petugas/register');
        $this->view('templates/footer');
    }

    public function register(){
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username'])){
            $url = url('login');
            $email = $_POST['email'];
            $password = $_POST['password'];
            $username = $_POST['username'];
            $password = password_hash($password,PASSWORD_BCRYPT);
            $this->model('PetugasModel')->createPetugas($username,$email,$password);
            Flasher::setFlasher("Login berhasil. Silahkan <a href='{$url}'>login</a>",'register_petugas','success');
        }
        Redirect::to('register_petugas');
        
    }
}