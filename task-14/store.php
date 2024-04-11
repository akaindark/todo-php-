<?php
  
  session_start();
  
  
  $_SESSION['count']++;
  
  header('Location: ./task_14.php');
  