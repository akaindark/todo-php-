<?php
  session_start();
  
  $host = 'localhost';
  $dbname = 'todo';
  $username = 'root';
  $pass = '';
  
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  $db = new PDO("mysql:host=$host;dbname=$dbname;", $username, $pass);
  $sql = 'select * from users where email = :email and password = :password';
  $stm = $db->prepare($sql);
  $stm->execute([
    'email' => $email,
    'password' => $password
    ]);
  $user = $stm->fetch(PDO::FETCH_ASSOC);
  
  if (!empty($user)){
    $_SESSION['error'] = 'Этот эл адрес уже занят другим пользователем';
    header('Location: ./task_12.php');
    exit();
  }
  

  $sql = 'insert into users (email, password) values (:email, :password)';
  $stm = $db->prepare($sql);
  $tasks = $stm->execute([
    'email' => $email,
    'password' => $password
  ]);
  $_SESSION['success'] = 'Запись добавлена успешно';
  header('Location: ./task_12.php');

  
  
  