

<?php
include '../../../auto_load.php';
//p($_SESSION);exit;

if(!isset($_SESSION['EmpID']) && $_SESSION['Dcode']!='ADMIN'){
  header('Location:index.php');
}
?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Breeding Admin</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

       <link rel="shortcut icon" href="https://corporate.rasiseeds.com/corporate_demo/global/photos/favicon.ico" />

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">

    </head>
<style>

.vijaylogo {
    height: 51px !important;
 
}
  </style>

    <body>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

<?php include "Topmenubar.php"; ?>





   
   


      