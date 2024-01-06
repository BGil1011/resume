<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=misc',
'fred',
'zap');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">