<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user';

    $user = [
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'role' => $role,
    ];

    $users = json_decode(file_get_contents('users.json'), true);

    $users[] = $user;

    file_put_contents('users.json', json_encode($users));

    header('Location: index.php');
    exit();
}
