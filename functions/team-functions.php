<?php

function getTeamDepartments($dbConn)
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

function createTeam($dbConn, $input)
{
    $departmentID = $input['departmentID'];
    $team = $input['team'];

    // Try insert into database
    try {
        $sql = "INSERT INTO timesheets_team (department_id, team_name)
                VALUES('$departmentID','$team')";
        // Prepare SQL statement
        $createTeamStmt = $dbConn->prepare($sql);
        // Execute statement
        $createTeamStmt->execute();

        // Return true if query worked
        if ($createTeamStmt) {
            return true;
        }

    } catch (Exception $e) {
        $retval = "<p>Query failed: " . $e->getMessage() . "</p>\n";
        echo($retval);
    }

    // Return false if query failed
    return false;
}