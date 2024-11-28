<?php include_once('./includes/header.php'); ?>


<div class="container-fluid">
    <div class="row">
        <!-- Column 1 -->
        <?php include('./includes/sidebar.php'); ?>

        <!-- column 2 -->
        <div class="col-md-9 main-content">
            <h3 class="mt-3 mb-4 text-uppercase fw-bold">Add Investment</h3>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm bg-white border-dark">
                        <div class="card-header bg-white text-black text-uppercase">
                            <h5 class="mb-0">Add Investment Details</h5>
                        </div>
                        <div class="card-body">
                            <form action="add-amount-process.php" method="POST">
                                <div class="mb-3">
                                    <label for="investmentAmount" class="form-label fw-bold">Investment Amount (Rs.)</label>
                                    <input type="number" class="form-control border-dark" id="investmentAmount"
                                        name="investmentAmount" required>
                                </div>
                                <div class="mb-3">
                                    <label for="investmentDate" class="form-label fw-bold">Investment Date</label>
                                    <input type="date" class="form-control border-dark" id="investmentDate"
                                        name="investmentDate" required>
                                </div>
                                <button type="submit" name="submit" class="btn btn-dark w-100 fw-bold">Submit Investment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once('./includes/footer.php'); ?>