<?php require APPROOT . '/views/inc/header.php'; ?>
<h1><?php echo $data['title']; ?></h1>
<p class="my-3">Description <strong><?php echo $data['description']; ?></strong></p>
<p>Version: <strong><?php echo APPVERSION; ?></p></strong>
<p class="my-5">This simple application can help you track such information about your vehicle, like spendings ...</p>
<?php require APPROOT . '/views/inc/footer.php'; ?>