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
    
    <table class="table table-striped mb-5">
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
                            <a href="<?php echo URLROOT; ?>/spendings/edit/<?php echo $spend->id; ?>/<?php echo $data['vehicle']->id; ?>"><i class="fas fa-edit"></i></a>
                        </td>
                        <td class="pl-3">                           
                            <i 
                                class="fas fa-trash-alt text-danger" 
                                id="delete-spending-icon" 
                                data-toggle="modal" 
                                data-target="#deleteSpendingItemModal" 
                                onClick="deleteSpendingItem('<?php echo URLROOT; ?>/spendings/delete/<?php echo $spend->id; ?>/<?php echo $data['vehicle']->id; ?>')">
                            </i>
                            
                        </td>
                    <?php endif; ?>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table> 

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

<?php require APPROOT . '/views/inc/footer.php'; ?>