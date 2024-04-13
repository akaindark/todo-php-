<?php
  
  session_start();
  
  $_SESSION['user'] = 'Alexei';
  
  
  if (isset($_POST['logout'])){
    unset($_SESSION['user']);
    header('Location: ./task_16.php');
    die();
  }
  
  header('Location: ./task_16.php');