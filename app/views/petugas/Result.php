<section>
    <div class="row">
        <?php 
            require_once "../app/views/partials/petugas/SideBar.php"
        ?>

        <div class="col p-5">
            <h1>Pembayaran</h1>
            <div class='w-full'>
                <form action="<?= url('petugas/cari') ?>" method="POST">
                    <p class="ml-3 mt-4">Filter</p>
                    <div class="d-flex mt-3 ">
                        <div class="col-2">
                            <select class="form-select" id="kelas" name="kelas">
                                <option selected value="">Semua kelas</option>
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <select class="form-select" id="jurusan" name="jurusan">
                                <?php
                                $i = 0;
                                foreach ($datas['jurusan'] as $jurusan) {
                                    if ($i == 0) echo "<option value=''>Semua jurusan</option>";
                                    echo "<option value='{$jurusan}'>{$jurusan}</option>";
                                    $i++;
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-2">
                            <select class="form-select" id="jurusan" name="bulan">
                                <?php
                                $i = 0;
                                foreach ($datas['months'] as $bulan) {
                                    if ($i == 0) echo "<option value=''>Semua bulan</option>";
                                    echo "<option value='{$bulan}'>{$bulan}</option>";
                                    $i++;
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <input type="text" placeholder="Cari siswa...." class="form-control mt-4 " name="search">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary mt-4">Cari</button>
                        </div>
                        <?php
                        if (isset($datas['refresh'])) echo "<a href='petugas' class='btn btn-success w-25 ml-3 mt-3'>Refresh</a>";
                        ?>
                    </div>

                </form>
                                
            </div>
            <div class="col-9 mt-4">
                <h3>Hasil</h3>
            </div>
        </div>

      
    </div>

</section>