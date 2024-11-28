<?php include('./includes/header.php'); ?>

<?php

$email = $_SESSION['email'];
include '../database/dbConfig.php';


$total_investments_query = "SELECT SUM(amount) AS total FROM transactions WHERE email_id = '$email' AND transaction_type = 'Investment'";
$total_investments_result = $conn->query($total_investments_query);
$total_investments_row = $total_investments_result->fetch_assoc();
$total_investments = $total_investments_row['total'] ?? 0;

$total_withdrawal_query = "SELECT SUM(amount) AS total FROM transactions WHERE email_id = '$email' AND transaction_type = 'Withdrawal'";
$total_withdrawal_result = $conn->query($total_withdrawal_query);
$total_withdrawal_row = $total_withdrawal_result->fetch_assoc();
$total_withdrawal = $total_withdrawal_row['total'] ?? 0;

$net_balance = $total_investments - $total_withdrawal;



$conn->close();

?>



<div class="container-fluid">
    <div class="row">
        <!-- Column 1 -->
        <?php include('./includes/sidebar.php'); ?>

        <!-- Column 2 -->
        <div class="col-md-9 main-content">
        <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-dismissible fade show alert-<?php echo $_SESSION['message_type'] === 'success' ? 'success' : 'danger'; ?>" role="alert">
                    <?php echo $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
            <?php endif; ?>
            <h3 class="mt-3 mb-4 fw-bold ">DASHBOARD</h3>
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <div class="card shadow-sm bg-light">
                        <div class="card-body text-center font-weight-bold font-monospace fs-1 p-30">
                            <h5 class="card-title">Net Balance</h5>
                            <p class="card-text">Rs. <?php echo $net_balance; ?></p>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-sm bg-light">
                        <div class="card-body text-center font-weight-bold font-monospace fs-1 p-30">
                            <h5 class="card-title">Total Investments</h5>
                            <p class="card-text">Rs. <?php echo $total_investments; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-sm bg-light">
                        <div class="card-body text-center font-weight-bold font-monospace fs-1 p-30">
                            <h5 class="card-title">Total Withdrawal</h5>
                            <p class="card-text">Rs. <?php echo $total_withdrawal; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('./includes/footer.php'); ?>