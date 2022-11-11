<?php

class Login_model {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function cekUser()
    {
        $query = "SELECT * FROM user";
        $this->db->query($query);
        return $this->db->singel();
    }
    
    public function userBaru()
    {
        $noID = round(microtime(true));
        $namaLengkap = 'Administrator';
        $telp = '000';
        $namaUser = 'Admin';
        $sandi = hash('sha256','Winbro098');
        $email = '-';
        $level = 'Super Admin';

        $query = "INSERT INTO user(noID, namaLengkap, telp, namaUser, sandi, email, level) VALUES(:noID, :namaLengkap, :telp, :namaUser, :sandi, :email, :level)";
        $this->db->query($query);
        $this->db->bind('noID', $noID);
        $this->db->bind('namaLengkap', $namaLengkap);
        $this->db->bind('telp', $telp);
        $this->db->bind('namaUser', $namaUser);
        $this->db->bind('sandi', $sandi);
        $this->db->bind('email', $email);
        $this->db->bind('level', $level);
        $this->db->execute();

        return 'ok';
    }

    public function cekAdmin($data)
    {
        $namaUser = $data['namaUser'];
        $sandi = hash('sha256',$data['sandi']);

        $query = "SELECT * FROM user WHERE namaUser = :namaUser AND sandi = :sandi";

        $this->db->query($query);
        $this->db->bind('namaUser', $namaUser);
        $this->db->bind('sandi', $sandi);

        return $this->db->singel();
    }
    
        
}