<?php 
class Pembayaran extends Controller {

    
    public function bulan($bulan = null){
        if(is_null($bulan)) return Redirect::to('dashboard');
            
        
        if (!Authorization::isLogin('user')) return Redirect::to('');
        if (!Authorization::permission('user', 0)) return Redirect::to('');
        $datas['title'] = "Pembayaran bulan {$bulan}";
        $siswaPaid = setStatusToPaid($this->model('SiswaModel')->getSiswaPaidByBulan($bulan));
        $siswaNotPaid = setStatusToNotPaid($this->model('SiswaModel')->getSiswaNotPaidByBulan($bulan));
        $result = array_merge($siswaNotPaid,$siswaPaid);
        
        usort($result,function($a,$b) {
            return $a['status'] <=> $b['status'];
        });
        
        $datas['siswa'] = [
            'items' => $result,
            'total' => count($result)
        ];
        $datas['bulan'] = getMonth($bulan);
        $this->view("templates/header",$datas);
        $this->view("petugas/pembayaranbulan",$datas);
        $this->view("templates/footer");

    }
}