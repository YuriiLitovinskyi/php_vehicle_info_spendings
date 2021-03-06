<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('vehicle_message'); ?>
<div class="row my-4">
    <div class="col-md-6">
        <h1><i class="fas fa-car-alt"></i> Your Vehicles</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/vehicles/add" class="btn btn-primary float-right">
            <i class="fas fa-plus"></i> Add New Vehicle
        </a>
    </div>
</div>

<?php if (empty($data['vehicles'])) : ?>

    <div class="text-center">
        <h2 class="my-5">You haven't added any vehicles yet</h2>
    </div>

<?php else : ?>

    <?php foreach ($data['vehicles'] as $vehicle) : ?>
        <div class="card card-body mb-3">
            <h4 class="card-title">
                <?php echo $vehicle->vehicleName; ?>
            </h4>
            <div class="bg-light p-2 mb-3">
                <p>Year production: <?php echo $vehicle->year_production; ?></p>
                <p>Fuel: <?php echo $vehicle->fuel; ?></p>
                <p>Country: <?php echo $vehicle->producing_country; ?></p>
            </div>

            <p class="card-text">Adeed by: <?php echo $vehicle->userName; ?> on <?php echo $vehicle->vehicleCreated; ?></p>

            <div class="row">
                <div class="col-md-12">
                    <a href="<?php echo URLROOT; ?>/spendings/show/<?php echo $vehicle->vehicleId; ?>/1">
                        <button type="button" class="btn btn-success m-1"><i class="fas fa-money-bill-wave"></i> Monitor Spendings</button>
                    </a>
                    <a href="<?php echo URLROOT; ?>/vehicles/show/<?php echo $vehicle->vehicleId; ?>">
                        <button type="button" class="btn btn-info m-1"><i class="fas fa-car"></i> See More Info</button>
                    </a>
                </div>
            </div>

        </div>
    <?php endforeach; ?>

    <div class="d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item<?php echo $data['current_page'] == 1 ? ' disabled' : '' ?>">
                <a class="page-link" href="<?php echo URLROOT; ?>/vehicles/<?php echo $data['current_page'] - 1; ?>" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <?php if ($data['current_page'] != 1) : ?>
                <li class="page-item"><a class="page-link" href="<?php echo URLROOT; ?>/vehicles/1">1</a></li>
            <?php endif; ?>

            <li class="page-item active"><a class="page-link" href="#"><?php echo $data['current_page']; ?> of <?php echo $data['total_pages']; ?></a></li>

            <?php if ($data['current_page'] !=  $data['total_pages']) : ?>
                <li class="page-item"><a class="page-link" href="<?php echo URLROOT; ?>/vehicles/<?php echo $data['total_pages']; ?>"><?php echo $data['total_pages']; ?></a></li>
            <?php endif; ?>

            <li class="page-item<?php echo $data['current_page'] ==  $data['total_pages'] ? ' disabled' : '' ?>">
                <a class="page-link" href="<?php echo URLROOT; ?>/vehicles/<?php echo $data['current_page'] + 1; ?>">Next</a>
            </li>
        </ul>
    </div>
<?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>