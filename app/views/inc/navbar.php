<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?php echo URLROOT; ?>"><i class="fas fa-car"></i> <?php echo SITENAME; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about"><i class="fas fa-info"></i> About</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['user_name']; ?>'s Profile</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item text-info font-weight-bold" href="<?php echo URLROOT; ?>/users/edit/<?php echo $_SESSION['user_id']; ?>"><i class="fas fa-user"></i> Edit Profile</a>
                            <a class="dropdown-item text-danger font-weight-bold" data-toggle="modal" data-target="#deleteUser" href="#"><i class="fas fa-user-alt-slash"></i> Delete Profile</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Logout <i class="fas fa-sign-out-alt"></i></a>
                    </li>

                    <!-- Modal -->
                    <div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteUserLabel">Delete your current Profile?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-warning">Warning! Deletion cannot be undone!</p>
                                    <p class="text-danger">Will be deleted your current profile, all your vehicles and all spendings records, which belong to your vehicles!</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form class="float-right" action="<?php echo URLROOT; ?>/users/delete/<?php echo $_SESSION['user_id']; ?>" method="POST">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/register"><i class="fas fa-user-circle"></i> Register</a>
                        <!-- </li> <?php echo $_SESSION['']; ?> -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login <i class="fas fa-sign-in-alt"></i></a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>