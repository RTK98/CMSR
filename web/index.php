<?php 
$home='active';
?>

<?php ob_start(); ?>
<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<?php include 'home.php'; ?>
<?php include 'footer.php'; ?>

<?php // print_r($_SESSION); ?>


<?php ob_end_flush(); ?>
