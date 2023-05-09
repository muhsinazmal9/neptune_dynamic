<?php 
session_start();


// variables
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$flag = false;
$pregma = preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/', $password);


if ($name) {
    $_SESSION['old_name'] = $name;
    $flag = true;
} else {
    $_SESSION['name_error'] = "Please give a name.";
    header('location:sign_up.php');
}


if ($email) {
    $_SESSION['old_email'] = $email;
    $flag = true;
} else {
    $_SESSION['email_error'] = "Please give a valid e-mail.";
    header('location:sign_up.php');
}


if ($password) {
    $_SESSION['old_pass'] = $password;
    $flag = true;
} else {
    $_SESSION['password_error'] = 'Please Give a Password';
    header('location:sign_up.php');
}


if ($confirm_password) {
    $_SESSION['old_confirm_pass'] = $confirm_password;
    $flag = true;
} else {
    $_SESSION['confirm_password_error'] = 'Please Give a Confirm Password';
    header('location:sign_up.php');
}


if ($password != $confirm_password) {
    $flag = true;
    $_SESSION['password_match_error'] = "Password doesn't match!";
    header('location:sign_up.php');
} else {
    if ($pregma != 1) {
        $flag = true;
        $_SESSION['password_match_error'] = "Please give a strong password (including capital letter, small letter, number, special character and minimum 8 character)";
        header('location:sign_up.php');
    } else {
        $encrypted_pass = md5($password);
        $db_connect = mysqli_connect('localhost','root','','neptune_info');
        $insert_query = "INSERT INTO users(name,email,password) VALUES('$name','$email','$encrypted_pass')"; // double string required. (inside single string)
        mysqli_query($db_connect , $insert_query);

        // success message
        $_SESSION['sign_in_success_msg'] = "$name! Your account created successfully.";

        header('location:sign_in.php');
    }
}
    ?>
