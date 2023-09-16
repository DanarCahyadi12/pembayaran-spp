<div id="wrapper">
    <?php require_once "../app/views/partials/admin/SideBar.php"; ?>
    <div class="row  justify-content-center ">
        <div class="col">
            <h1 class="mx-4 mt-4">Siswa</h1>
            <form action="<?= url('siswa/cari') ?>" method="POST">
                <?php $kelas = ['X', 'XI', 'XII']; ?>
                <p class="ml-3 mt-4">Filter</p>
                <div class="d-flex mt-3 ">
                    <div class="col-2">
                        <select class="form-select" id="kelas" name="kelas">
                            <?php if (Session::exits('filters')) : ?>
                                <option value="">Semua kelas</option>
                                <?php foreach ($kelas as $item) : ?>
                                    <?php if ($item == Session::get('filters')['kelas']) : ?>
                                        <option selected value="<?= $item ?>"><?= $item ?></option>
                                    <?php endif ?>
                                    <?php if ($item != Session::get('filters')['kelas']) : ?>
                                        <option value="<?= $item ?>"><?= $item ?></option>
                                    <?php endif ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if (!Session::exits('filters')) : ?>
                                <option value="">Semua kelas</option>
                                <?php foreach ($kelas as $item) : ?>
                                    <option value="<?= $item ?>"><?= $item ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-2">
                        <select class="form-select" id="jurusan" name="jurusan">
                            <option value="">Semua jurusan</option>
                            <?php
                            $i = 0;
                            foreach ($datas['jurusan'] as $jurusan) {
                                if (Session::exits('filters')) {
                                    if ($jurusan == Session::get('filters')['jurusan']) {
                                        echo "<option selected value='{$jurusan}'>{$jurusan}</option>";
                                    } else {
                                        echo "<option value='{$jurusan}'>{$jurusan}</option>";
                                    }
                                } else {
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
                        <input type="text" placeholder="Cari siswa...." class="form-control mt-4 " name="search">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary mt-4">Cari</button>
                    </div>

                </div>

            </form>


            <div class="table-responsive mt-4">

                <table class="table table-striped" id="tabel-siswa">
                    <thead class="sticky-top">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NIS</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id='tabel-body'>
                        <?php
                        $i = 0;
                        foreach ($datas['siswa']['items'] as $data) {

                            $i++;
                            $urlDetail = url("siswa/detail/{$data['id']}");
                            $urlEdit = url("siswa/edit/{$data['id']}");
                            $urlDelete = url("siswa/delete/{$data['id']}");
                            echo "<tr >
                <th scope='row'>{$i}</th>
                <td scope=row>{$data['nama_lengkap']}</td>
                <td>{$data['NIS']}</td>
                <td>{$data['NISN']}</td>
                <td>{$data['kelas']}</td>
                <td>{$data['jurusan']}</td>
                <td>";
                            echo "<a href='{$urlDelete}' type='button' class='btn btn-danger btn-sm' >hapus</a>";
                            echo "<a href='{$urlDetail}' type='button' class='btn btn-primary mx-2 btn-sm'>detail</a>";
                            echo "<a href='{$urlEdit}' type='button' class='btn btn-dark btn-sm'>edit</a>";
                            echo "</td></tr>";
                        }

                        ?>
                    </tbody>
                </table>
            </div>



        </div>
        <div class="col-9 p-5 ml-5 ">

        </div>
    </div>
</div>
<?php
Flasher::destroyFlasher();
Session::delete('filters');
?>
</section>