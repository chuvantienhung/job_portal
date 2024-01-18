<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jobTitle = $_POST['name'];
    $jobDescription = $_POST['description'];
    $jobLocation = $_POST['location'];
    $jobSalary = $_POST['salary'];
    $jobTimeOfDay = $_POST['time_of_day'];

    $sql = "INSERT INTO jobs (name, description, location, salary, time_of_day) VALUES ('$jobTitle', '$jobDescription', '$jobLocation', '$jobSalary', '$jobTimeOfDay')";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
