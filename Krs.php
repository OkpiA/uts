<?php
Class Krs extends CI_Controller{
    
    var $API ="";
    
    function __construct() {
        parent::__construct();
        $this->API="http://myakademik.xyz/rest_server/index.php";
    }
    
    // menampilkan data krs
    function index(){
        $data['krs'] = json_decode($this->curl->simple_get($this->API.'/krs'));
        $this->load->view('krs/list',$data);
    }
    
    // insert data krs
    function create(){
        if(isset($_POST['submit'])){
            $data = array(
                'nim'       =>  $this->input->post('nim'),
                'nama'      =>  $this->input->post('nama'),
                'jumlah'    =>  $this->input->post('jumlah'));
            $insert =  $this->curl->simple_post($this->API.'/krs', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($insert)
            {
                $this->session->set_flashdata('hasil','Insert Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Insert Data Gagal');
            }
            redirect('krs');
        }else{
            $data['jurusan'] = json_decode($this->curl->simple_get($this->API.'/jurusan'));
            $this->load->view('krs/create',$data);
        }
    }
    
    // edit data krs
    function edit(){
        if(isset($_POST['submit'])){
            $data = array(
                'nim'       =>  $this->input->post('nim'),
                'nama'      =>  $this->input->post('nama'),
                'jumlah'    =>  $this->input->post('jumlah'));
            $update =  $this->curl->simple_put($this->API.'/krs', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($update)
            {
                $this->session->set_flashdata('hasil','Update Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Update Data Gagal');
            }
            redirect('krs');
        }else{
            $data['jurusan'] = json_decode($this->curl->simple_get($this->API.'/jurusan'));
            $params = array('nim'=>  $this->uri->segment(3));
            $data['krs'] = json_decode($this->curl->simple_get($this->API.'/krs',$params));
            $this->load->view('krs/edit',$data);
        }
    }
    
    // delete data krs
    function delete($nim){
        if(empty($nim)){
            redirect('krs');
        }else{
            $delete =  $this->curl->simple_delete($this->API.'/krs', array('nim'=>$nim), array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('hasil','Delete Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Delete Data Gagal');
            }
            redirect('krs');
        }
    }
}