<?php
/* Timesheet Reports
 * admin page
 * requires logged on
*/
require_once 'env/environment.php';
require_once 'functions/functions.php';
require_once 'class/PDODB.php';
session_start();

// Attempt to make connection to the database
$dbConn = PDODB::getConnection();

// Check for logged in user
$loggedIn = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Page title
$pageTitle = 'Report Timesheet';  

// Check the user role of the logged in user
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : null;

// Get the correcct page header depending on the users current role
// If user is not logged in display message to user telling them to log in
if (!isset($loggedIn)){
  echo getHTMLHeader($pageTitle, $loggedIn);
  $errorText = "Sorry you must be logged to access this page. Please login <a href='login.php'>here</a> to login to your account. If you don't currently have an account please contact your system administrator to have one created for you.";
  
} elseif (isset($userRole) && $userRole == 2){        // User level 
  echo getHTMLUserHeader($pageTitle, $loggedIn);
  $errorText = "Sorry you do not have the correct permissions to access this page. Please select a different role <a href='select-role.php'>here</a> to change your account role.";

} elseif (isset($userRole) && $userRole == 1){        // Admin level
  echo getHTMLAdminHeader($pageTitle, $loggedIn);
    
} else{
  echo getHTMLHeader($pageTitle, $loggedIn);
  $errorText = "Sorry you do not have the correct permissions to access this page. Please select a different role <a href='select-role.php'>here</a> to change your account role.";
}
  
  
?>
<div class="jumbotron text-center">
  <h1><?php echo $pageTitle;?></h1>
</div>
<?php

// If not logged in show text
if (isset($errorText)){
	echo "<p>$errorText</p>";

} else{
	// The main page content if user has correct permissions
	?>
	<!--<div id="reportMain" class="row">-->
	<div class="container">
		<div class="row">
			<div id="reportConfigContainer" class="col-md-2">
				<h4>Report Configuration</h4>
				<div class="reportConfig">
					<label>Start Date:</label><input type="date" name="startDate" id="startDate">
				</div>
				<div class="reportConfig">
					<label>End Date:</label><input type="date" name="endDate" id="endDate">
				</div>
				<div class="reportConfig">
					<label>Chart Type:</label>
					<select id="type">
						<option value="bar">Vertical Bar</option>
						<option value="line">Line</option>
						<option value="polarArea">Polar Area</option>
						<option value="radar">Radar</option>
					</select>
				</div>
				<div class="reportConfig">
					<form>
						<label>High Contrast Mode:</label>
						<input type="radio" name="highContrast" id="highContrastTrue">Yes <input type="radio" name="highContrast" checked="checked">No
					</form>
				</div>
				<div class="reportConfig">
					<form id ="stackRadio">
						<label>Stack the data:</label>
						<input type="radio" name="stack" id="stackTrue" checked="checked">Yes <input type="radio" name="stack" id="stackFalse">No
					</form>
				</div>
				<div class="reportConfig">
					<form id ="smoothLines">
						<label>Line Stiffness:</label>
						<div class="range-slider">
							<input id="smoothLineSlider" class="rs-range" type="range" value="0.5" min="0.25" max="1" step="0.01">
						</div>
					</form>
				</div>
				<div class="reportConfig">
					<form id ="pointRadius">
						<label>Point Radius:</label>
						<div class="range-slider">
							<input id="pointRadiusSlider" class="rs-range" type="range" value="5" min="0" max="10" step="1">
						</div>
					</form>
				</div>
				<div class="reportConfig">
					<form id ="fillSpace">
						<label>Fill space:</label>
						<input type="radio" name="fillLines" id="fillTrue" checked="checked">Yes <input type="radio" name="fillLines">No
					</form>
				</div>
				<div class="reportConfig">
					<button id="reportUpdate">Generate Graph</button>
				</div>
			</div>
			<div id="reportCanvas" class="col-md-10"> 
				<canvas id="canvas"></canvas>
			</div>
    </div>
	</div>
	<?php
}
echo getHTMLFooter();

?>
<script src="js/utils.js"></script>
<script src="js/libraries/Chart.min.js" type="text/javascript"></script>
<script src="js/graphs.js" type="text/javascript"></script>
<?php
echo getHTMLEnd();