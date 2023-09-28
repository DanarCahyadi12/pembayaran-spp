<?php

class Petugas extends Controller
{
    private $data;
    public function index()
    {
        if (!Authorization::isLogin('user')) return Redirect::to('');
        if (!Authorization::permission('user', 0)) return Redirect::to('');

        $datas['title'] = 'Pembayaran';
        $datas['jurusan'] = ['Bisnis Kontruksi dan Properti', 'Desain Pemodelan dan Informasi Bangunan', 'Teknik Pemesinan', 'Teknik dan Bisnis Sepeda Motor', 'Teknik Kendaraan Ringan dan Otomotif', 'Teknik Instalasi Tenaga Listrik', 'Teknik Pendingin Tata Udara', 'Rekayasa Perangkat Lunak', 'Teknik Komputer dan Jaringan', 'Multimedia'];
        $datas['months'] = getMonths();
        if (Session::exits('result_search_siswa_not_paid'))  $datas['siswa'] = ['items' => Session::get('result_search_siswa_not_paid'), 'total' => count(Session::get('result_search_siswa_not_paid'))];
        if(Session::exits('filters')) $datas['filter'] = Session::get('filters');
        $this->view('templates/header', $datas);
        $this->view('petugas/search', $datas);
        $this->view('templates/footer');
        if (Session::exits('result_search_siswa_not_paid'))  Session::delete('result_search_siswa_not_paid');
    }

    public function cari()
    {
        if (!Authorization::isLogin('user')) return Redirect::to('');
        if (!Authorization::permission('user', 0)) return Redirect::to('');



        if (empty($_POST['search']) && empty($_POST['kelas']) && empty($_POST['jurusan'])) {
            Redirect::to('petugas');
            return;
        }
        $filter = [
            'kelas' => $_POST['kelas'],
            'jurusan' => $_POST['jurusan']
        ];
        
        if (!empty($_POST['kelas']) && !empty($_POST['jurusan']) && empty($_POST['search'])) {
            $this->data = $this->model('SiswaModel')->getAllSiswaByKelasAndJurusan($_POST['kelas'], $_POST['jurusan']);
        }

        if (empty($_POST['search']) && !empty($_POST['kelas'])  && empty($_POST['jurusan'])) {
            $this->data = $this->model('SiswaModel')->getAllSiswaByKelas($_POST['kelas']);
        }

        if (empty($_POST['search']) && !empty($_POST['jurusan']) && empty($_POST['kelas'])) {
            $this->data = $this->model('SiswaModel')->getAllSiswaByJurusan($_POST['jurusan']);
        }
        if (empty($_POST['kelas']) && empty($_POST['jurusan']) && !empty($_POST['search'])) {
            $this->data = $this->model('SiswaModel')->searchSiswa($_POST['search']);
        }
        if (!empty($_POST['search']) && !empty($_POST['kelas']) && !empty($_POST['jurusan'])) {
            $this->data = $this->model('SiswaModel')->searchSiswa($_POST['search'], $filter);
        }
        if (!empty($_POST['search']) && empty($_POST['kelas']) && !empty($_POST['jurusan'])) {
            echo 'TETSTSTS';
            $this->data = $this->model('SiswaModel')->searchSiswa($_POST['search'], $filter);
        }
        if (!empty($_POST['search']) && !empty($_POST['kelas']) && empty($_POST['jurusan'])) {
            $this->data = $this->model('SiswaModel')->searchSiswa($_POST['search'], $filter);
        }
        if (!empty($_POST['search']) && empty($_POST['kelas']) && !empty($_POST['jurusan'])) {
            $this->data = $this->model('SiswaModel')->searchSiswa($_POST['search'], $filter);
        }
        Session::set('filters',$filter);
        var_dump(Session::get('filters'));
        Session::set('result_search_siswa_not_paid', $this->data);
        Redirect::to('petugas');
    }

    public function detail_siswa($id = null)
    {   
        if(is_null($id)) return Redirect::to('dashboard');
        
        if (!Authorization::isLogin('user')) return Redirect::to('');
        if (!Authorization::permission('user', 0)) return Redirect::to('');

        $datas['title'] = 'Detail siswa';
        $siswa = $this->model('SiswaModel')->getSiswaById($id);
        $siswaPaid = $this->model('SiswaModel')->getSiswaPaidById($id);
        if(!$siswa){
            echo "<h1 class='text-center mx-auto'>Siswa tidak ditemukan</h1>";
            return;
        }
        $datas['siswaSingle'] = $siswa;
        $datas['siswa_paid'] = $siswaPaid;
        $this->view('templates/header', $datas);
        $this->view('petugas/detailsiswa', $datas);
        $this->view('templates/footer');
    }

    public function pembayaran($id = null,$year = null)
    {

        if( is_null($id) || is_null($year))  return Redirect::to('petugas');
        $currentYearAndNext = getCurrentYearAndNextYear();
        if(!in_array($year,$currentYearAndNext)) return Redirect::to('petugas');
        if (!Authorization::isLogin('user')) return Redirect::to('');
        if (!Authorization::permission('user', 0)) return Redirect::to('');

        $currentYearAndNext = getCurrentYearAndNextYear();
        $datas['currentYearAndNext'] = $currentYearAndNext;
        $siswa = $this->model('SiswaModel')->getSiswaById($id);
        $siswaPaid = $this->model('SiswaModel')->getSiswaPaidByIdAndYear($id,$year);
        $datas['siswa_paid'] = $siswaPaid;
        $datas['siswaSingle'] = $siswa;
        $datas['title'] = 'Pembayaran';
        $datas['year']  = $year;
        $this->view('templates/header', $datas);
        $this->view('petugas/formpembayaran', $datas);
        $this->view('templates/footer');
    }
    

    public function bayar($idSiswa = null,$year = null){
        if(is_null($idSiswa) || is_null($year)) return Redirect::to('petugas');
        if(!isset($_POST['bulan'])) return Redirect::to('petugas');
        if (!Authorization::isLogin('user')) return Redirect::to('');
        if (!Authorization::permission('user', 0)) return Redirect::to('');
        $bulan = $_POST['bulan'];
        $result = $this->model('petugasmodel')->createPembayaran($idSiswa,1000,$bulan,$year);
        if($result){
            Flasher::setFlasher('Pembayaran berhasil','pembayaran','success');
            Redirect::to('petugas/pembayaran/'.$idSiswa.'/'.$year);
        }

    }
}
