<?php
  
  $host = 'localhost';
  $dbname = 'todo';
  $username = 'root';
  $pass = '';
  
  $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass );
  $sql = 'insert into tasks (`id`, `text`) values (NULL, :text)';
  $stm = $db->prepare($sql);
  $stm->execute($_POST);
  
  header('Location: ./task_10.php');