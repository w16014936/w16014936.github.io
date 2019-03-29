<?php

function getJobDepartments($dbConn)
{

    try {


        // Retrieve department ID's and names from database
        $departmentsSql = "SELECT department_id, department_name
                        FROM timesheets_department
                        ORDER BY department_name";

        // Execute the statement
        $departmentsStmt = $dbConn->prepare($departmentsSql);
        $departmentsStmt->execute();
        $departmentResults = $departmentsStmt->fetchAll();

        return $departmentResults;

    } catch (Exception $e) {
        $retval = "<p>Query failed: " . $e->getMessage() . "</p>\n";
    }

    return null;
}

function createJob($dbConn, $input)
{
    $departmentID = $input['departmentID'];
    $job = $input['job'];

    // Try insert into database
    try {
        $sql = "INSERT INTO timesheets_job (department_id, job_title)
                VALUES('$departmentID','$job')";
        // Prepare SQL statement
        $createJobStmt = $dbConn->prepare($sql);
        // Execute statement
        $createJobStmt->execute();

        // Return true if query worked
        if ($createJobStmt) {
            return true;
        }

    } catch (Exception $e) {
        $retval = "<p>Query failed: " . $e->getMessage() . "</p>\n";
        echo($retval);
    }

    // Return false if query failed
    return false;
}