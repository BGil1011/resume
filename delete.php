<?php
    include_once 'conexion.php';
    $stmt = $pdo->query('SELECT * FROM profile where profile_id = '.$_GET['id']);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!isset($_SESSION['user_id']) || !$stmt){
        header('Location: /login.php');
        return;
    }
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $stmt1 = $pdo->prepare('DELETE FROM profile where profile_id = '.$_POST['id']); 
        if($stmt1->execute()){
            header('Location: /index.php');
        }
    }



?>
    <title>Bryan Gil - DELETE</title>
</head>
<body>

        <p><strong>Name: </strong><?php echo $row['first_name'];?> <?php echo $row['last_name'] ?></p>
        <p><strong>E-mail: </strong><?php echo $row['email'] ?></p>
        <p> <strong>Headline: </strong> <?php echo $row['headline'] ?></p>
        <p> <strong>Sumary: </strong> <?php echo $row['summary'] ?></p>
    <form method="post">
        <input type="number" value="<?php echo $row['profile_id'] ?>" name="id" style="display: none;" >
        <button type="submit">Delete</button>
    </form>
<script>
    document.querySelector('button[type=submit]').addEventListener('click',(e)=>{
        const response =confirm("are you sure to delete this profile <?php echo $row['email'] ?>");
            if(!response){
                e.preventDefault();
            }
    });
        
    </script>
</body>
</html>