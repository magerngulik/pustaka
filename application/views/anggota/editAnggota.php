<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-8">
        <form action="" method="post">
            <input type="hidden" name="id" id="id" value="<?= $siswa['id_siswa']; ?>">
            <?= $this->session->flashdata('name'); ?>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Nama Siswa</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nm_siswa" name="nm_siswa" value="<?= $siswa['nm_siswa']; ?>" >
                    <?= form_error('nm_siswa', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Nama Siswa</label>
            <div class="col-sm-10">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($kelas as $m) : ?>
                            <option value="<?= $m['id_kelas']; ?>"><?= $m['nm_kelas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('menu_id', '<small class="text-danger pl-3">', '</small>'); ?>    
                        </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Nisn</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nisn" name="nisn" value="<?= $siswa['nisn']; ?>">
                    <?= form_error('nisn', '<small class="text-danger pl-3">', '</small>'); ?>           
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $siswa['alamat']; ?>" >                                  
                    <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>           
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" name=editBuku class="btn btn-primary">Edit</button>
                </div>
            </div>

            </form>


        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 