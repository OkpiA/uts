<?php
Class Matakuliah extends CI_Controller{
    
    var $API ="";
    
    function __construct() {
        parent::__construct();
        $this->API="http://myakademik.xyz/rest_server/index.php";
    }
    
    // menampilkan data matakuliah
    function index(){
        $data['matakuliah'] = json_decode($this->curl->simple_get($this->API.'/matakuliah'));
        $this->load->view('matakuliah/list',$data);
    }
    
    // insert data matakuliah
    function create(){
        if(isset($_POST['submit'])){
            $data = array(
                'kode'       =>  $this->input->post('kode'),
                'matakuliah'      =>  $this->input->post('matakuliah'));
            $insert =  $this->curl->simple_post($this->API.'/matakuliah', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($insert)
            {
                $this->session->set_flashdata('hasil','Insert Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Insert Data Gagal');
            }
            redirect('matakuliah');
        }else{
            $data['jurusan'] = json_decode($this->curl->simple_get($this->API.'/jurusan'));
            $this->load->view('matakuliah/create',$data);
        }
    }
    
    // edit data matakuliah
    function edit(){
        if(isset($_POST['submit'])){
            $data = array(
                'kode'       =>  $this->input->post('kode'),
                'matakuliah'      =>  $this->input->post('matakuliah'));
            $update =  $this->curl->simple_put($this->API.'/matakuliah', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($update)
            {
                $this->session->set_flashdata('hasil','Update Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Update Data Gagal');
            }
            redirect('matakuliah');
        }else{
            $data['jurusan'] = json_decode($this->curl->simple_get($this->API.'/jurusan'));
            $params = array('kode'=>  $this->uri->segment(3));
            $data['matakuliah'] = json_decode($this->curl->simple_get($this->API.'/matakuliah',$params));
            $this->load->view('matakuliah/edit',$data);
        }
    }
    
    // delete data matakuliah
    function delete($kode){
        if(empty($kode)){
            redirect('matakuliah');
        }else{
            $delete =  $this->curl->simple_delete($this->API.'/matakuliah', array('kode'=>$kode), array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('hasil','Delete Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Delete Data Gagal');
            }
            redirect('matakuliah');
        }
    }
}