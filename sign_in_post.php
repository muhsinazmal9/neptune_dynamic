<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$encrypted_pass = md5($password);

$db_connect = mysqli_connect('localhost','root','','neptune_info');
$count_query = "SELECT COUNT(*) AS 'results' FROM users WHERE email='$email' AND password='$encrypted_pass'";
$select_final = mysqli_query($db_connect , $count_query);
$select_final_to_array = mysqli_fetch_assoc($select_final)['results'];
$flag = false;

if ($select_final_to_array==1) {
    $flag = true;
    header('location: dashboard.php');
} else {
    $_SESSION['login_info_error'] = 'Information is wrong. Check your email and password'; // note: create a variable and put msg there to better read
    header('location: sign_in.php');
}
?>