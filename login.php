<?php
session_start();

// Function to validate user credentials
function authenticateUser($email, $password) {
    // Read user data from a file (or database) and validate
    $users = json_decode(file_get_contents('users.json'), true);

    foreach ($users as $user) {
        if ($user['email'] == $email && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            return true;
        }
    }

    return false;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    
    if (authenticateUser($email, $password)) {
        if ($_SESSION['user']['role'] == 'admin') {
            header('Location: admin.php');
        } else {
            header('Location: user.php');
        }
        exit();
    } else {
        header('Location: index.php');
        exit();
    }
}
