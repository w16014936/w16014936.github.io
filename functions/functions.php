<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 28/09/2017
 * Time: 13:17
 */


// begin the session and save the information
// on loclahost or webspace depending on value in
// setEnv.php
function sessionStart($sessionDirectory = SESSION_DIR) {
    ini_set("session.save_path", $sessionDirectory);
    return session_start();
}


/* Creating the functions which control the pages */
function getHTMLHeader($pageTitle, $loggedIn) {

    $logged = isset($loggedIn) ? '<a class="nav-link" href="logout.php">Log Out</a>' : '<a class="nav-link" href="login.php">Members Login</a>';

    // Create the header placing it in a HEREDOC
    $header = <<<HEADER
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>$pageTitle</title>
    <meta charset="utf-8">
	<meta name="description" content="Timesheet Manager">
    <meta name="keywords" content="Timesheet,Staff,Report">
    <meta name="author" content="Elliott McKevitt">
	<meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="msapplication-starturl" content="/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="theme-color" content="#b1ddef">
	<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="json/manifest.json">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a class="navbar-brand" href="index.php"><i class="far fa-calendar-alt"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pricing.php">Pricing</a>
          </li>
          <li class="nav-item">
            $logged
          </li>
        </ul>
      </div>
    </nav>
HEADER;

    return $header;

}

// Ends the html page and replaces the makeFooter functionality
function getHTMLFooter() {
    return "<div class='col-sm-12'>
    <footer>&copy;".date('Y')." Timesheets</footer>
    </body>
    </html>";

}


// Function to generate the login form that appears in the top left
// of every page if user is not logged in
function getLoginForm(){
    // Create the login form
    $loginForm = "
    <div id='login'>
        <form action='loginProcess.php' method='post'>
            <label>Username: </label>
            <input type='text' name='username'  placeholder='Username....'  required>

            <label>Password:</label>
            <input type='password' name='password'  placeholder='Password....'  required>

            <input type='submit' value='Login'  name='loginForm'/>
        </form>";
    


    if (!empty($_SESSION['errors'])) {
                $errors = $_SESSION['errors'];
                foreach ($errors as $error) {
                    $loginForm .= "<p class='error'>$error</p>";

        }

        unset($_SESSION['errors']);
    }


    // Close div surrounding form
    $loginForm .= "</div>";


    return $loginForm;
}


// Function to validate the users entry into the lodin form
function validateLoginForm($dbConn){
    // Create the input array for the username and password
    $input = array();
    $errors = array();

    // Start the validation on the username and password
    $input['username'] = filter_has_var(INPUT_POST, 'username') ? $_POST['username']: null;
    $input['username'] = trim($input['username']);

    if(empty($input['username'])){
        $errors[] = "Your username has not been set.";
    }

    $input['password'] = filter_has_var(INPUT_POST, 'password') ? $_POST['password'] : null;
    $input['password'] = trim($input['password']);

    if(empty($input['password'])){
        $errors[] = "Your password has not been set.";
    }

    // Query the database to check if username and password are correct
    if(empty ($errors)){
         // Try to carry out the database search
        try{
            $sqlQuery = "SELECT passwordHash
                           FROM timesheets_user
                          WHERE username = :username";

            $stmt = $dbConn->prepare($sqlQuery);
            $stmt->execute(array(':username' => $input['username']));
            $row = $stmt->fetchObject();

            // Check the query returned some results
            if($stmt->rowCount() > 0){
                $passwordHash = $row->passwordHash;

                // If the password is a match
                if (password_verify($input['password'], $passwordHash)){
                    $_SESSION['username'] = $input['username'];

                } else{
                    $errors[] = "Your username or password is incorrect";

                }
            } else{
                $errors[] = "Your username or password is incorrect";

            }

        // Log the exception in a file elsewhere
        } catch(Exception $e){
            $retval =  "<p>Query failed: " . $e->getMessage() . "</p>\n";
        }
    }
    // Return an array of the input and errors arrays
    return $errors;
}



// Function to logout user by destroying the users session
function logoutUser($loggedIn, $redirect){
    // Destroy the users Session
    unset($loggedIn);
    session_destroy();

    return header('Location: '. $redirect);

    

}



//Function to return all of the links on the site with
//admin user privaleges
function getAdminMenuLinks(){
    return array("index.php" => "Home",    // Admin and normal
                 "books.php" => "Books",
				 "orderBooksForm.php" => "Buy Books",
                 "credits.php" => "Credits");

}



// Returns all the links for pages which don't require admin permissions.
function getMenuLinks(){
    return array("index.php" => "Home", "orderBooksForm.php" => "Buy Books", "credits.php" => "Credits");  // Non admin only
                
}


