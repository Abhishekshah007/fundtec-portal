<?php include('./includes/header.php'); ?>

<?php 

if (!isset($_SESSION['email'])) {
    header("Location: ../authentication/login-investor.php");
    exit();
}

$email = $_SESSION['email'];

include '../database/dbConfig.php';

$sql = "SELECT * FROM transactions WHERE email_id = '$email' ORDER BY date DESC";
$result = $conn->query($sql);

$transactions = [];
if ($result->num_rows > 0) {
    $transactions = $result->fetch_all(MYSQLI_ASSOC);
}

$conn->close();
?>

<div class="container-fluid">
    <div class="row">
        <!-- column 1 -->
        <?php include('./includes/sidebar.php'); ?>

        <!-- column 2 -->
        <div class="col-md-9 main-content">
            <h3 class="mt-3 mb-4 fw-bold">Transaction History</h3>
            <div class="row">
                <div class="accordion" id="accordionExample">
                    <?php 
                    if (count($transactions) > 0):
                        $netAmount = 0;
                        foreach ($transactions as $index => $transaction):
                            $transactionId = $transaction['transaction_id'];
                            $amount = $transaction['amount'];
                            $transactionType = $transaction['transaction_type'];
                            $date = $transaction['date'];
                            $prevAmount = $netAmount;

                            if ($transactionType === 'Investment') {
                                $netAmount += $amount;
                            } elseif ($transactionType === 'Withdrawal') {
                                $netAmount -= $amount;
                            }
                    ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?php echo $index; ?>">
                            <button class="accordion-button <?php echo $index > 0 ? 'collapsed' : ''; ?>" 
                                type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse<?php echo $index; ?>" 
                                aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>" 
                                aria-controls="collapse<?php echo $index; ?>">
                                <?php echo ucfirst($transactionType); ?> | <?php echo date("d-m-Y", strtotime($date)); ?>
                            </button>
                        </h2>
                        <div id="collapse<?php echo $index; ?>" 
                            class="accordion-collapse collapse <?php echo $index === 0 ? 'show' : ''; ?>" 
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p class="fw-bold">Transaction ID:</p>
                                        <p><?php echo $transactionId; ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="fw-bold">Previous Amount:</p>
                                        <p>Rs. <?php echo number_format($prevAmount); ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="fw-bold"><?php echo ucfirst($transactionType); ?> Amount:</p>
                                        <p>Rs. <?php echo number_format($amount); ?></p>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <p class="fw-bold">Net Amount:</p>
                                        <p>Rs. <?php echo number_format($netAmount); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        endforeach;
                    else:
                    ?>
                    <div class="alert alert-warning" role="alert">
                        No transactions found.
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('./includes/footer.php'); ?>
