<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT ?>/vehicles" class="btn btn-link"><i class="fa fa-backward"></i> Back</a>

<br>
<?php flash('vehicle_message'); ?>
<h1><?php echo $data['vehicle']->name; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Added by <?php echo $data['user']->name; ?> on <?php echo $data['vehicle']->created_at; ?>
</div>

<table class="table table-sm table-striped">
    <thead>
        <tr class="table-dark">
            <th class="pl-5">Property</th>
            <th class="pl-5">Value</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['vehicle'] as $key => $value) : ?>
            <tr>
                <td class="pl-3"><?php echo ucwords(str_replace('_', ' ', $key)); ?></td>
                <td class="pl-3"><?php echo $value ?></td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<?php if ($data['vehicle']->user_id == $_SESSION['user_id']) : ?>
    <hr>
    <a href="<?php echo URLROOT; ?>/vehicles/edit/<?php echo $data['vehicle']->id; ?>" class="btn btn-dark"><i class="fas fa-pencil-alt"></i> Edit Vehicle Info</a>
   
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger float-right"  data-toggle="modal" data-target="#deleteVehicle"><i class="far fa-trash-alt"></i> Delete Vehicle</button>
<?php endif; ?>

    <!-- Modal -->
    <div class="modal fade" id="deleteVehicle" tabindex="-1" aria-labelledby="deleteVehicleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteVehicleLabel">Delete Vehicle <?php echo $data['vehicle']->name; ?> ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Warning! Deletion cannot be undone!</p>
                    <p>Will be deleted vehicle info and all spendings records, which belong to current vehicle!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form class="float-right" action="<?php echo URLROOT; ?>/vehicles/delete/<?php echo $data['vehicle']->id; ?>" method="POST">
                        <button type="submit" class="btn btn-danger">Delete</button>                      
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>