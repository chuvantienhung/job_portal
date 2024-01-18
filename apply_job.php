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
    $jobTime = $_POST['time'];

    $sql = "INSERT INTO jobs (name, description, location, salary, time) VALUES ('$jobTitle', '$jobDescription', '$jobLocation', '$jobSalary', ' $jobTime')";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
