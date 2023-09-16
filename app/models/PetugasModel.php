<?php

class PetugasModel {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }


    public function createPembayaran($idSiswa,$nominal,$bulan,$year){
        $this->db->query('INSERT INTO pembayaran (fk_siswa,nominal,bulan,tahun) VALUES(:fk_siswa,:nominal,:bulan,:year)');
        $this->db->bind('fk_siswa',$idSiswa);
        $this->db->bind('nominal',$nominal);
        $this->db->bind('bulan',$bulan);
        $this->db->bind('year',$year);
        return $this->db->execute();
    
        
    }

    public function createPetugas($username,$email,$password,$level) {
        $this->db->query('INSERT INTO users (username,email,password,level) VALUES (:username,:email,:password,:level)');
        $this->db->bind('username',$username);
        $this->db->bind('email',$email);
        $this->db->bind('password',$password);
        $this->db->bind('level',$level);
        return $this->db->execute();
        
    }


  
}