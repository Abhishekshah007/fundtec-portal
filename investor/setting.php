<?php include('./includes/header.php'); ?>


<div class="container-fluid">
    <div class="row">
        <!-- Column 1 -->
        <?php include('./includes/sidebar.php'); ?>

        <!-- column 2 -->
        <div class="col-md-9 main-content">
            <h3 class="mt-3 mb-4 fw-bold ">Settings</h3>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm bg-white border-dark">
                        <div class="card-header bg-white text-black text-uppercase">
                            <h5 class="mb-0">Change Password</h5>
                        </div>
                        <div class="card-body">
                            <?php if (isset($_SESSION['message'])): ?>
                            <div class="alert alert-<?php echo $_SESSION['message_type']; ?>" role="alert">
                                <?php echo $_SESSION['message']; ?>
                                <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
                            </div>
                            <?php endif; ?>

                            <form action="setting-process.php" method="POST">
                                <div class="mb-3">
                                    <label for="currentPassword" class="form-label fw-bold">Current Password</label>
                                    <input type="password" class="form-control border-dark" id="currentPassword"
                                        name="currentPassword" required>
                                </div>
                                <div class="mb-3">
                                    <label for="newPassword" class="form-label fw-bold">New Password</label>
                                    <input type="password" class="form-control border-dark" id="newPassword"
                                        name="newPassword" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label fw-bold">Confirm Password</label>
                                    <input type="password" class="form-control border-dark" id="confirmPassword"
                                        name="confirmPassword" required>
                                </div>
                                <button type="submit" name="submit" class="btn btn-dark w-100 fw-bold">Confirm Change
                                    Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ('../includes/footer.php'); ?>