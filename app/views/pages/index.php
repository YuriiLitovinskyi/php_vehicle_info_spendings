<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
        <h1 class="display-4 font-italic"><?php echo $data['title']; ?></h1>
        <p class="lead my-3">Please <a class="jumbo-link" href="<?php echo URLROOT; ?>/users/register">register</a> or <a class="jumbo-link" href="<?php echo URLROOT; ?>/users/login">log in</a> to be able to add info about your vehicle.</p>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>