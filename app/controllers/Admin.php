<?php
class Admin extends Controller {
    public function index(){
        if(!Authorization::isLogin('user')) return Redirect::to('');
        if(!Authorization::permission('user',1)) return Redirect::to('dashboard');
        
        $datas['title'] = 'Admin dashboard';
        $siswa = $this->model('SiswaModel')->getAllSiswa();
        $siswaLimit = $this->model('SiswaModel')->getSiswaLimit(5,'tanggal DESC');
        
        
        $datas['siswa'] = [
            'items' => $siswa,
            'total' => count($siswa)
        ];

        $datas['siswaLimited'] = [
            "items" => $siswaLimit,
            'total' => count($siswaLimit)
        ];
        
        $datas['jurusan'] = ['Bisnis Kontruksi dan Properti', 'Desain Pemodelan dan Informasi Bangunan','Teknik Pemesinan','Teknik dan Bisnis Sepeda Motor','Teknik Kendaraan Ringan dan Otomotif','Teknik Instalasi Tenaga Listrik','Teknik Pendingin Tata Udara','Rekayasa Perangkat Lunak','Teknik Komputer dan Jaringan','Multimedia'];
        $this->view("templates/header",$datas);
        $this->view("admin/dashboard",$datas);
        $this->view("templates/footer");
    }

    public function create(){
        if(!Authorization::isLogin('user')) return Redirect::to('');
        if(!Authorization::permission('user',1)) return Redirect::to('dashboard');
        if(isset($_POST)){
            $result = $this->model('SiswaModel')->getSiswaByName($_POST['nama']);
            if(count($result) > 0){
                Flasher::setFlasher("Nama siswa sudah terdaftar","create","error");
                Redirect::to('admin');
                return;
            }
            $result = $this->model('SiswaModel')->getSiswaByNIS($_POST['NIS']);
            if(count($result) > 0){
                Flasher::setFlasher("NIS siswa sudah terdaftar","create","error");
                Redirect::to('admin');
                return;
            }
            $result = $this->model('SiswaModel')->getSiswaByNISN($_POST['NISN']);
            if(count($result) > 0){
                Flasher::setFlasher("NISN siswa sudah terdaftar","create","error");
                Redirect::to('admin');
                return;
            }
            $this->model("SiswaModel")->createSiswa($_POST);
            Flasher::setFlasher("Siswa berhasil ditambahkan","create","success");

        }
        Redirect::to('admin');
    }

    public function detail($id) {
        require_once "../app/controllers/siswa.php";
        $siswa = new Siswa;
        $siswa->detail($id);
    }

    public function delete($id,$redirect) {
        if(!Authorization::isLogin('user')) return Redirect::to('');
        if(!Authorization::permission('user',1)) return Redirect::to('dashboard');
        
        $siswa = $this->model('SiswaModel')->getSiswaById($id);
        if(!$siswa){
             echo "<h1 style='text-align:center;'>Siswa tidak ditemukan</h1>";
             return;
        }
        $result = $this->model('SiswaModel')->deleteSiswa($id);
        if($result){
            Flasher::setFlasher("Siswa dengan nama {$siswa['nama_lengkap']} berhasil dihapus",'delete','success');
            Redirect::to($redirect);
        }

    }

  


}