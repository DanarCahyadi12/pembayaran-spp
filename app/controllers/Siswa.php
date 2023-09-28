<?php 

class Siswa extends Controller {
    private $data;

    public function index() {
        if(!Authorization::isLogin('user')) return Redirect::to('');
        if(!Authorization::permission('user',1)) return Redirect::to('dashboard');
        
        $datas['jurusan'] = ['Bisnis Kontruksi dan Properti', 'Desain Pemodelan dan Informasi Bangunan','Teknik Pemesinan','Teknik dan Bisnis Sepeda Motor','Teknik Kendaraan Ringan dan Otomotif','Teknik Instalasi Tenaga Listrik','Teknik Pendingin Tata Udara','Rekayasa Perangkat Lunak','Teknik Komputer dan Jaringan','Multimedia'];
        $datas['title'] = 'Halaman siswa';
        $this->data = $this->model('SiswaModel')->getAllSiswa();
    $datas['siswa'] = [
            'items' => $this->data,
            'total' => count($this->data)
        ];

        if(Session::exits('data_siswa')) $datas['siswa'] = Session::get('data_siswa');
        $this->view('templates/header',$datas);
        $this->view('admin/Siswa',$datas);
        $this->view('templates/footer');

        
        if(Session::exits('data_siswa'))Session::delete('data_siswa');
        
    }

    public function cari(){
        if(!Authorization::isLogin('user')) return Redirect::to('');
        if(!Authorization::permission('user',1)) return Redirect::to('dashboard');
        $datas['title'] = 'Halaman siswa';
        
            if(empty($_POST['search']) && empty($_POST['kelas']) && empty($_POST['jurusan'])){
                Redirect::to('siswa');
                return;
            }
            $filter = [
                'kelas' => $_POST['kelas'],
                'jurusan' => $_POST['jurusan']
            ];
            if( !empty($_POST['kelas']) && !empty($_POST['jurusan']) && empty($_POST['search'])){     
                $this->data = $this->model('SiswaModel')->getAllSiswaByKelasAndJurusan($_POST['kelas'],$_POST['jurusan']);
            }

            if(empty($_POST['search']) && !empty($_POST['kelas'])  && empty($_POST['jurusan'])){
                $this->data = $this->model('SiswaModel')->getAllSiswaByKelas($_POST['kelas']);
            }

            if(empty($_POST['search']) && !empty($_POST['jurusan']) && empty($_POST['kelas'])){
                $this->data = $this->model('SiswaModel')->getAllSiswaByJurusan($_POST['jurusan']);
            }
            if(empty($_POST['kelas']) && empty($_POST['jurusan']) && !empty($_POST['search'])){
                $this->data = $this->model('SiswaModel')->searchSiswa($_POST['search']);
            }
            if(!empty($_POST['search']) && !empty($_POST['kelas']) && !empty($_POST['jurusan'])  ){
                $this->data = $this->model('SiswaModel')->searchSiswa($_POST['search'],$filter);
            }
            if(!empty($_POST['search']) && !empty($_POST['kelas']) && empty($_POST['jurusan'])  ){
                $this->data = $this->model('SiswaModel')->searchSiswa($_POST['search'],$filter);
            }
            if(!empty($_POST['search']) && empty($_POST['kelas']) && !empty($_POST['jurusan'])  ){
                $this->data = $this->model('SiswaModel')->searchSiswa($_POST['search'],$filter);
            }

            $datas['siswa'] = [
                'items' => $this->data,
                'total' => count($this->data)
            ];
                
            Session::set('data_siswa',$datas['siswa']);
            Session::set('filters',$filter);
            Redirect::to('siswa');


        
    }
    public function edit($id = null){
        if(is_null($id)) Redirect::to('siswa');
        if(!Authorization::isLogin('user')) return Redirect::to('');
        if(!Authorization::permission('user',1)) return Redirect::to('dashboard');
        $siswaSingle = $this->model('SiswaModel')->getSiswaById($id);
        if(!$siswaSingle){
            echo "<h1 style='text-align:center;'>Siswa tidak ditemukan</h1>";
            return;
        }
        $datas['jurusan'] = ['Bisnis Kontruksi dan Properti', 'Desain Pemodelan dan Informasi Bangunan','Teknik Pemesinan','Teknik dan Bisnis Sepeda Motor','Teknik Kendaraan Ringan dan Otomotif','Teknik Instalasi Tenaga Listrik','Teknik Pendingin Tata Udara','Rekayasa Perangkat Lunak','Teknik Komputer dan Jaringan','Multimedia'];
        $datas['siswaSingle'] = $siswaSingle;
        $datas['title'] = 'Edit siswa';
        $this->view("templates/header",$datas);
        $this->view("admin/editsiswa",$datas);
        $this->view("templates/footer");
    }

    public function editSiswa($id) {
        if(!Authorization::isLogin('user')) return Redirect::to('');
        if(!Authorization::permission('user',1)) return Redirect::to('dashboard');
        
        $siswaSingle = $this->model('SiswaModel')->getSiswaById($id);
        if(!$siswaSingle){
            echo "<h1 style='text-align:center;'>Siswa tidak ditemukan</h1>";
            return;
        }
        $siswa = $this->model('SiswaModel')->getSiswaByUsernameExceptId($_POST['nama_lengkap'],$id);
        if($siswa) {
            Flasher::setFlasher("Siswa atas nama {$_POST['nama_lengkap']} sudah terdaftar",'update','error');
            return Redirect::to('siswa/edit/' . $siswaSingle['id']);
        }
        $siswa = $this->model('SiswaModel')->getSiswaByNISNExceptId($_POST['NISN'],$id);
        if($siswa) {
            Flasher::setFlasher("Siswa dengan NISN {$_POST['NISN']} sudah terdaftar",'update','error');
            return Redirect::to('siswa/edit/' . $siswaSingle['id']);
        }
        $siswa = $this->model('SiswaModel')->getSiswaByNISExceptId($_POST['NIS'],$id);
        if($siswa) {
            Flasher::setFlasher("Siswa dengan NIS {$_POST['NIS']} sudah terdaftar",'update','error');
            return Redirect::to('siswa/edit/' . $siswaSingle['id']);
        }
        $result = $this->model('SiswaModel')->updateSiswa($_POST,intval($id));
        if($result) {
            Flasher::setFlasher('Update data siswa berhasil','update','success');
            Redirect::to('siswa/edit/' . $siswaSingle['id']);
        }
    }

    public function delete($id = null) {
        if(is_null($id)) return Redirect::to("siswa");
        require_once "../app/controllers/Admin.php";
        $admin = new Admin;
        $admin->delete($id,'siswa');
    }

    public function detail($id = null){
    if(is_null($id)) return Redirect::to('siswa');
        if(!Authorization::isLogin('user')) return Redirect::to('');
        if(!Authorization::permission('user',1)) return Redirect::to('dashboard');
        $datas['title'] = 'Detail siswa';
        $siswaSingle = $this->model('SiswaModel')->getSiswaById($id);
        if(!$siswaSingle){
            echo "<h1 style='text-align:center;'>Siswa tidak ditemukan</h1>";
            return;
       }
        $anotherSiswa = $this->model('SiswaModel')->getSiswaByIdIsNot($id);
        $datas['anotherSiswa'] = [
            'items' => $anotherSiswa,
            'total' => count($anotherSiswa)
        ];
        $datas['siswaSingle'] = $siswaSingle;
        $this->view("templates/header",$datas);
        $this->view("admin/detailsiswa",$datas);
        $this->view("templates/footer");
    }
}