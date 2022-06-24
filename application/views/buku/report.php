<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-1000">ABSENSI PUSTAKA</h1>
                                    <h1 class="h4 text-gray-1000">MAN 1 Kepulauan Meranti</h1>
                                </div>
                               
                                
                                <div class="row">
                                <!-- dalam col -->  
                                <div class="col-lg" >
                                    
                                    <table class="table table-hover">
                                    <thead>
                                        <tr >
                                        <th  scope="row">No</th>
                                        <th width="25%" scope="col">Judul Buku</th>
                                        <th scope="col">Penulis</th>
                                        <th scope="col">Penerbit</th>
                                        <th scope="col">Tempat Terbit</th>
                                        <th width="25%" scope="col">Tahun Terbit</th>
                                        <th scope="col">Ed/Cat</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Bahasa</th>
                                        <th scope="col">ISBN/ISSN</th>
                                        <th scope="col">Sumber</th>
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
                                            <td><?= $sm['nm_kelas']; ?></td>
                                            <td><?= $sm['nm_kelas']; ?></td>
                                            <td><?= $sm['nm_kelas']; ?></td>
                                            <td><?= $sm['nm_kelas']; ?></td>
                                            <td><?= $sm['nm_kelas']; ?></td>
                                            <td><?= $sm['nm_kelas']; ?></td>
                                            <td><?= $sm['nm_kelas']; ?></td>
                                            <td><?= $sm['nm_kelas']; ?></td>
                                        </tr>
                                        <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <!-- <hr> -->  
                              
                               
                                <!-- <hr> -->  
                                </div>               





                                </div> 
                                </div> 
                            </div>
                        </div>
                    </div>
            
        
        </div> 
    </div>

</div> 
