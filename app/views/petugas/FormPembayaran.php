<section class="container-fluid">
    <div class="row justify-content-center p-5">
        <?php
        require_once "../app/views/partials/petugas/SideBar.php"
        ?>

        <div class="col-9 ml-3">
            <div class="row ">
                <h2 class="mt-4 ">Detail siswa</h2>
                <?php 
                    if(Flasher::exits()){
                        $msg = Flasher::getFlasher()['message'];
                        echo "<h4 class='text-success'>{$msg}</h4>";
                    }
                ?>
                <div class="col-5 ">
                    <div class="mt-3">
                        <label>Nama lengkap</label>
                        <input type="text" disabled class="form-control" value="<?= $datas['siswaSingle']['nama_lengkap'] ?>">
                    </div>
                    <div class="mt-3">
                        <label>NISN</label>
                        <input type="text" disabled class="form-control" value="<?= $datas['siswaSingle']['NISN'] ?>">
                    </div>
                    <div class="mt-3">
                        <label>Kelas</label>
                        <input type="text" disabled class="form-control" value="<?= $datas['siswaSingle']['kelas'] ?>">
                    </div>


                </div>
                <div class="col-5">
                    <div class="mt-3">
                        <label>NIS</label>
                        <input type="text" disabled class="form-control" value="<?= $datas['siswaSingle']['NIS'] ?>">
                    </div>
                    <div class="mt-3">
                        <label>Jenis kelamin</label>
                        <input type="text" disabled class="form-control" value="<?= setGender($datas['siswaSingle']['jenis_kelamin']) ?>">
                    </div>
                    <div class="mt-3">
                        <label>Jurusan</label>
                        <input type="text" disabled class="form-control" value="<?= $datas['siswaSingle']['jurusan'] ?>">
                    </div>

                </div>

            </div>

            <div class="mt-4">
                <h1>Pembayaran <?= $datas['year']?></h1>
                

                <form action="<?= url("petugas/bayar/{$datas['siswaSingle']['id']}/{$datas['year']}") ?>" method="POST">
                    <div class="row">

                    
                    <select class="form-control col-2 mx-1 ml-2" name="bulan">
                    <?php
                        $siswaMonth = $datas['siswa_paid'] ;
                        $months = getMonths();        
                        foreach($months as $month){
                            $paid = false;
                            foreach($siswaMonth as $siswa){
                            if($month['id'] == $siswa['bulan']) $paid = true;
                        }
                    
                        if(!$paid) echo "<option value='{$month['id']}'> {$month['bulan']}</option>";
                        if($paid) echo "<option value='{$month['id']} ' disabled class='bg-success text-white'> {$month['bulan']}</option>";
                    
                    }
                ?>
                    </select>
                    <select class="form-control col-2" name="year" onchange="location = this.value">
                    <?php
                        $years = getCurrentYearAndNextYear();    
                        foreach($years as $year){
                            $url =  url('petugas/pembayaran/' . $year);  
                            if($datas['year'] == $year) {
                                echo "
                                <option value='{$year}' selected>
                                    {$year}
                                </option>

                            ";
                            }else{
                                echo "
                                <option value='{$year}'>
                                    {$year}
                                </option>

                            ";
                            }

                        }
                  
                    
                    
                ?>
                    </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 ">Bayar</button>
                </form>

                
            </div>
        </div>

        
    </div>


</section>


<?php
    if(Flasher::exits()) Flasher::destroyFlasher();

?>
