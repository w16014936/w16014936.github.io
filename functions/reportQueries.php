<?php
require_once 'env/environment.php';
require_once 'functions/functions.php';
require_once 'class/PDODB.php';

/**
 * SQL Query of all employee's timesheets totals for activity types.
 *
 * @return string
 */
function getAllEmployeeTime(){
    $query =
        "SELECT CONCAT(`forename`, ' ', `surname`) AS name, 
        (SELECT COALESCE(SUM(ROUND(TIME_TO_SEC(TIMEDIFF(timesheets_timesheet.time_out,timesheets_timesheet.time_in))/60/60,2)),0) 
        FROM timesheets_timesheet 
        JOIN timesheets_activity ON timesheets_activity.activity_id = timesheets_timesheet.activity_id 
        WHERE timesheets_activity.type = 'Normal' and timesheets_person.user_id = timesheets_timesheet.user_id) AS normal, 
        (SELECT COALESCE(SUM(ROUND(TIME_TO_SEC(TIMEDIFF(timesheets_timesheet.time_out,timesheets_timesheet.time_in))/60/60,2)),0) 
        FROM timesheets_timesheet 
        JOIN timesheets_activity ON timesheets_activity.activity_id = timesheets_timesheet.activity_id 
        WHERE timesheets_activity.type = 'Overtime' and timesheets_person.user_id = timesheets_timesheet.user_id) AS overtime,
        (SELECT COALESCE(SUM(ROUND(TIME_TO_SEC(TIMEDIFF(timesheets_timesheet.time_out,timesheets_timesheet.time_in))/60/60,2)),0) 
        FROM timesheets_timesheet 
        JOIN timesheets_activity ON timesheets_activity.activity_id = timesheets_timesheet.activity_id 
        WHERE timesheets_activity.type = 'Holiday' and timesheets_person.user_id = timesheets_timesheet.user_id) AS holiday,
        (SELECT COALESCE(SUM(ROUND(TIME_TO_SEC(TIMEDIFF(timesheets_timesheet.time_out,timesheets_timesheet.time_in))/60/60,2)),0) 
        FROM timesheets_timesheet 
        JOIN timesheets_activity ON timesheets_activity.activity_id = timesheets_timesheet.activity_id 
        WHERE timesheets_activity.type = 'Absent' and timesheets_person.user_id = timesheets_timesheet.user_id) AS absent,
        (SELECT COALESCE(SUM(ROUND(TIME_TO_SEC(TIMEDIFF(timesheets_timesheet.time_out,timesheets_timesheet.time_in))/60/60,2)),0) 
        FROM timesheets_timesheet 
        JOIN timesheets_activity ON timesheets_activity.activity_id = timesheets_timesheet.activity_id 
        WHERE timesheets_activity.type = 'Sick' and timesheets_person.user_id = timesheets_timesheet.user_id) AS sick
        FROM timesheets_person 
        JOIN timesheets_timesheet ON timesheets_person.user_id = timesheets_timesheet.user_id
        GROUP BY timesheets_person.user_id";

    return $query;
}

/**
 * @param $user_id
 * @return string
 */
function getEmployeeTime($user_id){
    $query =
        "SELECT CONCAT(`forename`, ' ', `surname`) AS name, 
        (SELECT COALESCE(SUM(ROUND(TIME_TO_SEC(TIMEDIFF(timesheets_timesheet.time_out,timesheets_timesheet.time_in))/60/60,2)),0) 
         FROM timesheets_timesheet JOIN timesheets_activity ON timesheets_activity.activity_id = timesheets_timesheet.activity_id 
         WHERE timesheets_person.user_id = timesheets_timesheet.user_id) as total,
        (SELECT COALESCE(SUM(ROUND(TIME_TO_SEC(TIMEDIFF(timesheets_timesheet.time_out,timesheets_timesheet.time_in))/60/60,2)),0) 
        FROM timesheets_timesheet 
        JOIN timesheets_activity ON timesheets_activity.activity_id = timesheets_timesheet.activity_id 
        WHERE timesheets_activity.type = 'Normal' and timesheets_person.user_id = timesheets_timesheet.user_id) AS normal, 
        (SELECT COALESCE(SUM(ROUND(TIME_TO_SEC(TIMEDIFF(timesheets_timesheet.time_out,timesheets_timesheet.time_in))/60/60,2)),0) 
        FROM timesheets_timesheet 
        JOIN timesheets_activity ON timesheets_activity.activity_id = timesheets_timesheet.activity_id 
        WHERE timesheets_activity.type = 'Overtime' and timesheets_person.user_id = timesheets_timesheet.user_id) AS overtime,
        (SELECT COALESCE(SUM(ROUND(TIME_TO_SEC(TIMEDIFF(timesheets_timesheet.time_out,timesheets_timesheet.time_in))/60/60,2)),0) 
        FROM timesheets_timesheet 
        JOIN timesheets_activity ON timesheets_activity.activity_id = timesheets_timesheet.activity_id 
        WHERE timesheets_activity.type = 'Holiday' and timesheets_person.user_id = timesheets_timesheet.user_id) AS holiday,
        (SELECT COALESCE(SUM(ROUND(TIME_TO_SEC(TIMEDIFF(timesheets_timesheet.time_out,timesheets_timesheet.time_in))/60/60,2)),0) 
        FROM timesheets_timesheet 
        JOIN timesheets_activity ON timesheets_activity.activity_id = timesheets_timesheet.activity_id 
        WHERE timesheets_activity.type = 'Absent' and timesheets_person.user_id = timesheets_timesheet.user_id) AS absent,
        (SELECT COALESCE(SUM(ROUND(TIME_TO_SEC(TIMEDIFF(timesheets_timesheet.time_out,timesheets_timesheet.time_in))/60/60,2)),0) 
        FROM timesheets_timesheet 
        JOIN timesheets_activity ON timesheets_activity.activity_id = timesheets_timesheet.activity_id 
        WHERE timesheets_activity.type = 'Sick' and timesheets_person.user_id = timesheets_timesheet.user_id) AS sick 
        FROM timesheets_person 
        JOIN timesheets_timesheet ON timesheets_person.user_id = timesheets_timesheet.user_id 
        WHERE timesheets_person.user_id = $user_id GROUP BY timesheets_person.user_id";

    return $query;
}


