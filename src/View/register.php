<?php require_once('inc/header.php'); ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <?php require_once('inc/flash.php') ?>
        <div class="card bg-light mt-5">
            <div class="card-header card-text">
                <h2 class="card-text">Create Account</h2>
                <p class="card-text">Please Fill out This form to register with us</p>
            </div>

            <div class="card-body">

                <form method="post" action="<?php echo base_url ?>register/handleRegister">
                    <div class="form-group">
                        <label for="name">firstname<sub>*</sub></label>
                        <input type="text" name="firstname" class="form-control form-control-lg" required>
                    </div>

                    <div class="form-group">
                        <label for="middlename">middlename</label>
                        <input type="text" name="middlename" class="form-control form-control-lg">
                    </div>

                    <div class="form-group">
                        <label for="lastname">lastname<sub>*</sub></label>
                        <input type="text" name="lastname" class="form-control form-control-lg" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password<sub>*</sub></label>
                        <input type="password" name="password" class="form-control form-control-lg" required>
                    </div>
                    <div class="form-group">
                        <label for="username">username<sub>*</sub></label>
                        <input type="text" name="username" class="form-control form-control-lg" required>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-success btn-block pull-left" value="Resgister">
                            </div>
                            <div class="col">
                                <a href="<?php echo base_url;?>login/showLogin" class="btn btn-light btn-block pull-right">Already have account? Login </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once('inc/footer.php') ?>