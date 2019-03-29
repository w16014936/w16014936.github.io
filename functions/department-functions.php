<?php


function createDepartment($dbConn, $input)
{
    $department = $input['department'];

    // Try insert into database
    try {


        $sql = "INSERT INTO timesheets_department (department_name)
              VALUES('$department')";
        // Prepare SQL statement
        $createDepartmentStmt = $dbConn->prepare($sql);
        // Execute statement
        $createDepartmentStmt->execute();

        // return true if query worked
        if ($createDepartmentStmt) {
            return true;
        }
    } catch (Exception $e) {
        $retval = "<p>Query failed: " . $e->getMessage() . "</p>\n";
    }
    // Return false if query failed
    return false;
}