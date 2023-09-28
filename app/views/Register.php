<div class="row justify-content-center">
    <div class="col-6 bg-white shadow ml-5 rounded my-5 p-5">
        <h1 class="text-black">Register</h1>
        <?php $flasher = Flasher::getFlasher(); ?>

        <?php if (Flasher::exits() && Flasher::getFlasher()['type'] == 'success') : ?>
            <p class="text-success"><?= Flasher::getFlasher()['message'] ?></p>
        <?php endif; ?>
        <?php if (Flasher::exits() && Flasher::getFlasher()['type'] == 'error') : ?>
            <p class="text-danger"><?= Flasher::getFlasher()['message'] ?></p>
        <?php endif; ?>
        <form action="<?= url('register/register'); ?>" method="POST">
            <div class="mt-3">
                <Label class="text-black" for="email">Username</Label>
                <input type="text" required class="form-control" name="username" id="username">
            </div>
            <div class="mt-3">
                <Label class="text-black" for="email">Email</Label>
                <input type="email" required class="form-control" name="email" id="email">
            </div>
            <div class="mt-3">
                <Label class="text-black" for="password">Password</Label>
                <input type="password" required class="form-control" name="password" id="password">
            </div>
            <div class="mt-3">
                
                <Label class="text-black" for="password">Level</Label>
                <select name="level" class="form-control col-3" required>                    
                    <option value="0">Petugas</option>
                    <option value="1">Admin</option>
                </select>
            </div>
            <button class="btn btn-primary mt-3 mb-3 mr-3">Register</button>
        </form>
    </div>
</div>

<?php
Flasher::destroyFlasher();

?>