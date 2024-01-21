<?php
// date_default_timezone_set('Your_Timezone'); // Set your desired timezone

// $currentDateTime = date('Y-m-d H:i:s');
$d = new DateTime();
$tz = new DateTimezone("Asia/Colombo");
$d->setTimezone($tz);
$currentDateTime = $d->format("Y-m-d H:i;s");

// Return the current date and time as JSON
$response = array(
    'datetime' => $currentDateTime
);

header('Content-Type: application/json');
echo json_encode($response);
