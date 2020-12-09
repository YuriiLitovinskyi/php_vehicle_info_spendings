<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT ?>/vehicles" class="btn btn-link"><i class="fa fa-backward"></i> Back</a>
<br>
<?php flash('spendings_message'); ?>
<h1><?php echo $data['vehicle']->name; ?></h1>
<div class="row my-4">
        <div class="col-md-6">
            <a href="<?php echo URLROOT; ?>/spendings/add/<?php echo $data['vehicle']->id; ?>">
                <button type="button" class="btn btn-success"><i class="far fa-money-bill-alt"></i></i> Add</button>
            </a> 
        </div>
        <div class="col-md-6">
            <div class="bg-secondary text-center text-white p-2 mb-3">
                <h4>
                    Total spendings: <strong><?php echo (!empty($data['total_vehicle_spendings'][0]->total) ? $data['total_vehicle_spendings'][0]->total : 0); ?> grn</strong>    
                </h4>   
            </div>
        </div>
    </div>
<?php if(empty($data['vehicle_spendings'])) : ?>
   
    <div class="text-center">
        <h2 class="my-5">You haven't added any spengings for current vehicle yet</h2>   
    </div>

<?php else : ?>     
    
    <table class="table table-striped">
        <thead>
            <tr class="table-dark">
                <th class="pl-4">Name</th>
                <th class="pl-4">Price</th>
                <th class="pl-4">Comments</th>
                <th class="pl-4">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['vehicle_spendings'] as $spend) : ?>
                <tr>                  
                    <td class="pl-3"><?php echo $spend->name ?></td>
                    <td class="pl-3"><?php echo $spend->price ?></td>
                    <td class="pl-3"><?php echo $spend->comments ?></td>
                    <td class="pl-3"><?php echo $spend->date ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($data['vehicle']->user_id == $_SESSION['user_id']) : ?>
        <hr>
        <a href="<?php echo URLROOT; ?>/vehicles/edit/<?php echo $data['vehicle']->id; ?>" class="btn btn-dark">Edit Vehicle Info</a>

        <form class="float-right" action="<?php echo URLROOT; ?>/vehicles/delete/<?php echo $data['vehicle']->id; ?>" method="POST">
            <input type="submit" value="Delete Vehicle" class="btn btn-danger">
        </form>
    <?php endif; ?>

<?php endif; ?>



<?php require APPROOT . '/views/inc/footer.php'; ?>