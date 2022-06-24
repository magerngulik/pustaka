<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>

            
                <div class="row">
                    <div class="col">

                        <a href="<?= base_url('buku/pinjaman/')?>" class="btn btn-success mb-4 " >
                            <i class="fa fa-book"></i>
                        Pinjaman</a>
                        <a href="<?= base_url('buku/pengembalian/')?>" class="btn btn-danger mb-4" >
                        <i class="fa fa-book"></i>   
                        Pengembalian</a>
                        <a href="<?= base_url('buku/exelA/')?>" class="btn btn-warning mb-4" >
                        <i class="fa fa-file"></i>   
                            Cetak PDF</a>
                    </div>
                </div>


            <?= $this->session->flashdata('message'); ?>
            <a href="<?= base_url('buku/pDataSiswa/')?>" class="btn btn-primary mb-3" >
            <i class="fas fa-plus"></i>   
            Tambah Data</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Kelas/Kategori</th>
                        <th scope="col">Jumlah Pinjam</th>
                        <th scope="col">Tanggal Pinjaman</th>
                        <th scope="col">Status Pinjaman</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($pinjam as $sm) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $sm['nm_siswa']; ?></td>
                        <td><?= $sm['jd_buku']; ?></td>
                        <td><?= $sm['nm_kelas']; ?></td>               
                        <td><?= $sm['jml_pinjaman']; ?></td>
                        <td><?= date('d F Y', strtotime($sm['date_create']));  ?></td>
                        
                        <?php if ($sm['status_pinjaman']==0) : ?>
                        <td>
                            <span class="badge badge-danger">Belum Kembali</span>
                        </td>
                        <?php endif; ?>

                        <?php if ($sm['status_pinjaman']==1) : ?>
                        <td>
                            <span class="badge badge-success">Sudah Kembali</span>
                        </td>
                        <?php endif; ?>                   
                        <td>
                            <a href="<?= base_url('buku/lihatPinjam/').$sm['id_buku'];?>" class="btn btn-info" role="button" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="<?= base_url('buku/ubahBuku/').$sm['id_buku'];?>" class="btn btn-danger" role="button" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash-alt"></i></a>
                            <?php if ($sm['status_pinjaman']==0) : ?>  
                            <a href="<?= base_url('buku/IBKembali/').$sm['no_peminjaman'];?>" class="btn btn-warning" role="button" data-toggle="tooltip" title="Detail"><i class="fa fa-share"></i></a>          
                            <?php endif; ?> 
                       
                       
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>


        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->

<!-- Modal -->
