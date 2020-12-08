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
    <a href="<?php echo URLROOT; ?>/vehicles/edit/<?php echo $data['vehicle']->id; ?>" class="btn btn-dark">Edit Vehicle Info</a>

    <form class="float-right" action="<?php echo URLROOT; ?>/vehicles/delete/<?php echo $data['vehicle']->id; ?>" method="POST">
        <input type="submit" value="Delete Vehicle" class="btn btn-danger">
    </form>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>