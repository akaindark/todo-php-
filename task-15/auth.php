<?php
  session_start();
  
  $host = 'localhost';
  $dbname = 'todo';
  $username = 'root';
  $pass = '';
  
  $email = $_POST['email'];
  $password = $_POST['password'];

  $db = new PDO("mysql:host=$host;dbname=$dbname;", $username, $pass);
  $sql = 'select * from users where email = :email';
  $stm = $db->prepare($sql);
  $stm->execute(['email' => $email]);
  $user = $stm->fetch(PDO::FETCH_ASSOC);
  
  if (empty($user) || !password_verify($password, $user['password'])){
    $_SESSION['error'] = 'Неверный логин или пароль';
    header('Location: ./auth_form.php');
    exit();
  };
  
  $_SESSION['success'] = " {$user['email']} !";
  header('Location: ./index.php');