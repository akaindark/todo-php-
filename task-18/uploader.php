<?php
  
  $pdo = new PDO("mysql:host=localhost;dbname=todo", 'root', '');
  $sql = 'insert into images (id, image_name) VALUES (:id, :image_name)';
  $stmt = $pdo->prepare($sql);
  
  for ($i = 0; $i < count($_FILES['image']['name']); $i++){
    load_file($_FILES['image']['name'][$i], $_FILES['image']['tmp_name'][$i], $stmt);
  }
  
  function load_file($file_name, $path_name, $statement)
  {
    $image_name = uniqid() . '.' . pathinfo($file_name)['extension'];
    move_uploaded_file($path_name, "uploads/{$image_name}");
    $statement->execute([
      'id' => NULL,
      'image_name' => $image_name
    ]);
    
  }
  
  header('Location: ./task_19.php');
