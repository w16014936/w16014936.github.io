<?php

function createProject($dbConn, $input)
{

    $project = $input['project'];

    // Try insert into database
    try {
        $sql = "INSERT INTO timesheets_project (project_name)
                 VALUES('$project')";
        // Prepare SQL statement
        $createProjectStmt = $dbConn->prepare($sql);
        // Execute statement
        $createProjectStmt->execute();

        // Return true if query worked
        if ($createProjectStmt) {
            return true;
        }
    } catch (Exception $e) {
        $retval = "<p>Query failed: " . $e->getMessage() . "</p>\n";
    }
    // Return false if query failed
    return false;

}