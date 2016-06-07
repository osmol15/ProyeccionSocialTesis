<?php 
    session_start(); 
    session_destroy(); //destruyo la sesion
  
    header('location: ../index.php'); 
    
  