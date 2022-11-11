<?php

class Master extends Controller{
    public function index()
    {
        $this->view('winbro/index');
    }
    
    public function admin($hal="beranda", $id="")
    {
        $data['halaman'] = $hal;
        $data['id']=$id;
        $this->view('winbro/masterAdmin', $data);
    }
    
    
}