<?php include('./includes/header.php'); ?>
<?php

if (isset($_SESSION['adminEmail'])) {
    header("Location: ../broker/dashboard.php");
    exit();
}

?>

    <div class="container d-flex flex-column align-items-center justify-content-center vh-80">
        <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
            <div class="card">
                <div class="card-header">
                    <h4>Broker Login</h4>
                </div>
                <div class="card-body ">
                    <form action="login-broker-process.php" method="POST">
                        <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="alfred@gmail.com" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="alfred@1234" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-dark btn-lg w-100">Login</button>
                        <p class="text-center mt-3">Or login as <a href="./authentication/login-investor.php">Investor</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include_once ('../includes/footer.php'); ?>
