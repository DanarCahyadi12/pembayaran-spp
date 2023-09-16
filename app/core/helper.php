<?php

    function url($path) {
        return BASE_URL . "/" .$path;
    }

function formatDate($date) {
    $date = explode(' ',$date)[0];
    $date = explode('-',$date);
    $y = $date[0];
    $m = $date[1];
    $d = $date[2];

    $month = [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'Mei',
        'Jun',
        'Jul',
        'Agu',
        'Sep',
        'Okt',
        'Nov',
        'Des'
    ];

    return "{$d} {$month[intval($m)]} {$y}";

}

function getMonths(){
    return  [
        [
         'id' => '1',
         'bulan' =>'Januari'
         
        ],
        [
         'id' => '2',
         'bulan' =>'Februari'
         
        ],
        [
         'id' => '3',
         'bulan' =>'Maret'
         
        ],
        [
         'id' => '4',
         'bulan' =>'April'
         
        ],
        [
         'id' => '5',
         'bulan' =>'Mei'
         
        ],
    
        [
         'id' => '6',
         'bulan' =>'Juni'
         
        ],
    
        [
         'id' => '7',
         'bulan' =>'Juli'
         
        ],
    
        [
         'id' => '8',
         'bulan' =>'Agustus'
         
        ],
        [
         'id' => '9',
         'bulan' =>'September'
         
        ],
        [
         'id' => '10',
         'bulan' =>'Oktober'
         
        ],
        [
         'id' => '11',
         'bulan' =>'November'
         
        ],
        [
         'id' => '12',
         'bulan' =>'Desember'
         
        ],
    
    ];
}

function getMonth($month){
    $months = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    return $months[$month-1];
}

function setGender($gender) {
    return $gender == '1' ? "Perempuan" : "Laki-laki";
}


function getCurrentYearAndNextYear(){
    $year = (new DateTime)->format("Y");
    $year = intval($year);
    return  [
        $year,
        $year +1,
        $year +2
    ];
}

function setStatusToPaid($siswa){
    $result = [];
    foreach($siswa as $data){
        $result[] = [
          'id' => $data['id'],
          'nama_lengkap' => $data['nama_lengkap'],
          'NIS' => $data['NIS'],
          'NISN' => $data['NISN'],
          'jenis_kelamin' => $data['jenis_kelamin'],
          'kelas' => $data['kelas'],
          'jurusan' => $data['jurusan'],
          'fk_admin' => $data['fk_admin'],
          'tanggal' => $data['tanggal'],
          'status' => 1
        ];
    }

    return $result;
}
function setStatusToNotPaid($siswa){

    $result = [];

    foreach($siswa as $data){
        $result[] = [
          'id' => $data['id'],
          'nama_lengkap' => $data['nama_lengkap'],
          'NIS' => $data['NIS'],
          'NISN' => $data['NISN'],
          'jenis_kelamin' => $data['jenis_kelamin'],
          'kelas' => $data['kelas'],
          'jurusan' => $data['jurusan'],
          'fk_admin' => $data['fk_admin'],
          'tanggal' => $data['tanggal'],
          'status' => 0
        ];
    }

    return $result;
}