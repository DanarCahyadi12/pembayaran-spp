<div class="container-fluid">
    <div class="row justify-content-center">
        <?php require_once "../app/views/partials/petugas/SideBar.php" ?>
        <div class="p-5 col-9 ml-5">
            <div class="col ml-3 ">
                <h2 class="mt-4 ml-2">
                    Welcome petugas
                    <?= Session::get('user')['username'] ?>
                </h2>
                <a href="<?= url('logout') ?>" class=" mt-4 ml-2">Logout</a>
            </div>
            
            <div class="col-9 ml-4 mt-3">
                <a href="petugas" type="button" class="col-3 bg-success p-3 rounded text-decoration-none">
                    <h5 class="text-white">Mulai pembayaran</h5>
                </a>

            </div>
            <div class="col ml-3 mt-5">
                <h1>Bulan</h1>
                <?php
                    foreach($datas['months'] as $month){
                        echo "<a href='pembayaran/bulan/{$month['id']}' type='button' class='col-2 mx-2 my-2 rounded p-4 rounded bg-primary'>
                        <h5 class='text-white'>
                            {$month['bulan']}
                        </h5>
                    </a>";    
                    }
                ?>
            </div>

        </div>
    </div>
</div>