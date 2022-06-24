<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use Dompdf\Dompdf;
class Buku extends CI_Controller
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
        $data['title'] = 'Data Buku';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['siswa'] = $this->menu->getAnggota();
        $data['kelas'] = $this->menu->getKelas();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['dataA'] = $this->menu->getNoAnggota();
        $data['jumlah'] = $this->menu->getKelas();
        $data['buku'] = $this->db->get('buku_induk')->result_array();

        $keyword= $this->input->post('keyword');

        if ($keyword) {
            $data['buku'] = $this->menu->cariBuku();
        }

        //generate code
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('buku/index', $data);
            $this->load->view('templates/footer');
    }

    public function testPrint(){
        $this->load->model('Menu_model', 'menu');
        $data['title'] = 'Data Buku';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['siswa'] = $this->menu->getAnggota();
        $data['kelas'] = $this->menu->getKelas();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['dataA'] = $this->menu->getNoAnggota();
        $data['jumlah'] = $this->menu->getKelas();
        $data['buku'] = $this->db->get('buku_induk')->result_array();
        $html = $this->load->view('buku/Laporan', $data, TRUE);

        $dompdf = new Dompdf();
        $dompdf->add_info('Title', 'Informasi Buku');
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        $dompdf->stream();

    }






    public function tambahBuku(){
        $this->load->model('Menu_model', 'menu');
        $data['title'] = 'Tambah Data Buku';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['siswa'] = $this->menu->getAnggota();
        $data['kelas'] = $this->menu->getKelas();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['dataA'] = $this->menu->getNoAnggota();
        $data['jumlah'] = $this->menu->getKelas();
        $data['buku'] = $this->db->get('buku_induk')->result_array();
        $data['tahun']= ['1990','1991','1992','1993','1994','1995','1996','1997','1998','1999','2000','2001','2002','2003','2004','2005','2006','2007','2008','2009','2010','2011','2012','2013','2014','2015','2016','2017','2018','2019','2020','2021','2022','2023','2024','2025','2026','2027','2028','2029','2030'];

        $this->form_validation->set_rules('jd_buku', 'Judul Buku Lengkap', 'required');
        $this->form_validation->set_rules('kode', 'Kode Buku', 'required');
        $this->form_validation->set_rules('penulis', 'Penulis', 'required');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required');
        $this->form_validation->set_rules('ed_cat', 'Edisi/Kategori', 'required');
        $this->form_validation->set_rules('jml', 'Jumlah Buku', 'required');
        $this->form_validation->set_rules('bhs', 'Bahasa', 'required');
        $this->form_validation->set_rules('isbn', 'ISBN', 'required');
        $this->form_validation->set_rules('sumber', 'Sumber', 'required');
        $this->form_validation->set_rules('odc', 'DDC', 'required');

        if ($this->form_validation->run() == false) {
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('buku/tambah_buku', $data);
        $this->load->view('templates/footer');
        }
        else {
            # code...
            $tabel ="buku_induk";
            $field ="no_induk";
            $lastcode = $this->menu->getMax($tabel,$field);
            $noUrut =(int) substr($lastcode, 1,3);
            $kode=  $this->input->post('tahun');
            $kdtgl = (int) substr($kode,-2,2);
            $noUrut++;
            $str= $this->input->post('kode');
            $newKode = sprintf('%04s',$noUrut)."/".$str."/".$kdtgl;

            $data = [
                'no_induk' => $newKode,
                'tgl_masuk' => date("Y/m/d"), 
                'jd_buku' => $this->input->post('jd_buku'),
                'penulis' => $this->input->post('penulis'),
                'penerbit' => $this->input->post('penerbit'),
                'tmp_terbit' => $this->input->post('tmp_terbit'),
                'th_terbit' => $this->input->post('tahun'),
                'ed_cat' => $this->input->post('ed_cat'),
                'jml' => $this->input->post('jml'),
                'bhs' => $this->input->post('bhs'),
                'isbn' => $this->input->post('isbn'),
                'sumber' => $this->input->post('sumber'),
                'odc' => $this->input->post('odc'),
                'jml_pinjam' => $this->input->post('jml')
            ];
            $this->db->insert('buku_induk', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Buku Berhasil Di Tambahkan!</div>');
            redirect('buku/');
        }
    }

    public function hapusdata($id){
        $tabelname = "buku_induk";
        $tabelId = "id_buku";
        $this->load->model('Menu_Model','menu');
        $this->menu->deleteData($id,$tabelname,$tabelId);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data berhasil di hapus!</div>');
        redirect('buku/');
    }
    
    public function ubahBuku($id){
        $this->load->model('Menu_model', 'menu');
        $data['title'] = 'Edit Buku';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['kelas'] = $this->db->get('buku_kelas')->result_array();
        $data['kelasS'] = $this->menu->getKelasSingle($id);
        $namaTabel ="buku_induk";
        $idtabel ="no_induk";
        $data['buku'] = $this->menu->getTabelSingle($id,$namaTabel,$id);
        $data['tahun']= ['1990','1991','1992','1993','1994','1995','1996','1997','1998','1999','2000','2001','2002','2003','2004','2005','2006','2007','2008','2009','2010','2011','2012','2013','2014','2015','2016','2017','2018','2019','2020','2021','2022','2023','2024','2025','2026','2027','2028','2029','2030'];
        $this->form_validation->set_rules('jd_buku', 'Judul Buku Lengkap', 'required');
        $this->form_validation->set_rules('kode', 'Kode Buku', 'required');
        $this->form_validation->set_rules('penulis', 'Penulis', 'required');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required');
        $this->form_validation->set_rules('ed_cat', 'Edisi/Kategori', 'required');
        $this->form_validation->set_rules('jml', 'Jumlah Buku', 'required');
        $this->form_validation->set_rules('bhs', 'Bahasa', 'required');
        $this->form_validation->set_rules('isbn', 'ISBN', 'required');
        $this->form_validation->set_rules('sumber', 'Sumber', 'required');
        $this->form_validation->set_rules('odc', 'DDC', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('buku/edit_buku', $data);
            $this->load->view('templates/footer');
        } else {

            $kode=  $this->input->post('tahun');
            $kdtgl = (int) substr($kode,-2,2);
            $Ukode =  $this->input->post('kdepan')."/".$this->input->post('kode')."/".$kdtgl;

            $data = [
                'no_induk' => $Ukode,
                'jd_buku' => $this->input->post('jd_buku'),
                'penulis' => $this->input->post('penulis'),
                'penerbit' => $this->input->post('penerbit'),
                'tmp_terbit' => $this->input->post('tmp_terbit'),
                'th_terbit' => $this->input->post('tahun'),
                'ed_cat' => $this->input->post('ed_cat'),
                'jml' => $this->input->post('jml'),
                'bhs' => $this->input->post('bhs'),
                'isbn' => $this->input->post('isbn'),
                'sumber' => $this->input->post('sumber'),
                'odc' => $this->input->post('odc')
            ];

            $this->db->where('id_buku', $this->input->post('id'));
            $this->db->update('buku_induk',$data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Siswa Berhasil Di Ubah!</div>');
            redirect('buku');
        }
    }

    public function lihatdata($id){

        $this->load->model('Menu_model', 'menu');
        $data['title'] = 'Detail Buku';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['kelas'] = $this->db->get('buku_kelas')->result_array();
        $data['kelasS'] = $this->menu->getKelasSingle($id);
        $namaTabel ="buku_induk";
        $idtabel ="no_induk";
        $data['buku'] = $this->menu->getTabelSingle($id,$namaTabel,$id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('buku/lihat_buku', $data);
        $this->load->view('templates/footer');
    }

    //pinjaman menu sessison

    public function pinjaman(){
        $this->load->model('Menu_model', 'menu');
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['title'] = 'Data Pinjaman';
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['pinjam'] = $this->menu->getTabelEx(1);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('buku/pinjaman', $data);
        $this->load->view('templates/footer');
    }

    public function MpdfBuku(){
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML('<h1>Hello world!</h1>');
        $mpdf->Output();
    }

    //get data siswa dari list tabel siswa
    public function getidsiswa($id){
        $data = [
            'id_siswa' => $id
        ];
        $this->session->set_userdata($data);
        redirect('buku/pdatabuku/');
    }

    public function getidbuku($id){
        $data = [
            'id_buku' => $id
        ];
        $this->session->set_userdata($data);
        redirect('buku/tambahpinjam/');
    }
    
    public function pDataSiswa(){
        $this->load->model('Menu_model', 'menu');
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['title'] = 'Data Peminjaman Siswa';
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['pinjam'] = $this->menu->getPinjam();
        $data['siswa'] = $this->menu->getAnggota();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('buku/getsiswa', $data);
        $this->load->view('templates/footer');
    }

    //p berarti pinjaman
    public function pdatabuku(){
        $this->load->model('Menu_model', 'menu');
        $data['title'] = 'Data Buku';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['siswa'] = $this->menu->getAnggota();
        $data['kelas'] = $this->menu->getKelas();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['dataA'] = $this->menu->getNoAnggota();
        $data['jumlah'] = $this->menu->getKelas();
        $data['buku'] = $this->db->get('buku_induk')->result_array();
        $keyword= $this->input->post('keyword');

        $idsiswa=  $this->session->userdata('id_siswa');

        if ($keyword) {
            $data['buku'] = $this->menu->cariBuku();
        }
        //generate code
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('buku/getbuku', $data);
            $this->load->view('templates/footer');
    }

    public function tambahpinjam(){
        $this->load->model('Menu_model', 'menu');
        $data['title'] = 'Detail Data Pinjaman';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['subMenu'] = $this->menu->getSubMenu();
        $idbuku =  $this->session->userdata('id_buku');
        $idsiswa=  $this->session->userdata('id_siswa');
        $data['idbuku'] = $this->menu->getTabelSingle($idbuku,'buku_induk','id_buku');
        $data['idsiswa'] = $this->menu->getTabelSingle1($idsiswa,'buku_siswa','id_siswa');
        $data['katpinjam']= ['Guru','Siswa','Kelas'];
        $this->form_validation->set_rules('jenis', 'jenis pinjaman', 'required');
        $this->form_validation->set_rules('JB_pinjam', 'Jumlah Pinjam', 'required');
        $this->form_validation->set_rules('tglkbl', 'Tangal Kembali', 'required');
        $jmlTersedia =$this->input->post('jml_pinjam');
        $jmlPinjam = $this->input->post('JB_pinjam');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('buku/tambah_pinjam', $data);
            $this->load->view('templates/footer');
        }else {
            
            $t= $this->input->post('tglkbl');	
            $s=substr($t,0,2);
            $s1=substr($t,3,2);
            $s2=substr($t,6,6);
            $s3=$s2."/".$s.'/'.$s1;
        
            if ($jmlTersedia <  $jmlPinjam) {
                # code...
                $this->session->set_flashdata('pinjam', '<small class="text-danger pl-3">Data buku yang akan di pinjam tidak mencukupi</small>');
                redirect('buku/tambahpinjam');
            }else {

                $FJmlBuku = $jmlTersedia -  $jmlPinjam;
                $data = [
                    'id_buku' =>  $this->input->post('idbuku'),
                    'id_siswa' => $this->input->post('id_siswa'),
                    'jml_pinjaman' => $this->input->post('JB_pinjam'),
                    'date_create' => date("Y/m/d"), 
                    'status_pinjaman' => 0,
                    'jns_pinjam' => $this->input->post('jenis'),
                    'tgl_kembali' =>  $s3
                ];
                $this->db->insert('buku_pinjam', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pinjaman Berhasil Di Tambahkan!</div>');
                $data1 = [
                    'jml_pinjam' =>  $FJmlBuku
                ];
                $this->db->where('id_buku', $this->input->post('idbuku'));
                $this->db->update('buku_induk',$data1);
                redirect('buku/pinjaman');
            }
        }
    }
    
    public function pengembalian(){
        $this->load->model('Menu_model', 'menu');
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['title'] = 'Data Pengembalian';
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['pinjam'] = $this->menu->getTabelEx(0);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('buku/pengembalian', $data);
        $this->load->view('templates/footer');
    }



    public function IBKembali($id){

        $this->load->model('Menu_model', 'menu');
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['title'] = 'Data Pengembalian';
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['pinjam'] = $this->menu->getPinjam();
        $namaTabel ="buku_pinjam";
        $idtabel ="no_peminjaman";
        $data['datapinjam'] = $this->menu->getTabelSingle2($id,$idtabel);
        $jmlPjm = $this->input->post('jmlPjm');
        $jmlKem = $this->input->post('jmlKem');
        $this->form_validation->set_rules('jmlKem', 'Jumlah Kembali', 'required');
    
        if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('buku/input_kembali', $data);
        $this->load->view('templates/footer');
        }else {
            if ($jmlKem >  $jmlPjm) {
                # code...
                $this->session->set_flashdata('data', '<small class="text-danger pl-3">Data buku yang dikembalikan tidak cocok</small>');
                redirect('buku/IBKembali/'.$id);
            }else {
                $waktuakhir = date();
                $wakawal= $this->input->post('tgl');
                $aAkhir= strtotime($waktuakhir);
                $aAwal= strtotime($wakawal);
                if ($aAkhir < $aAwal) {
                    $SLS=((strtotime($wakawal)-strtotime($waktuakhir))/(60*60*24));   
                }
                $SLS=0;
            
                $data = [
                    'no_pinjaman' => $this->input->post('id'),
                    'tgl_kembal' => date("Y/m/d"), 
                    'terlambat' =>  $SLS,
                    'jml_kembali' => $this->input->post('jmlKem'),
                ];
                $this->db->insert('buku_kembali', $data);
                $data1 = [
                    'status_pinjaman' =>  1
                ];
                $this->db->where('no_peminjaman', $this->input->post('id'));
                $this->db->update('buku_pinjam',$data1);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pengembalian Berhasil Di Tambahkan!</div>');
                redirect('buku/pengembalian');
            }
        }   
    }


    public function exelA(){

        $this->load->model('Menu_model', 'menu');
        $data['pinjam'] = $this->menu->getTabelEx(1);
        require(APPPATH.'PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH.'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
        $object = new PHPExcel();
        $object->getProperties()->setCreator("Admin Pustaka Man Selatpanjang");
        $object->getProperties()->setLastModifiedBy("Fadli");
        $object->getProperties()->setTitle("Daftar Pinjaman");
        $object->setActiveSheetIndex();
        $object->setActiveSheet()->setCellValue('A1','NO');
        $object->setActiveSheet()->setCellValue('B1','Nama Siswa');
        $object->setActiveSheet()->setCellValue('C1','Judul Buku');
        $object->setActiveSheet()->setCellValue('D1','Kelas/Kategori');
        $object->setActiveSheet()->setCellValue('E1','Jumlah Pinjam');
        $object->setActiveSheet()->setCellValue('F1','Status Pinjaman');
        
        $baris= 2;
        $no =1;
        foreach ($data['pinjam']as $pjm) {
            # code...
            $object->setActiveSheet()->setCellValue('A'.$baris, $no++);
            $object->setActiveSheet()->setCellValue('B'.$baris,$pjm->nm_siswa);
            $object->setActiveSheet()->setCellValue('C'.$baris,$pjm->jd_buku);
            $object->setActiveSheet()->setCellValue('D'.$baris,$pjm->nm_kelas);
            $object->setActiveSheet()->setCellValue('E'.$baris,$pjm->jml_pinjaman);
            $object->setActiveSheet()->setCellValue('F'.$baris,$pjm->status_pinjaman);
            $baris++;
        }

        $filename= "Data Pinjaman".'.xlsx';
        $object->getActiveSheet()->setTitle("Data Mahasiswa");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheed');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createwriter($object,'Excel2007');
        $writer->save('php://output');

        exit;
    }

    public function riwayatpinjam($id){

        $this->load->model('Menu_model', 'menu');
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['title'] = 'Riwayat Peminjaman';
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['nmsiswa'] = $this->menu->getSiswaById($id);
        $data['pinjam'] = $this->menu->getTabelEx(1);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('buku/riwayat_pinjam', $data);
        $this->load->view('templates/footer');
    }

    public function report1(){
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
          $this->load->view('buku/report', $data);
          $this->load->view('templates/footer');
        


    }
}    