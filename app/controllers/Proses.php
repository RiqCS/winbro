<?php

class Proses extends Controller{
    public function cekLoginAdmin()
    {
        $cek = $this->model('Login_model')->cekAdmin($_POST);
        if($cek==NULL){
            $_SESSION['noID']="";
            $_SESSION['namaLengkap']="";
            $_SESSION['level']="";
            echo "err";
        } else {
            $_SESSION['noID']=$cek['noID'];
            $_SESSION['namaLengkap']=$cek['namaLengkap'];
            $_SESSION['level']=$cek['level'];
            echo "ok";
        }

    }
    
    
}