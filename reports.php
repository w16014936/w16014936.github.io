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
<div id="reportMain">
    <div id="reportConfigContainer">
        <div class="reportConfig">
            Chart Type:
            <select id="type">
                <option value="bar">Vertical Bar</option>
                <option value="line">Line</option>
                <option value="polarArea">Polar Area</option>
                <option value="radar">Radar</option>
            </select>
        </div>
        <div class="reportConfig">
            <form>
                Stack the data:
                <input type="radio" name="stack" id="stackTrue" checked="checked"">Yes <input type="radio" name="stack">No
            </form>
        </div>
        <div class="reportConfig">
            <form>
                Smooth Lines:
                <input type="radio" name="smooth" id="smoothTrue" checked="checked">Yes <input type="radio" name="smooth">No
            </form>
        </div>
        <div class="reportConfig">
            <button id="reportUpdate">Generate Graph</button>
        </div>
    </div>
    <div id="reportCanvas">
        <canvas id="canvas"></canvas>
    </div>
</div>

<script src="js/utils.js"></script>
<script src="js/libraries/Chart.min.js" type="text/javascript"></script>
<script src="js/graphs.js" type="text/javascript"></script>


<?php

echo getHTMLFooter();