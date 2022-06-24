<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Perpustakaan</title>
</head>

<body>
    <h1 style="text-align:center">LAPORAN PERPUSTAKAAN</h1>
<style>
table.paleBlueRows {
  font-family: "Times New Roman", Times, serif;
  border: 0px solid #FFFFFF;
  background-color: #FFFFFF;
  width: 350px;
  height: 200px;
  text-align: center;
  border-collapse: collapse;
}
table.paleBlueRows td, table.paleBlueRows th {
  border: 1px solid #FFFFFF;
  padding: 3px 2px;
}
table.paleBlueRows tbody td {
  font-size: 13px;
}
table.paleBlueRows tr:nth-child(even) {
  background: #D0E4F5;
}
table.paleBlueRows thead {
  background: #0B6FA4;
  border-bottom: 5px solid #FFFFFF;
}
table.paleBlueRows thead th {
  font-size: 17px;
  font-weight: bold;
  color: #FFFFFF;
  text-align: center;
  border-left: 2px solid #FFFFFF;
}
table.paleBlueRows thead th:first-child {
  border-left: none;
}

table.paleBlueRows tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #333333;
  background: #D0E4F5;
  border-top: 3px solid #444444;
}
table.paleBlueRows tfoot td {
  font-size: 14px;
}
</style>
<table class="paleBlueRows">
<thead>
    <tr>
        <th>No</th>
        <th>Judul Buku</th>
        <th>Penerbit</th>
        <th>Jumlah</th>
        <th>Nomor Induk</th>
        <th>Tahun</th>
        <th>Bahasa</th>
        <th>Penerbit</th>
        <th>Edisi/Kategori</th>
        <th>ISBN</th>
        <th>ODC</th>
        <th>Sumber</th>        
    </tr>
</thead>
<tbody>
    <?php $i = 1; ?>

    <?php $i = 1; ?>
                    <?php foreach ($buku as $sm) : ?>
                    <tr> 
                        <th scope="row"><?= $i; ?></th>  
                        <td><?= $sm['jd_buku']; ?></td>
                        <td><?= $sm['penulis']; ?></td>
                        <td><?= $sm['penerbit']; ?></td>
                        <td><?= $sm['no_induk']; ?></td>
                        <td><?= $sm['tmp_terbit']; ?></td>
                        <td><?= $sm['th_terbit']; ?></td>
                        <td><?= $sm['ed_cat']; ?></td>
                        <td><?= $sm['jml']; ?></td>
                        <td><?= $sm['bhs']; ?></td>
                        <td><?= $sm['isbn']; ?></td>
                        <td><?= $sm['sumber']; ?></td>       
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
            
</tbody>
</table>

</body>
</html>