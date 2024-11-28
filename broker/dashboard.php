<?php
session_start();
include '../database/dbConfig.php';

if (!isset($_SESSION['adminEmail'])) {
    header("Location: ../authentication/login-broker.php");
    exit();
}

$adminEmail = $_SESSION['adminEmail'];
$getName = explode('@', $adminEmail);
$_SESSION['name'] = $getName[0];

$investorQuery = "SELECT id, email_id FROM investors";
$investorResult = $conn->query($investorQuery);

$transactions = [];
if (isset($_GET['investor_id'])) {
    $investorId = intval($_GET['investor_id']);
    
    $emailQuery = "SELECT email_id FROM investors WHERE id = $investorId";
    $emailResult = $conn->query($emailQuery);

    if ($emailResult && $emailResult->num_rows > 0) {
        $investorEmail = $emailResult->fetch_assoc()['email_id'];

        $transactionQuery = "SELECT transaction_id, transaction_type, amount, date 
                             FROM transactions 
                             WHERE email_id = '$investorEmail' 
                             ORDER BY date DESC";
        $transactionResult = $conn->query($transactionQuery);

        if ($transactionResult && $transactionResult->num_rows > 0) {
            while ($row = $transactionResult->fetch_assoc()) {
                $transactions[] = $row;
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Broker Portal</title>
    <link rel="stylesheet" href="../css/investor.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="logo">
        <div>
            <a href="./dashboard.php">
                <img src="../assets/images/logo.webp" alt="logo" />
            </a>
        </div>
        <div class="d-flex align-items-center justify-content-end m-20">
            <div class="user-name text-white me-4">
                <h5>
                    <i class="bi bi-person-circle"></i>
                    Mr. <?php echo $_SESSION['name']; ?>
                </h5>
            </div>
            <div class="logout text-white">
                <a class="btn btn-light text-black" href="../authentication/logout.php">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center">Broker Portal</h2>

        <!-- Investor Section -->
        <div class="card mt-4">
            <div class="card-header bg-black text-white">
                <h5><i class="bi bi-people"></i> Investors</h5>
            </div>
            <div class="card-body">
                <p>View the list of all registered investors:</p>
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Investor Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($investorResult && $investorResult->num_rows > 0): ?>
                        <?php while ($investor = $investorResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $investor['id']; ?></td>
                            <td><?php echo explode('@', $investor['email_id'])[0]; ?></td>
                            <td><?php echo $investor['email_id']; ?></td>
                            <td>
                                <a href="?investor_id=<?php echo $investor['id']; ?>" class="btn btn-sm btn-dark">
                                    <i class="bi bi-eye"></i> View Transactions
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No Investors Found</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Transaction Details -->
        <?php if (isset($_GET['investor_id'])): ?>
        <div class="card mt-4">
            <div class="card-header bg-black text-white">
                <h5><i class="bi bi-cash-stack"></i> Transaction Details for Investor ID:
                    <?php echo $_GET['investor_id']; ?></h5>
            </div>
            <div class="card-body">
                <?php if (!empty($transactions)): ?>
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Transaction ID</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $transaction): ?>
                        <tr>
                            <td><?php echo $transaction['transaction_id']; ?></td>
                            <td><?php echo ucfirst($transaction['transaction_type']); ?></td>
                            <td>Rs. <?php echo number_format($transaction['amount'], 2); ?></td>
                            <td><?php echo $transaction['date']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p class="text-center">No transactions found for this investor.</p>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

</body>

</html>