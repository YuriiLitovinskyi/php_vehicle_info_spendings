<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT ?>/spendings/show/<?php echo $data['vehicle_id']; ?>" class="btn btn-link"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light my-5 form-card"> 
    <h2>Add New Item to Spendings</h2>
    <p>You can add new item for your vehicle here</p>
    <form action="<?php echo URLROOT; ?>/spendings/add/<?php echo $data['vehicle_id']; ?>" method="POST">

        <div class="form-group">
            <label for="name">Item Name: <sup>*</sup></label>
            <input type="text" name="name" class="form-control form-control <?php echo (!empty($data['name_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
            <span class="invalid-feedback"><?php echo $data['name_error']; ?></span>
        </div>

        <div class="form-group">
            <label for="price">Item Price (grn): <sup>*</sup></label>
            <input type="number" name="price" class="form-control form-control <?php echo (!empty($data['price_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['price']; ?>">
            <span class="invalid-feedback"><?php echo $data['price_error']; ?></span>
        </div>       

        <div class="form-group">
            <label for="comments">Comments: <sup>*</sup></label>
            <textarea name="comments" class="form-control form-control <?php echo (!empty($data['comments_error'])) ? 'is-invalid' : ''; ?>"><?php echo $data['comments']; ?></textarea>
            <span class="invalid-feedback"><?php echo $data['comments_error']; ?></span>
        </div>        

        <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle"></i> Save</button>  
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>