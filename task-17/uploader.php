<?php
  
  $host = 'localhost';
  $dbname = 'todo';
  $username = 'root';
  $pass = '';
  
  $db = new PDO("mysql:host=$host;dbname=$dbname;", $username, $pass);
  $sql = "insert into images (image_name) values (:image)";
  
  $image = $_FILES['file'];
  $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
  $imageName = uniqid() . ".$ext";
  
  move_uploaded_file($image['tmp_name'], "upload/$imageName");
  
  $stmt = $db->prepare($sql);
  $stmt->execute(['image' => $imageName]);
  
  header('Location: ./task_17.php');
  