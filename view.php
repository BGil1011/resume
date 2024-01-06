<?php 
include_once 'conexion.php';
$stmt = $pdo->query('SELECT * FROM profile where profile_id = '.$_GET['id']);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
    <title>Bryan Gil - VIEW</title>
</head>
<body>
        
    <p><strong>Name: </strong><?php echo $row['first_name'];?> <?php echo $row['last_name'] ?></p>
    <p><strong>E-mail: </strong><?php echo $row['email'] ?></p>
    <p> <strong>Headline: </strong> <?php echo $row['headline'] ?></p>
    <p> <strong>Sumary: </strong> <?php echo $row['summary'] ?></p>
</body>
</html>