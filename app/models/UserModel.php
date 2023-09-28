<?php

class UserModel {
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function getAllPetugas(){
        $this->db->query('SELECT id,username,email,level FROM users WHERE level = :level');
        $this->db->bind('level', 0);
        $this->db->execute();
        return $this->db->results();

    }

    public function getUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind('email',$email);
        $this->db->execute();
        return $this->db->result();
    }

    public function getUserByUsername($username){
        $this->db->query('SELECT id,username,email,level FROM users WHERE username = :username');
        $this->db->bind('username',$username);
        $this->db->execute();
        return $this->db->result();
    }
}