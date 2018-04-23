<?php
 
require APPPATH . '/libraries/REST_Controller.php';
 
class matakuliah extends REST_Controller {
 
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
 
    // show data matakuliah
    function index_get() {
        $kode = $this->get('kode');
        if ($kode == '') {
            $matakuliah = $this->db->get('matakuliah')->result();
        } else {
            $this->db->where('kode', $kode);
            $matakuliah = $this->db->get('matakuliah')->result();
        }
        $this->response($matakuliah, 200);
    }
 
    // insert new data to matakuliah
    function index_post() {
        $data = array(
                    'kode'           => $this->post('kode'),
                    'matakuliah'          => $this->post('matakuliah'));
        $insert = $this->db->insert('matakuliah', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // update data matakuliah
    function index_put() {
        $kode = $this->put('kode');
        $data = array(
                    'kode'       => $this->put('kode'),
                    'matakuliah'      => $this->put('matakuliah'));
        $this->db->where('kode', $kode);
        $update = $this->db->update('matakuliah', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // delete matakuliah
    function index_delete() {
        $kode = $this->delete('kode');
        $this->db->where('kode', $kode);
        $delete = $this->db->delete('matakuliah');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
}