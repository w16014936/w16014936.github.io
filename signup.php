<?php
require_once 'env/environment.php';
require_once 'functions/functions.php';
session_start();

// Check for logged in user
$loggedIn = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Check the user role of the logged in user
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : null;
// Page title
$pageTitle = 'Timesheets';

// Get the correcct page header depending on the users role and wheter or not they are logged in
if (!isset($loggedIn)) {
    echo getHTMLHeader($pageTitle, $loggedIn);

} elseif (isset($userRole) && $userRole == 1) {
    echo getHTMLUserHeader($pageTitle);

} elseif (isset($userRole) && $userRole == 2) {
    echo getHTMLAdminHeader($pageTitle);

} else {
    echo getHTMLHeader($pageTitle, $loggedIn);
}

?>
    <div class="jumbotron text-center">
        <?php
        // Create heading depending on chosen account type
        $accountType = filter_has_var(INPUT_GET, "accountType") ? $_GET["accountType"] : null;
        if (!isset($accountType)) {
            echo("<h1>Sign up for a free account</h1>");
        } else if ($accountType == 1) {
            echo("<h1>Sign up for a free account</h1>");
        } else if ($accountType == 2) {
            echo("<h1>Sign up for a pro account");
        } else {
            echo("<h1>Sign up for a free account</h1>");
        }
        ?>
    </div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form action="signup.php" class="form" name="signupForm" method="POST">
                    <div class="form-group">
                        <input type="text" id="signUp-username" class="form-control" placeholder="Username"
                               name="username" required/>
                    </div>
                    <div class="form-group">
                        <input type="text" id="signUp-emailAddress" class="form-control" placeholder="Email Address"
                               name="emailAddress"
                               required/>
                    </div>
                    <div class="form-group">
                        <input type="password" id="signUp-pass" class="form-control" placeholder="Password"
                               name="password"
                               required/>
                    </div>
                    <div class="form-group">
                        <input type="password" id="signUp-confirmPass" class="form-control"
                               placeholder="Confirm Password"
                               name="confirmPassword" required/>
                    </div>
                    <div class="login-error">
                        <?php
                        if (!empty($errors)) {
                            foreach ($errors as $error) {
                                echo "<p class='error'>$error</p>";

                            }
                        }
                        ?>
                    </div>
                    <button type="submit" id="signup-button" class="btn btn-primary">Sign up</button>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>

<?php

echo getHTMLFooter();
?>
    <script>customFormValidation("signUp-username", "signUp-emailAddress", "signUp-pass", "signUp-confirmPass",
            "Please enter your chosen username", "Please enter the email address to be associated with the account",
            "Please enter your a password for your account", "Please confirm your chosen password");
        validatePassword("signUp-pass", "signUp-confirmPass", "Passwords do not match");</script>
<?php

echo getHTMLEnd();

