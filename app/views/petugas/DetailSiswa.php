<section class="container-fluid">
    <div class="row justify-content-center">
        <?php 
            require_once "../app/views/partials/petugas/SideBar.php"
        ?>
         <div class="col-9 p-5 ml-3"> 
             
             <div class="row ">
                 <h2 class="mt-4 ">Detail siswa</h2>
                 <div class="col-5 ">
                    <div class="mt-3">
                        <label>Nama lengkap</label>
                        <input type="text" disabled class="form-control" value="<?= $datas['siswaSingle']['nama_lengkap']?>">
                    </div>
                    <div class="mt-3">
                        <label>NISN</label>
                        <input type="text" disabled class="form-control" value="<?= $datas['siswaSingle']['NISN']?>">
                    </div>
                    <div class="mt-3">
                        <label>Kelas</label>
                        <input type="text" disabled class="form-control" value="<?= $datas['siswaSingle']['kelas']?>">
                    </div>
                    
                 
                </div>
                <div class="col-5">
                    <div class="mt-3">
                        <label>NIS</label>
                        <input type="text" disabled class="form-control" value="<?= $datas['siswaSingle']['NIS']?>">
                    </div>
                    <div class="mt-3">
                        <label>Jenis kelamin</label>
                        <input type="text" disabled class="form-control" value="<?= setGender($datas['siswaSingle']['jenis_kelamin']) ?>">
                    </div>
                    <div class="mt-3">
                        <label>Jurusan</label>
                        <input type="text" disabled class="form-control" value="<?= $datas['siswaSingle']['jurusan']?>">
                    </div>
                    
                </div>

            </div>

            <div class="row">
                <h2 class="mt-4 ">Bulan</h2>
               <?php
               $siswaMonth = $datas['siswa_paid'] ;
               $months = getMonths();        
               $year = getCurrentYearAndNextYear()[0];
                foreach($months as $month){
                    $paid = false;
                    foreach($siswaMonth as $siswa){
                        if($month['id'] == $siswa['bulan']) $paid = true;

                       
                    }
                    if($paid) {
                        
                        echo "<div class='col-2 bg-success text-white p-3 rounded mx-2 my-2 text-decoration-none'> 
                            <h4>{$month['bulan']}</h4>
                        
                        </div>";
                    }else{
                        echo "
                        <div  class='col-2 bg-danger text-white p-3 rounded mx-2 my-2 text-decoration-none'> 
                            <h4>{$month['bulan']}</h4>
                        
                        </div>";
                    }
                }
               ?>
            </div>
            <a class="btn btn-primary  mt-4" role="button"  href="<?= url("petugas/pembayaran/{$datas['siswaSingle']['id']}/{$year}") ?>">Mulai bayar</a>
        </div>
    </div>

   

</section>