<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        //get model
        $this->load->model('Menu_model', 'menu');

        $data['title'] = 'Data Anggota';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['siswa'] = $this->menu->getAnggota();
        $data['kelas'] = $this->menu->getKelas();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['dataA'] = $this->menu->getNoAnggota();
        $data['jumlah'] = $this->menu->getKelas();
        //input kode anggota
        $tabel ="buku_siswa";
        $field ="no_anggota";
        $lastcode = $this->menu->getMax($tabel,$field);
        $noUrut =(int) substr($lastcode,-3,3);
        $noUrut++;
        $str="P/";
        $newKode = $str.sprintf('%03s',$noUrut);
       // var_dump($newKode);
        //generate code
        
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('menu_id','menu_id', 'required');
        $this->form_validation->set_rules('nisn', 'NISN', 'required');
        $this->form_validation->set_rules('Alamat', 'Alamat Lengkap', 'required');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('anggota/index', $data);
            $this->load->view('templates/footer');
        } else {

            $data = [
                'no_anggota' => $newKode,
                'nm_siswa' => $this->input->post('nama'),
                'nisn' => $this->input->post('nisn'),
                'id_kelas' => $this->input->post('menu_id'),
                'alamat' => $this->input->post('Alamat'),
                'tanggal_terbit' => date("Y/m/d") 
            ];
            $this->db->insert('buku_siswa', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Siswa Berhasil Di Tambahkan!</div>');
            redirect('anggota/');
        }
    }



    public function hapusBuku($id){
        $this->load->model('Menu_model', 'menu');
        $this->menu->HapusBuku($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data berhasil di hapus!</div>');
        redirect('Anggota');
    }

    public function kelas(){
        $this->load->model('Menu_model', 'menu');
        $data['title'] = 'Data Kelas';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['kelas'] = $this->db->get('buku_kelas')->result_array();


        $this->form_validation->set_rules('nama', 'Nama Kelas', 'required');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('anggota/kelas', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nm_kelas' => $this->input->post('nama'),
            ];
            $this->db->insert('buku_kelas', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Kelas Berhasil Di Tambahkan!</div>');
            redirect('anggota/kelas');
        }
    }
    

    public function hapusKelas($id){

        $this->load->model('Menu_model', 'menu');
        $this->menu->HapusKelas($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data berhasil di hapus!</div>');
        redirect('anggota/kelas');

    }



    public function editBuku($id){
        
        $this->load->model('Menu_model', 'menu');
        $data['title'] = 'Edit Anggota';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['kelas'] = $this->db->get('buku_kelas')->result_array();
        $data['siswa'] = $this->menu->getSiswaById($id);
                
        $this->form_validation->set_rules('nm_siswa', 'Nama siswa', 'required');
        $this->form_validation->set_rules('nisn', 'NISN', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('menu_id', 'kelas', 'required');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('anggota/editAnggota', $data);
            $this->load->view('templates/footer');
        } else {
        
            $this->menu->updateDataSiswa();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Siswa Berhasil Di Ubah!</div>');
            redirect('anggota/');

        }

    }

    public function editKelas($id){
        $this->load->model('Menu_model', 'menu');
        $data['title'] = 'Edit Kelas';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['kelas'] = $this->db->get('buku_kelas')->result_array();
        $data['kelasS'] = $this->menu->getKelasSingle($id);

        $this->form_validation->set_rules('nm_kelas', 'Nama Kelas', 'required');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('anggota/editKelas', $data);
            $this->load->view('templates/footer');
        }else {
            $this->menu->updateDataKelas();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Siswa Berhasil Di Ubah!</div>');
            redirect('anggota/kelas');
        }
    }

    public function absenSiswa(){
        $this->load->model('Menu_model', 'menu');
        $data['title'] = 'Data Absen';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['siswa'] = $this->menu->getAnggota();
        $data['kelas'] = $this->menu->getKelas();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['dataA'] = $this->menu->getNoAnggota();
        $data['jumlah'] = $this->menu->getKelas();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('anggota/absen', $data);
        $this->load->view('templates/footer');
    }


    public function addabsen(){
        //get model
        $this->load->model('Menu_model', 'menu');
        $data['title'] = 'Data Absen';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['siswa'] = $this->menu->getAnggota();
        $data['kelas'] = $this->menu->getKelas();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['dataA'] = $this->menu->getNoAnggota();
        $data['jumlah'] = $this->menu->getKelas();
        $this->load->view('templates/header', $data);
        $this->load->view('anggota/tambahabsen', $data);
        $this->load->view('templates/footer');
    }

 


}
