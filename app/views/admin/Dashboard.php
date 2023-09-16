<div id="wrapper">

  <?php require_once "../app/views/partials/admin/SideBar.php"; ?>
  <div class="row  justify-content-center p-5 ">

    <div class="col">
      
      <div class="row">
        <div class="col">
        <p class="text-danger ">
          <?php 
            if(Flasher::exits() ){
              $flasher = Flasher::getFlasher();
              if($flasher['type'] == 'error'  && $flasher['action'] == 'create'){
                echo $flasher['message'];
              }
              
            }

          ?>
        </p>
        <p class="text-success ">
          <?php 
            if(Flasher::exits() ){
              $flasher = Flasher::getFlasher();
              if($flasher['type'] == 'success' && $flasher['action'] == 'create'){
                echo $flasher['message'];
              }
              
            }


          ?>
        </p>
          <h1 class="text-black">Welcome admin <span><?php echo Session::get('user')['username']; ?></span></h1>
          <a href="<?= url('logout'); ?>">Logout</a>
        </div>
      </div>
    
      <div class="row mt-4 ">
        <div class="col-3 bg-dark rounded p-3">
          <h3 class="text-white ">Siswa</h3>
          <h1 class="text-white "><?php echo $datas['siswa']['total']; ?></h1>
        </div>
      </div>

      <div class="row mt-3 d-flex flex-row">

        <button type="button" id="btn-modal" class="btn btn-primary col-2" data-bs-toggle="modal" data-bs-target="#modalForm">Tambah siswa</button>
    
     
      </div>
      
      <div class="modal-container " id="modal-container">
        <img src="<?= url('assets/close.png')?>" id="close-btn" role="button">
        <div class="modal-content col-7 p-3 mx-auto mt-3">
          <h1>Tambah siswa</h1>
          <form action="<?=url('admin/create') ?>" method="post">
            <div class="mt-3">
              <label for="nama">Nama lengkap</label>
              <input class="form-control" type="text" name="nama" required>
            </div>
            <div class="mt-3">
              <label for="NIS">NIS</label>
              <input required class="form-control" type="number" min="0" name="NIS">
            </div>
            <div class="mt-3">
              <label for="NISN">NISN</label>
              <input required class="form-control" type="number" min="0" name="NISN">
            </div>
            <div class="form-floating mt-3 row">
              <div class="col-2">
                <label for="kelas">Kelas</label>
                <select class="form-select" id="kelas" name="kelas">
                  <option selected value="X">X</option>
                  <option value="XI">XI</option>
                  <option value="XII">XII</option>
                </select>
              </div>

              <div class="col-7">
              <label for="jurusan">Jurusan</label>
                <select class="form-select" id="jurusan" name="jurusan">
                  <?php 
                    foreach($datas['jurusan'] as $jurusan){
                      echo "<option value='{$jurusan}'>{$jurusan}</option>";
                    }
                  ?>
                </select>
              </div>
              
            </div>
            <div class="mt-3">
              <label>Jenis kelamin</label>
              <div>
                <input required type="radio" id="laki-laki" name="jenisKelamin" value="0">
                <label for="laki-laki">Laki-laki</label>
                <input required type="radio" id="perempuan" name="jenisKelamin" value="1">
                <label for="perempuan">Perempuan</label>
              </div>
            </div>
          <button class="btn btn-dark mt-4">Tambah</button>
        </form>
        </div>
      </div>
      <div class="overlay"></div>

      <div class="row mt-3">
        <h3 class="mt-2">Siswa</h3>

        <table class="table table-striped" id="tabel-siswa">
          <thead>
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
            foreach($datas['siswaLimited']['items'] as $data){
              $i++;
              $tanggal = formatDate($data['tanggal']);
              $url = url("siswa/detail/{$data['id']}");
              echo "<tr>
              <th scope='row'>{$i}</th>
              <td scope=row>{$data['nama_lengkap']}</td>
              <td>{$data['NIS']}</td>
              <td>{$data['NISN']}</td>
              <td>{$tanggal}</td>
              <td>";
              echo "<a href='{$url}' type='button' class='btn btn-primary '>detail</a>"; 
              echo"</td>
              </tr>";
              
            }
            ?>
          </tbody>
        </table>
        
      </div>
    </div>
  </div>
</div>
<?php
  Flasher::destroyFlasher();
?>