<?php
$currentPage=basename($_SERVER['PHP_SELF']);

?>
<div class="col-md-3 sidebar bg-dark ">
            <ul class="nav flex-column ">
                <li class="nav-item">
                    <a class="nav-link <?php echo $currentPage === 'dashboard.php' ? 'active' : ''; ?> " aria-current="page" href="./dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link <?php echo $currentPage === 'add-amount.php' ? 'active' : ''; ?>" href="./add-amount.php">Add Amount</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $currentPage === 'withdraw-amount.php' ? 'active' : ''; ?>" href="./withdraw-amount.php">Withdraw Amount</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $currentPage === 'transaction-history.php' ? 'active' : ''; ?> " href="./transaction-history.php">Transactions History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $currentPage === 'setting.php' ? 'active' : ''; ?>" href="./setting.php">Settings</a>
                </li>
            </ul>
        </div>