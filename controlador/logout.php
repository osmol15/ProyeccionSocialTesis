<?php 
    session_start(); 
    // remove all session variables
    session_unset(); 
    session_destroy(); //destruyo la sesion
  
    header('location: ../vista/index.php'); 
?>    
  