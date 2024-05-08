<?php
// Function to calculate total hours worked
function calculateTotalHours($timein_morning, $timeout_morning, $timein_afternoon, $timeout_afternoon) {
    // Convert start and end time to DateTime objects
    $start = new DateTime($timein_morning);
    $end = new DateTime($timeout_afternoon);

    
    // Calculate the difference (in hours) between start and end times
    $hours = $end->diff($start)->h;

    return $hours-1; //this "return $hours-1" will not include the lunchbreak in office hours 12:00:00 to 13:00:00.
}

// Function to calculate total hours worked in the morning (before noon)
function calculateMorningHours($timein_morning, $timeout_morning) {
    // Convert start and end time to DateTime objects
    $start = new DateTime($timein_morning);
    $end = new DateTime($timeout_morning);

    // Set noon time as a DateTime object
    $noon = new DateTime('12:00:00');

    // Calculate morning hours
    if ($end <= $noon) {
        // If end time is before or exactly at noon
        $morning_hours = $end->diff($start)->h;
    } else {
        // If end time is after noon
        $morning_hours = $noon->diff($start)->h;
    }

    return $morning_hours;
}
 

// Function to calculate total hours worked in the afternoon (after noon)
function calculateAfternoonHours($timein_afternoon, $timeout_afternoon) {
    // Convert start and end time to DateTime objects
    $start = new DateTime($timein_afternoon);
    $end = new DateTime($timeout_afternoon);

    // Set noon time as a DateTime object
    $noon = new DateTime('13:00:00');

    // Calculate afternoon hours
    if ($start >= $noon) {
        // If start time is at or after noon
        $afternoon_hours = $end->diff($start)->h;
    } else {
        // If start time is before noon
        $afternoon_start = clone $noon;
        $afternoon_hours = $end->diff($afternoon_start)->h;

    }
    return $afternoon_hours;
    
}

// Example usage:
$timein_morning = "08:00:00"; // Start time (e.g., 8:00 AM)
$timeout_morning = "12:00:00";
$timein_afternoon = "13:00:00";
$timeout_afternoon = "17:00:00";   // End time (e.g., 5:00 PM)

$total_hours = calculateTotalHours($timein_morning, $timeout_morning, $timein_afternoon, $timeout_afternoon);
$morning_hours = calculateMorningHours($timein_morning, $timeout_morning);
$afternoon_hours = calculateAfternoonHours($timein_afternoon, $timeout_afternoon);

echo "Total hours worked in the morning: " . $morning_hours . " hours\n";
echo "<br>";
echo "Total hours worked in the afternoon: " . $afternoon_hours . " hours\n";
echo "<br>";
echo "Total hours worked in the day: " . $total_hours . " hours\n";
?>