<section>
    <div class="row">
        <?php require_once "../app/views/partials/admin/SideBar.php"; ?>
        <div class="col mt-4 ml-3">
            <h1>Detail siswa</h1>

            <div class="row">
                <div class="col-5">
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
                    <div class="mt-3">
                        <label>Tanggal ditambahkan</label>
                        <input type="text" disabled class="form-control" value="<?= formatDate($datas['siswaSingle']['tanggal']); ?>">
                    </div>
                    <div class="mt-3">
                    <a class="btn btn-danger w-25" href="<?php echo url('admin/delete/'.$datas['siswaSingle']['id']); ?>/siswa">Hapus siswa</a>
                        <a class="btn btn-primary w-25" href="<?php echo url('siswa/edit/'.$datas['siswaSingle']['id']); ?>">Edit siswa</a>
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

        <div class="mt-5">
                <h1>Siswa lainnya</h1>
        <div class="table-container">
        <table class="table table-striped"  id="tabel-siswa">
          <thead class=" sticky-top">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">NIS</th>
              <th scope="col">NISN</th>
              <th scope="col">Tanggal ditambahkan</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody class="table-group-divider" id='tabel-body'>
            <?php 
            $i = 0;
            foreach($datas['anotherSiswa']['items'] as $data){
              $i++;
              $tanggal = formatDate($data['tanggal']);
              $url = url("admin/detail/{$data['id']}");
              echo "<tr>
              <th scope='row'>{$i}</th>
              <td scope=row>{$data['nama_lengkap']}</td>
              <td>{$data['NIS']}</td>
              <td>{$data['NISN']}</td>
              <td>{$tanggal}</td>
              <td>";
              echo "<a href='{$url}' type='button' class='btn btn-primary'>detail</a>"; 
              
              echo "</td>
              </tr>";
              
            }
            ?>
          </tbody>
        </table>
        </div>
        </div>
        </div>

    </div>

</section>