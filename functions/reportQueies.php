<?php
require_once 'env/environment.php';
require_once 'functions/functions.php';
require_once 'class/PDODB.php';

function getAllEmployeeTime(){
    $query = "SELECT timesheets_person.forename as name, 
(SELECT COALESCE(SUM(ROUND(TIME_TO_SEC(TIMEDIFF(timesheets_timesheet.time_out,timesheets_timesheet.time_in))/60/60,2)),0) FROM timesheets_timesheet WHERE timesheets_timesheet.activity_id = 1 and timesheets_person.user_id = timesheets_timesheet.user_id) as normal, 
(SELECT COALESCE(SUM(ROUND(TIME_TO_SEC(TIMEDIFF(timesheets_timesheet.time_out,timesheets_timesheet.time_in))/60/60,2)),0) FROM timesheets_timesheet WHERE timesheets_timesheet.activity_id = 3 and timesheets_person.user_id = timesheets_timesheet.user_id) as overtime,
(SELECT COALESCE(SUM(ROUND(TIME_TO_SEC(TIMEDIFF(timesheets_timesheet.time_out,timesheets_timesheet.time_in))/60/60,2)),0) FROM timesheets_timesheet WHERE timesheets_timesheet.activity_id = 4 and timesheets_person.user_id = timesheets_timesheet.user_id) as holiday 
FROM timesheets_person JOIN timesheets_timesheet ON timesheets_person.user_id = timesheets_timesheet.user_id GROUP BY timesheets_person.user_id";

    return $query;
}