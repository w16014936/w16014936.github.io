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
  if (!isset($loggedIn)){
    echo getHTMLHeader($pageTitle, $loggedIn);

  } elseif (isset($userRole) && $userRole == 1){
    echo getHTMLUserHeader($pageTitle);

  } elseif (isset($userRole) && $userRole == 2){
    echo getHTMLAdminHeader($pageTitle);

  } else{
    echo getHTMLHeader($pageTitle, $loggedIn);
  }

?>
<div class="jumbotron text-center">
  <h1>University Timesheet System</h1>
</div>

<div class="container">
  <div class="col-sm-12">
    <h2>Purpose</h2>

    <p>The purpose of this website is to allow members of a team to register to our site, <i>https://w16014936.github.io/</i>. It contains serveral different parts, including:</p>

    <ul>
      <li>the ability to add <b>projects</b> to your account</li>
      <li>the ability to allocate <b>time</b> to all the projects you are working on</li>
      <li>the ability to see staff <b>holiday</b> all in one place</li>
      <li>the ability to calculate <b>costs</b> based on time spent on projects</li>
    </ul>
	
	<script src="serviceWorker.js" type="text/javascript"></script>
    <script src="js/Chart.bundle.min.js" type="text/javascript"></script>
    <script>
      if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('serviceWorker.js').then(function(registration) {
                // Registration was successful
                console.log('ServiceWorker registration successful with scope: ', registration.scope);
            }, function(err) {
                // registration failed :(
                console.log('ServiceWorker registration failed: ', err);
            });
        });
    }
    </script>
	
  </div>
</div>
<?php

echo getHTMLFooter();