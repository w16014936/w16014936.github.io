<?php
  require_once 'env/environment.php';
  require_once 'functions/functions.php';
  session_start();

  // Check for logged in user
  $loggedIn = isset($_SESSION['username']) ? $_SESSION['username'] : null;

  // Check the user role of the logged in user
  $userRole = isset($_SESSION['role']) ? $_SESSION['role'] : null;
  // Page title
  $pageTitle = 'Reporting';

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
    <canvas id="canvas"></canvas>
    <br>
    <br>
    Chart Type:
    <select id="type">
        <option value="line">Line</option>
        <option value="bar">Bar</option>
    </select>
    <button id="update">update</button>
    <script src="utils.js"></script>
    <script src="libraries/Chart.min.js" type="text/javascript"></script>
    <script src="graphs.js" type="text/javascript"></script>

<?php

echo getHTMLFooter();