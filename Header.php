

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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </head>
<style>

.vijaylogo {
    height: 51px !important;
 
}
#ajax_loader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #f5f5f5;
    z-index: 9999999;
    opacity: 0.8;
}
  </style>

    <body>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <div id="ajax_loader" style="display: none;"><div id="status"><div class="spinner"></div></div></div>


<?php include "Topmenubar.php"; ?>





   
   


      