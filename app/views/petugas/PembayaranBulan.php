<div class="container-fluid">
<div class="row justify-content-center">
    <?php require_once "../app/views/partials/petugas/SideBar.php" ?>

    <div class="p-5 col-9 ml-5">
        <h2>Pembayaran bulan <?= $datas['bulan'] ?></h2>
        <h2 class='mt-2'><?= $datas['siswa']['total'] ?> siswa</h2>
        <div class="w-full mt-4" id="table-cont">
            <table class="table table-striped" id="tabel-siswa">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIS</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" id='tabel-body'>
                    <?php
                    $currentYear = getCurrentYearAndNextYear()[0];
                    $i = 0;
                  
                    ?>

                    <?php foreach ($datas['siswa']['items'] as $data) : ?>
                    <?php   
                        $urlDetail = url("petugas/detail_siswa/{$data['id']}");
                        $urlPembayaran = url("petugas/pembayaran/{$data['id']}/{$currentYear}");
                    ?>
                        <?php $i++;?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $data['nama_lengkap'] ?></td>
                            <td><?= $data['NIS'] ?></td>
                            <td><?= $data['NISN'] ?></td>
                            <td><?= $data['kelas'] ?></td>
                            <td><?= $data['jurusan'] ?></td>
                            <?php if($data['status'] == 0): ?>
                                <td class="bg-danger text-white">Belum lunas</td>
                            <?php endif; ?>
                            <?php if($data['status'] == 1): ?>
                                <td class="bg-success text-white">Lunas</td>
                            <?php endif; ?>
                            <td class="d-flex">
                                <a href="<?= $urlDetail?>" class="btn btn-primary btn-sm " role="button">detail</a>
                                <a href="<?= $urlPembayaran?>" class="btn btn-dark btn-sm mx-2" role="button">bayar</a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>