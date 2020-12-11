<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT ?>/vehicles" class="btn btn-link"><i class="fa fa-backward"></i> Back</a>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Update Profile Info</h2>
            <p>Please fill out this form to update your account info</p>
            <form action="<?php echo URLROOT; ?>/users/edit/<?php echo $data['id']; ?>" method="POST">
                <div class="form-group">
                    <label for="name">New Name: <sup>*</sup></label>
                    <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                    <span class="invalid-feedback"><?php echo $data['name_error']; ?></span>
                </div>

                <div class="form-group">
                    <label for="email">New Email: <sup>*</sup></label>
                    <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
                </div>

                <div class="form-group">
                    <label for="password">New Password: <sup>*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_error']; ?></span>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm New Password: <sup>*</sup></label>
                    <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['confirm_password_error']; ?></span>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" value="Update Profile" class="btn btn-success btn-block">
                    </div>                   
                </div>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>