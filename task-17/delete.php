<?php
  
  $id = $_GET['id'];
  
  $db = new PDO("mysql:host=localhost;dbname=todo;", 'root', '');
  $sql = 'select image_name from images where id = :id';
  $stmt = $db->prepare($sql);
  $stmt->execute(['id' => $id]);
  $image = $stmt->fetch(PDO::FETCH_ASSOC);
  $image_path = "upload/{$image['image_name']}";
  
  if (file_exists($image_path)){
    unlink($image_path);
  }
  
  $sql = 'delete from images where id = :id';
  $stmt = $db->prepare($sql);
  $stmt->execute(['id'=> $id]);
  
  header('Location: ./task_17.php');