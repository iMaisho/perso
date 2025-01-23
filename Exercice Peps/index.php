<?php session_start(); ?>
<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); ?>
<?php require_once(__DIR__ . '/header.php'); ?>
<div class="container">
<?php require_once(__DIR__ . '/devis_demande.php'); ?>
</div>
<?php require_once(__DIR__ . '/footer.php'); ?>
