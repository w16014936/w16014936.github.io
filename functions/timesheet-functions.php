<?php
/**
 * Created by IntelliJ IDEA.
 * User: elliottm
 * Date: 17/04/2019
 * Time: 07:40
 */
// get the timesheet type 
function getTimesheet($dbConn, $timesheet_id){
    // Try to carry out the database search
    try{
        $sqlQuery = "SELECT timesheet_id,
                            CONCAT(timesheets_person.forename, ' ', timesheets_person.surname, 's record for: ', time_in, ' - ',  time_out) AS time_record,
                            activity_id,
                            project_id,
                            time_in,
                            time_out
                    FROM timesheets_timesheet
                    JOIN timesheets_person ON timesheets_person.user_id = timesheets_timesheet.user_id 
                    WHERE timesheet_id = :timesheet_id";

        $stmt = $dbConn->prepare($sqlQuery);
        $stmt->execute(array(':timesheet_id' => $timesheet_id));
        $rows = $stmt->fetchObject();

        // Check the query returned some results
        if($stmt->rowCount() > 0){
            $time_record = $rows->time_record;

        } else{
            $time_record = null;
        }

        // Log the exception
    } catch(Exception $e){
        $retval =  "<p>Query failed: " . $e->getMessage() . "</p>\n";
        $time_record = null;
    }


    return $time_record;

}

function getTimesheetActivity($dbConn, $timesheet_id){
    // Try to carry out the database search
    try{
        $sqlQuery = "SELECT activity_id
                   FROM  timesheets_timesheet
                   WHERE timesheets_timesheet.timesheet_id = :timesheet_id";

        $stmt = $dbConn->prepare($sqlQuery);
        $stmt->execute(array(':timesheet_id' => $timesheet_id));
        $rows = $stmt->fetchObject();

        // Check the query returned some results
        if($stmt->rowCount() > 0){
            $activity = $rows->activity_id;

        } else{
            $activity = null;
        }

        // Log the exception
    } catch(Exception $e){
        $retval =  "<p>Query failed: " . $e->getMessage() . "</p>\n";
        $activity = null;
    }

    return $activity;
}

function getTimesheetProject($dbConn, $timesheet_id){
    // Try to carry out the database search
    try{
        $sqlQuery = "SELECT project_id
                   FROM  timesheets_timesheet
                   WHERE timesheets_timesheet.timesheet_id = :timesheet_id";

        $stmt = $dbConn->prepare($sqlQuery);
        $stmt->execute(array(':timesheet_id' => $timesheet_id));
        $rows = $stmt->fetchObject();

        // Check the query returned some results
        if($stmt->rowCount() > 0){
            $project = $rows->project_id;

        } else{
            $project = null;
        }

        // Log the exception
    } catch(Exception $e){
        $retval =  "<p>Query failed: " . $e->getMessage() . "</p>\n";
        $project = null;
    }

    return $project;
}

function getTimesheetDate($dbConn, $timesheet_id){
    // Try to carry out the database search
    try{
        $sqlQuery = "SELECT timesheets_timesheet.date
                   FROM  timesheets_timesheet
                   WHERE timesheets_timesheet.timesheet_id = :timesheet_id";

        $stmt = $dbConn->prepare($sqlQuery);
        $stmt->execute(array(':timesheet_id' => $timesheet_id));
        $rows = $stmt->fetchObject();

        // Check the query returned some results
        if($stmt->rowCount() > 0){
            $date = $rows->date;

        } else{
            $date = null;
        }

        // Log the exception
    } catch(Exception $e){
        $retval =  "<p>Query failed: " . $e->getMessage() . "</p>\n";
        $date = null;
    }

    return $date;
}

function getTimeIn($dbConn, $timesheet_id){
    // Try to carry out the database search
    try{
        $sqlQuery = "SELECT time_in
                   FROM  timesheets_timesheet
                   WHERE timesheets_timesheet.timesheet_id = :timesheet_id";

        $stmt = $dbConn->prepare($sqlQuery);
        $stmt->execute(array(':timesheet_id' => $timesheet_id));
        $rows = $stmt->fetchObject();

        // Check the query returned some results
        if($stmt->rowCount() > 0){
            $time_in = $rows->time_in;

        } else{
            $time_in = null;
        }

        // Log the exception
    } catch(Exception $e){
        $retval =  "<p>Query failed: " . $e->getMessage() . "</p>\n";
        $time_in = null;
    }

    return $time_in;
}

function getTimeOut($dbConn, $timesheet_id){
    // Try to carry out the database search
    try{
        $sqlQuery = "SELECT time_out
                   FROM  timesheets_timesheet
                   WHERE timesheets_timesheet.timesheet_id = :timesheet_id";

        $stmt = $dbConn->prepare($sqlQuery);
        $stmt->execute(array(':timesheet_id' => $timesheet_id));
        $rows = $stmt->fetchObject();

        // Check the query returned some results
        if($stmt->rowCount() > 0){
            $time_out = $rows->time_out;

        } else{
            $time_out = null;
        }

        // Log the exception
    } catch(Exception $e){
        $retval =  "<p>Query failed: " . $e->getMessage() . "</p>\n";
        $time_out = null;
    }

    return $time_out;
}

