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

            <?= $this->session->flashdata('message'); ?>

            <a href="<?= base_url('anggota/addabsen/')?>" class="btn btn-primary mb-3" >
            <i class="fas fa-plus"></i>   
            Tambah Data</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nomor Anggota</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($siswa as $sm) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $sm['no_anggota']; ?></td>
                        <td><?= $sm['nm_siswa']; ?></td>
                        <td><?= $sm['nisn']; ?></td>
                        <td><?= $sm['nm_kelas']; ?></td>
                        <td><?= $sm['alamat']; ?></td>

                        <td>
                            <a href="<?= base_url('anggota/editBuku/').$sm['id_siswa'];?>" class="badge badge-success">edit</a>
                            <a href="<?= base_url('anggota/HapusBuku/').$sm['id_siswa'];?>" class="badge badge-danger">delete</a>
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
