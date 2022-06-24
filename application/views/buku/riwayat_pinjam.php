<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-8">

        <div class="card border-dark mb-3" style="max-width: 50rem;">
        <div class="card-header font-weight-bold text-uppercase"><?=$nmsiswa['nm_siswa'] ?></div>
            <div class="card-body text-dart">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Buku</th>
                    <th scope="col">Tanggal Pinjaman</th>
                    <th scope="col">Jumlah Pinjaman</th>
                    <th scope="col">Status Pinjaman</th>
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
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
                </table>


                <div class="form-group row justify-content-end">
                <div class="col-sm-50">
                    
                    <a href="<?= base_url('buku/'); ?>" name=editBuku class="btn btn-secondary mt-5">Kembali</a>
                </div>
            </div>
            </div>
        </div>

            


        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 