// Validate post data
function validateUpdatetimesheetForm($dbConn){
    // Create an array of inputs and errors
    $input = array();
    $errors = array();

    /* Get the array of timesheet ids*/
    $validtimesheetIDs = getTimesheetIDs($dbConn);

    /* ID validation */
    $input['timesheet_id'] = filter_has_var(INPUT_POST, 'timesheet_id') ? $_POST['timesheet_id']: null;
    $input['timesheet_id'] = trim($input['timesheet_id']);
    $input['timesheet_id'] = filter_var($input['timesheet_id'], FILTER_VALIDATE_INT) ? $input['timesheet_id'] : null;
    $input['timesheet_id'] = in_array($input['timesheet_id'], $validtimesheetIDs) ? $input['timesheet_id']  : null;

    if(empty($input['timesheet_id'])){
        $errors[] = "There is a problem with the timesheet you are trying to edit.";

    }

    /* timesheet validation */
    $input['update_activity_id'] = filter_has_var(INPUT_POST, 'update_activity_id') ? $_POST['update_activity_id']: null;
    $input['update_activity_id'] = trim($input['update_activity_id']);

    $input['update_project_id'] = filter_has_var(INPUT_POST, 'update_project_id') ? $_POST['update_project_id']: null;
    $input['update_project_id'] = trim($input['update_project_id']);

    $input['update_time_in'] = filter_has_var(INPUT_POST, 'update_time_in') ? $_POST['update_time_in']: null;
    $input['update_time_in'] = trim($input['update_time_in']);

    $input['update_time_out'] = filter_has_var(INPUT_POST, 'update_time_out') ? $_POST['update_time_out']: null;
    $input['update_time_out'] = trim($input['update_time_out']);

    $input['update_date'] = filter_has_var(INPUT_POST, 'update_date') ? $_POST['update_date']: null;
    $input['update_date'] = trim($input['update_date']);

    if(empty($input['update_time_in'])){
        $errors[] = "You have not entered a valid start time.";

    }
    if (empty($input['update_time_out'])){
        $errors[] = "You have not entered a valid end time.";
    }

    if (empty($input['update_date'])){
        $errors[] = "You have not entered a valid date.";
    }
    // Return an array of the input and errors arrays
    return array($input, $errors);
}


function validateDeleteTimesheetForm($dbConn){
    // Create an array of inputs and errors
    $input = array();
    $errors = array();

    /* Get the array of timesheet ids*/
    $validtimesheetIDs = getTimesheetIDs($dbConn);

    /* ID validation */
    $input['timesheet_id'] = filter_has_var(INPUT_POST, 'timesheet_id') ? $_POST['timesheet_id']: null;
    $input['timesheet_id'] = trim($input['timesheet_id']);
    $input['timesheet_id'] = filter_var($input['timesheet_id'], FILTER_VALIDATE_INT) ? $input['timesheet_id'] : null;
    $input['timesheet_id'] = in_array($input['timesheet_id'], $validtimesheetIDs) ? $input['timesheet_id']  : null;

    if(empty($input['timesheet_id'])){
        $errors[] = "There is a problem with the timesheet you are trying to delete.";

    }

    // Return an array of the input and errors arrays
    return array($input, $errors);
}

function getTimesheetIDs($dbConn){
    // Try to carry out the database search
    try{
        $sqlQuery = "SELECT timesheet_id
                   FROM timesheets_timesheet";

        $stmt = $dbConn->prepare($sqlQuery);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        $timesheet_ids = array();

        // Check the query returned some results
        if($stmt->rowCount() > 0){

            // Loop through resultsstmt
            foreach($rows as $row){
                array_push($timesheet_ids, $row['timesheet_id']);
            }
        }
        // Log the exception
    } catch(Exception $e){
        $retval =  "<p>Query failed: " . $e->getMessage() . "</p>\n";
    }

    return $timesheet_ids;
}


function setTimesheet($dbConn, $input){
    $timesheet_id = $input['timesheet_id'];
    $date = $input['update_date'];
    $activity_id = $input['update_activity_id'];
    $project_id = $input['update_project_id'];
    $time_in = $input['update_time_in'];
    $time_out = $input['update_time_out'];


    // Try to carry out the database entries
    try{
        $sqlInsert = "UPDATE timesheets_timesheet 
                     SET    activity_id = :activity_id,
                            project_id = :project_id,
                            timesheets_timesheet.date = :timesheet_date,
                            time_in = :time_in,
                            time_out = :time_out
                   WHERE timesheet_id = :timesheet_id";

        $stmt = $dbConn->prepare($sqlInsert);
        $stmt->execute(array(':activity_id' => $activity_id,
            ':project_id' => $project_id,
            ':timesheet_date' => $date,
            ':time_in' => $time_in,
            ':time_out' => $time_out,
            ':timesheet_id' => $timesheet_id));

        // If the query worked display message to user
        if ($stmt){
            return true;
        }

    } catch(Exception $e){
        $retval =  "<p>Query failed: " . $e->getMessage() . "</p>\n";
    }

    return false;
}


function deleteTimesheet($dbConn, $input){
    $timesheet_id = $input['timesheet_id'];

    // Try to carry out the database entries
    try{
        $sqlDelete = "DELETE FROM timesheets_timesheet 
                        WHERE timesheet_id = :timesheet_id";

        $stmt = $dbConn->prepare($sqlDelete);
        $stmt->execute(array(':timesheet_id' => $timesheet_id));

        // If the query worked display message to user
        if ($stmt){
            return true;
        }

    } catch(Exception $e){
        $retval =  "<p>Query failed: " . $e->getMessage() . "</p>\n";
    }

    return false;
}

function createTimesheet($dbConn, $input){
    $timesheet = $input['timesheet'];

    // Try insert into database
    try {
        $sql = "INSERT INTO timesheets_timesheet (timesheet_name)
              VALUES('$timesheet')";
        // Prepare SQL statement
        $createtimesheetStmt = $dbConn->prepare($sql);
        // Execute statement
        $createtimesheetStmt->execute();

        // return true if query worked
        if ($createtimesheetStmt) {
            return true;
        }
    } catch (Exception $e) {
        $retval = "<p>Query failed: " . $e->getMessage() . "</p>\n";
    }
    // Return false if query failed
    return false;
}