// Get category options for a select box
// Reuseable anywhere you may want to display the
// category dropdown menu
function getCategoryDescription($dbConn, $categoryID = ""){
     // Try to carry out the database query
    try{
		// Query the database
        $sqlQuery = "SELECT catID,
                            catDesc
                       FROM nbc_category
                   ORDER BY catDesc ASC";

        $stmt = $dbConn->prepare($sqlQuery);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $bookCategories = $stmt->fetchAll();

        // Set the options variable to send back
        $options = "";

        // Check the query returned some results
        if($stmt->rowCount() > 0){

            // For each result
            foreach ($bookCategories as $category){
                //Place the id in a variable
                $id = $category['catID'];
                //Place the description in a variable
                $name = $category['catDesc'];
				
				// If the passed in category id is the same as one of the ids 
				// that option is the selected option
                $options .= $categoryID == $id ? "<option value='$id' selected>$name</option>\n" : "<option value='$id'>$name</option>\n";
            }


        } else{
			// Display a technical issue message to user
            $options = "<p>
                         Sorry you have encountered a technical fault. 
                         Please try again later. If the fault still occurs
                         contact technical support.
                      </p>";
        }   

    } catch(Exception $e){
        $retval =  "<p>Query failed: " . $e->getMessage() . "</p>\n";

    }


    return $options;
}



// Get publisher options for a select box
// Reuseable anywhere you may want a select box
// of all the publishers
function getPublisherDescription($dbConn, $publisherID = ""){
     // Try to carry out the database query
    try{
		// Query the database
        $sqlQuery = "SELECT pubID,
                            pubName
                       FROM nbc_publisher
                   ORDER BY pubName ASC";

        $stmt = $dbConn->prepare($sqlQuery);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $bookPublishers = $stmt->fetchAll();

        // Set the options variable to send back
        $options = "";

        // Check the query returned some results
        if($stmt->rowCount() > 0){

            // For each result
            foreach ($bookPublishers as $publisher){
                //Place the id in a variable
                $id = $publisher['pubID'];
                //Place the description in a variable
                $name = $publisher['pubName'];
				
				// If the passed in publisher id is the same as one of the ids 
				// that option is the selected option
                $options .= $publisherID == $id ? "<option value='$id' selected>$name</option>\n" : "<option value='$id'>$name</option>\n";
            }


        } else{
			// Display a technical issue message to user
            $options = "<p>
                         Sorry you have encountered a technical fault. 
                         Please try again later. If the fault still occurs
                         contact technical support.
                      </p>";
        }   

    } catch(Exception $e){
        $retval =  "<p>Query failed: " . $e->getMessage() . "</p>\n";

    }


    return $options;
}



/* Function to return array of all book ISBNs */
function getBookISBNS($dbConn){
    // Try to carry out the database query
    try{
		// Get all the bookISBN
        $sqlQuery = "SELECT bookISBN
                       FROM nbc_books";
		
		// Prepare the query
        $stmt = $dbConn->prepare($sqlQuery);
		
		// Execute the query
        $stmt->execute();
		
		// Associative array
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
        $bookISBNS = $stmt->fetchAll();
		
		// Put the book isbns into an array
		// For each result
        foreach ($bookISBNS as $isbn){
            //Place the id in the array
            $ISBNS[] = $isbn['bookISBN'];
        }
        

    } catch(Exception $e){
        $retval =  "<p>Query failed: " . $e->getMessage() . "</p>\n";

    }
	
	// Return the array of bookisbns
    return $ISBNS;
}


// Simple get function to get all category ids
function getCategoryIDs($dbConn){
    // Try to carry out the database query
    try{
		// Get all the categoryIDs
        $sqlQuery = "SELECT catID
                       FROM nbc_category";
		
		// Prepare the query
        $stmt = $dbConn->prepare($sqlQuery);
		
		// Execute the query
        $stmt->execute();
		
		// Associative array
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
        $bookCategories = $stmt->fetchAll();
		
		// Put the book categories into an array
		// For each result
        foreach ($bookCategories as $category){
            //Place the id in the array
            $categories[] = $category['catID'];
        }
        

    } catch(Exception $e){
        $retval =  "<p>Query failed: " . $e->getMessage() . "</p>\n";

    }
	
	// Return the array of bookisbns
    return $categories;
}



// Simple get function to return all publisher ids
function getPublisherIDs($dbConn){
    // Try to carry out the database query
    try{
		// Get all the publisher ids
        $sqlQuery = "SELECT pubID
                       FROM nbc_publisher";
		
		// Prepare the query
        $stmt = $dbConn->prepare($sqlQuery);
		
		// Execute the query
        $stmt->execute();
		
		// Associative array
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
        $bookPublishers = $stmt->fetchAll();
		
		// Put the book publishers into an array
		// For each result
        foreach ($bookPublishers as $publisher){
            //Place the id in the array
            $publishers[] = $publisher['pubID'];
        }
        

    } catch(Exception $e){
        $retval =  "<p>Query failed: " . $e->getMessage() . "</p>\n";

    }
	
	// Return the array of bookisbns
    return $publishers;
}