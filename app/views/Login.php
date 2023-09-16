<div class="col-6 bg-white shadow ml-5 rounded my-5 p-5" >
    <h1 class="text-black">Login</h1>
    <?php $flasher = Flasher::getFlasher();?>
    <p class="text-danger">
        <?php 
            if(Flasher::exits()){
                echo $flasher['message'];
            }
            Flasher::destroyFlasher();
        ?>
    </p>
    <form action="<?= url('login/auth'); ?>" method="POST">
        <div class="mt-3">
            <Label class="text-black" for="email">Email</Label>
            <input type="email" required class="form-control" name="email" id="email">
        </div>
        <div class="mt-3">
            <Label class="text-black" for="password">Password</Label>
            <input type="password" required class="form-control" name="password" id="password">
        </div>
        <button class="btn btn-primary mt-3">Login</button>
    </form>
</div>