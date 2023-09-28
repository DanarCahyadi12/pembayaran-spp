<div class="container-fluid">
    <div class="row justify-content-center ml-4">
        <?php
        require_once "../app/views/partials/petugas/SideBar.php"
        ?>

        <div class="col-9 p-5">
            <h1>Cari siswa</h1>
            <div class='w-full'>
                <form action="<?= url('petugas/cari') ?>" method="POST">
                    <?php 
                    $kelas = [
                        'X',
                        'XI',
                        'XII'
                    ];
                    
                    ?>
                    <p class="ml-3 mt-4">Filter</p>
                    <div class="d-flex mt-3 ">
                        <div class="col-2">
                            <select class="form-select" id="kelas" name="kelas">
                              <?php if(Session::exits('filters')): ?>
                                <option value="">Semua kelas</option>
                              <?php foreach($kelas as $item) : ?>
                                <?php if($item == Session::get('filters')['kelas'] ): ?>
                                    <option selected value="<?= $item ?>"><?= $item?></option>
                                <?php endif ?>
                                <?php if($item != Session::get('filters')['kelas'] ): ?>
                                    <option value="<?= $item ?>"><?= $item?></option>
                                <?php endif ?>
                                <?php endforeach; ?>
                                <?php endif; ?>
                                <?php  if(!Session::exits('filters')):?>
                                    <option value="">Semua kelas</option>
                                    <?php foreach($kelas as $item) : ?>
                                        <option  value="<?= $item ?>"><?= $item?></option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-2">
                            <select class="form-select" id="jurusan" name="jurusan">
                                <?php
                                $i = 0;
                                foreach ($datas['jurusan'] as $jurusan) {
                                    if(Session::exits('filters')) {
                                        if($jurusan == Session::get('filters')['jurusan']){
                                            echo "<option selected value='{$jurusan}'>{$jurusan}</option>";
                                        }else{
                                            echo "<option value='{$jurusan}'>{$jurusan}</option>";
                                        }
                                    }else{
                                        if ($i == 0) echo "<option value=''>Semua jurusan</option>";
                                        echo "<option value='{$jurusan}'>{$jurusan}</option>";
                                    }
                            
                                    $i++;
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <input type="text" placeholder="Nama, nis, nisn" class="form-control mt-4 " name="search">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary mt-4">Cari</button>
                        </div>
                        <div class="w-full mt-4" id="table-cont"> 
                            <table class="table table-striped" id="tabel-siswa">
                                <thead>
                                    <?php if (Session::exits('result_search_siswa_not_paid')) : ?>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">NIS</th>
                                            <th scope="col">NISN</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Jurusan</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    <?php endif; ?>
                                </thead>
                                <tbody class="table-group-divider" id='tabel-body'>
                                    <?php
                                    $currentYear = getCurrentYearAndNextYear()[0];
                                    $i = 0;
                                    if (Session::exits('result_search_siswa_not_paid')) {
                                        foreach ($datas['siswa']['items'] as $data) {
                                            $i++;
                                            $urlDetail = url("petugas/detail_siswa/{$data['id']}");
                                            $urlPembayaran = url("petugas/pembayaran/{$data['id']}/{$currentYear}");
                                            echo "<tr>
                                        <th scope='row'>{$i}</th>
                                        <td scope=row>{$data['nama_lengkap']}</td>
                                        <td>{$data['NIS']}</td>
                                        <td>{$data['NISN']}</td>
                                        <td>{$data['kelas']}</td>
                                        <td>{$data['jurusan']}</td>
                                        <td class='d-flex'>";
                                            echo "<a href='{$urlDetail}' type='button' class='btn btn-primary mx-2'>detail</a>";
                                            echo "<a href='{$urlPembayaran}' type='button' class='btn btn-dark mx-2'>bayar</a>";
                                            echo "</td></tr>";
                                        }
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>

            </form>

        </div>


    </div>
    </div>

</section>

<?php 
Session::delete('filters');
?>