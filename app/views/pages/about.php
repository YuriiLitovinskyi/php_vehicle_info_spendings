<?php require APPROOT . '/views/inc/header.php'; ?>
<h1><i class="fas fa-info-circle"></i> <?php echo $data['title']; ?></h1>
<p class="my-3">Description <strong><?php echo $data['description']; ?></strong></p>
<p>Version: <strong><?php echo APPVERSION; ?></p></strong>
<p class="my-5">This simple application can help you track spending information about your vehicle.</p>
<?php require APPROOT . '/views/inc/footer.php'; ?>