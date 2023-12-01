 <?php
    require '../functions.php';
    $keyword = $_GET["keyword"];
    $query = "SELECT * FROM mahasiswa WHERE 
            nama LIKE '%$keyword%' OR
            nrp LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'
            ";
    $mahasiswa = query($query);
    ?>

 <table class="table">
     <thead>
         <tr>
             <th scope="col">NO.</th>
             <th scope="col">Aksi</th>
             <th scope="col">Gambar</th>
             <th scope="col">NRP</th>
             <th scope="col">Nama</th>
             <th scope="col">Email</th>
             <th scope="col">Jurusan</th>
         </tr>
     </thead>
     <tbody>
         <?php $i = 1; ?>
         <?php foreach ($mahasiswa as $mhs) :
            ?>
             <tr>
                 <th scope="row"><?php echo $i; ?></th>
                 <td>
                     <button class=" btn btn-warning"><a class="text-decoration-none text-white" href="update.php?id=<?php echo $mhs["id"]; ?>">Update</a></button>
                     <button class="btn btn-danger"><a class="text-decoration-none text-white" href="delete.php?id=<?php echo $mhs["id"]; ?>" onclick="return confirm('Do you want to delete this data ?');">Delete</a></button>
                 </td>
                 <td><img src="img/<?php echo $mhs["gambar"]; ?>" width="80px"></td>
                 <td><?php echo $mhs["nrp"]; ?></td>
                 <td><?php echo $mhs["nama"]; ?></td>
                 <td><?php echo $mhs["email"]; ?></td>
                 <td><?php echo $mhs["jurusan"]; ?></td>

             </tr>
             <?php $i++; ?>
         <?php endforeach; ?>
     </tbody>
 </table>