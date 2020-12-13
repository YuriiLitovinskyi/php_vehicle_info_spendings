<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT ?>/vehicles" class="btn btn-link"><i class="fa fa-backward"></i> Back</a>
<br>
<?php if (isset($data['vehicle']->user_id) && $data['vehicle']->user_id == $_SESSION['user_id']) : ?>
    <?php flash('spendings_message'); ?>
    <h2><?php echo $data['vehicle']->name; ?></h2>
    <div class="row my-2">
        <div class="col-md-6">
            <?php if ($data['vehicle']->user_id == $_SESSION['user_id']) : ?>
                <a href="<?php echo URLROOT; ?>/spendings/add/<?php echo $data['vehicle']->id; ?>">
                    <button type="button" class="btn btn-success"><i class="far fa-money-bill-alt"></i></i> Add</button>
                </a>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <div class="bg-secondary text-center text-white p-1 my-1">
                <h4>
                    Total spendings: <strong><?php echo (!empty($data['total_vehicle_spendings'][0]->total) ? $data['total_vehicle_spendings'][0]->total : 0); ?> grn</strong>
                </h4>
            </div>
        </div>
    </div>
    <?php if (empty($data['vehicle_spendings'])) : ?>

        <div class="text-center">
            <h2 class="my-5">You haven't added any spengings for current vehicle yet</h2>
        </div>

    <?php else : ?>

        <table class="table table-sm table-striped mb-5 spending-items-table table-responsive-sm">
            <thead>
                <tr class="table-dark">
                    <th class="pl-4">Name</th>
                    <th class="pl-4">Price</th>
                    <th class="pl-4">Comments</th>
                    <th class="pl-4">Date</th>
                    <th class="pl-4">Edit</th>
                    <th class="pl-4">Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['vehicle_spendings'] as $spend) : ?>
                    <tr>
                        <td class="pl-3"><?php echo $spend->name ?></td>
                        <td class="pl-3"><?php echo $spend->price ?></td>
                        <td class="pl-3"><?php echo $spend->comments ?></td>
                        <td class="pl-3"><?php echo $spend->date ?></td>
                        <?php if ($data['vehicle']->user_id == $_SESSION['user_id']) : ?>
                            <td class="pl-3">
                                <a href="<?php echo URLROOT; ?>/spendings/edit/<?php echo $spend->id; ?>/<?php echo $data['vehicle']->id; ?>"><i class="fas fa-edit edit-item"></i></a>
                            </td>
                            <td class="pl-3">
                                <i class="fas fa-trash-alt text-danger delete-item" id="delete-spending-icon" data-toggle="modal" data-target="#deleteSpendingItemModal" onClick="deleteSpendingItem('<?php echo URLROOT; ?>/spendings/delete/<?php echo $spend->id; ?>/<?php echo $data['vehicle']->id; ?>')">
                                </i>

                            </td>
                        <?php endif; ?>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            <ul class="pagination">
                <li class="page-item<?php echo $data['current_page'] == 1 ? ' disabled' : '' ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/spendings/show/<?php echo $data['vehicle']->id; ?>/<?php echo $data['current_page'] - 1; ?>" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <?php if ($data['current_page'] != 1) : ?>
                    <li class="page-item"><a class="page-link" href="<?php echo URLROOT; ?>/spendings/show/<?php echo $data['vehicle']->id; ?>/1">1</a></li>
                <?php endif; ?>

                <li class="page-item active"><a class="page-link" href="#"><?php echo $data['current_page']; ?> of <?php echo $data['total_pages']; ?></a></li>

                <?php if ($data['current_page'] !=  $data['total_pages']) : ?>
                    <li class="page-item"><a class="page-link" href="<?php echo URLROOT; ?>/spendings/show/<?php echo $data['vehicle']->id; ?>/<?php echo $data['total_pages']; ?>"><?php echo $data['total_pages']; ?></a></li>
                <?php endif; ?>

                <li class="page-item<?php echo $data['current_page'] ==  $data['total_pages'] ? ' disabled' : '' ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/spendings/show/<?php echo $data['vehicle']->id; ?>/<?php echo $data['current_page'] + 1; ?>">Next</a>
                </li>
            </ul>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deleteSpendingItemModal" tabindex="-1" aria-labelledby="deleteSpendingItemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteSpendingItemModalLabel">Delete Item?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Warning! Deletion cannot be undone!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <form id="deleteSpendingItemModalForm" class="float-right" method="POST">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>
<?php else : ?>
    <h2>404 Page Not Found</h2>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>