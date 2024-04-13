<?php

  session_start();

  $host = 'localhost';
  $dbname = 'todo';
  $username = 'root';
  $pass = '';

  $email = $_POST['email'];
  $password = $_POST['password'];

  $db = new PDO("mysql:host=$host;dbname=$dbname;", $username, $pass);
  $sql = 'select * from users where email = $email';
  $stm = $db->prepare($sql);
  $stm->execute([
    'email' => $email,
    'password' => $password
  ]);
  $user = $stm->fetch(PDO::FETCH_ASSOC);

  if (!empty($user)){
    $_SESSION['error'] = 'Такой пользователь уже сушествует';
    header('Location: ./create.php');
    exit();
  }

  $sql = 'insert into users (email, password) VALUES (:email, :password)';
  $stm = $db->prepare($sql);
  $stm->execute([
    'email' => $email,
    'password' => $password
  ]);