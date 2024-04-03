<?php
  session_start();
  
  $host = 'localhost';
  $dbname = 'todo';
  $username = 'root';
  $pass = '';
  
  $text = $_POST['text'];
  
  $db = new PDO("mysql:host=$host;dbname=$dbname;", $username, $pass);
  $sql = 'select * from tasks where text = :text';
  $stm = $db->prepare($sql);
  $stm->execute(['text' => $text]);
  $res = $stm->fetch(PDO::FETCH_ASSOC);
  
  if (!empty($res)){
    $_SESSION['error'] = 'Такая запись уже сушествует';
    header('Location: ./task_11.php');
  } elseif(empty($res)) {
    $sql = 'insert into tasks (`id`, `text`) values (NULL, :text)';
    $stm = $db->prepare($sql);
    $tasks = $stm->execute(['text' => $text]);
    $_SESSION['success'] = 'Запись добавлена успешно';
    header('Location: ./task_11.php');
  }
  
  
  