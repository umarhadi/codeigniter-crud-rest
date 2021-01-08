<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Penduduk extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //GET
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $penduduk = $this->db->get('penduduk')->result();
        } else {
            $this->db->where('id', $id);
            $penduduk = $this->db->get('penduduk')->result();
        }
        echo json_encode(array('penduduk'=>$penduduk));		
    }

    //POST
	function index_post() {
        $data = array(
                    'id' => $this->post('id'),
                    'nama' => $this->post('nama'),
                    'alamat' => $this->post('alamat'),
                    'tgl_lahir' => $this->post('tgl_lahir'),
                    'telp' => $this->post('telp'),
                    'email' => $this->post('email')
                );
        $insert = $this->db->insert('penduduk', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    //PUT
	function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id' => $this->put('id'),
                    'nama' => $this->put('nama'),                    
                    'alamat' => $this->put('alamat'),
                    'tgl_lahir' => $this->put('tgl_lahir'),
                    'telp' => $this->put('telp'),
                    'email' => $this->put('email')
                );
        $this->db->where('id', $id);
        $update = $this->db->update('penduduk', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //DELETE
	function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('penduduk');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>