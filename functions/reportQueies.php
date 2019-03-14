<?php
require_once 'env/environment.php';
require_once 'functions/functions.php';
require_once 'class/PDODB.php';

function getAllEmployeeTime(){
    $query = "SELECT timesheets_person.forename as name, SUM(ROUND(TIME_TO_SEC(TIMEDIFF(timesheets_timesheet.time_out,timesheets_timesheet.time_in))/60/60,2)) as normal
                        FROM timesheets_timesheet
                        JOIN timesheets_user ON timesheets_user.user_id = timesheets_timesheet.user_id 
                        JOIN timesheets_person ON timesheets_user.user_id = timesheets_person.user_id
                        GROUP BY timesheets_timesheet.user_id, timesheets_timesheet.activity_id
                        ORDER BY timesheets_timesheet.user_id";

    return $query;
}