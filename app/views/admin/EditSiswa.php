<section>
    <div class="row">
        <?php require_once "../app/views/partials/admin/SideBar.php";
        $id = $datas['siswaSingle']['id'];
        $kelas = ['X',"XI","XII"];
        ?>

        <div class="col mt-5 ml-3">

            <h3>Edit siswa</h3>
            <?php if(Flasher::exits() && Flasher::getFlasher()['action'] == 'update' && Flasher::getFlasher()['type'] == 'success'): ?>
                <h3 class="text-success"><?= Flasher::getFlasher()['message'] ?></h3>
            <?php endif; ?>
            <?php if(Flasher::exits() && Flasher::getFlasher()['action'] == 'update' && Flasher::getFlasher()['type'] == 'error'): ?>
                <h3 class="text-danger"><?= Flasher::getFlasher()['message'] ?></h3>
            <?php endif; ?>
            <form action="<?= url('siswa/editSiswa/' . $id) ?>" method="POST" class="row">
                <div class="col-5">
                    <div class="mt-3">
                        <label>Nama lengkap</label>
                        <input type="text" class="form-control" value="<?= $datas['siswaSingle']['nama_lengkap'] ?>" name="nama_lengkap">
                    </div>
                    <div class="mt-3">
                        <label>NISN</label>
                        <input type="text" class="form-control" value="<?= $datas['siswaSingle']['NISN'] ?>" name="NISN">
                    </div>
                    <div class="mt-3">
                        <label>Kelas</label>
                        <select name="kelas" class='form-control'>
                            <?php foreach($kelas as $item): ?>
                                <?php if($datas['siswaSingle']['kelas'] == $item): ?>
                                    <option selected value="<?= $item?>"><?= $item?> </option>    
                                <?php endif;?>
                                <?php if($datas['siswaSingle']['kelas'] != $item): ?>
                                    <option value="<?= $item?>"><?= $item?> </option>    
                                <?php endif;?>
                                
                            <?php endforeach; ?>
                        </select>
                        
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary " type="submit">Simpan perubahan</button>
                    </div>
                </div>
                <div class="col-5">
                    <div class="mt-3">
                        <label>NIS</label>
                        <input type="text" class="form-control" value="<?= $datas['siswaSingle']['NIS'] ?>" name="NIS">
                    </div>
                    <div class="mt-3">
                        <label>Jenis kelamin</label>
                        <div>
                            <?php
                            if ($datas['siswaSingle']['jenis_kelamin'] == "0") {
                                echo '<input checked class="mr-3" type="radio" id="laki-laki" name="jenis_kelamin" value="0">
                                    <label for="laki-laki">Laki-laki</label>';
                                echo '<input type="radio" id="perempuan" name="jenis_kelamin" value="1">
                                    <label for="perempuan">Perempuan</label>';
                            } else {
                                echo '<input   type="radio" id="laki-laki" name="jenis_kelamin" value="0">
                                    <label for="laki-laki">Laki-laki</label>';
                                echo '<input checked class="ml-3" type="radio" id="perempuan" name="jenis_kelamin" value="1">
                                    <label for="perempuan">Perempuan</label>';
                            }
                            ?>


                        </div>
                    </div>
                    <div class="mt-3">
                        <label>Jurusan</label>
                        <select class="form-select" id="jurusan" name="jurusan">
                            <?php
                            foreach ($datas['jurusan'] as $jurusan) {
                                if($jurusan == $datas['siswaSingle']['jurusan']){
                                    echo "<option selected value='{$jurusan}'>{$jurusan}</option>";
                                }else{
                                    echo "<option value='{$jurusan}'>{$jurusan}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                </div>

            </form>
        </div>
    </div>


</section>

<?php 

Flasher::destroyFlasher();

?>