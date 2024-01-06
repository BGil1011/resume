<?php
include_once 'conexion.php';
if(!isset($_SESSION['user_id'])){
    header('Location: /login.php');
    return;
}
$stmt = $pdo->query('SELECT * FROM profile where profile_id = '.$_GET['id']);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$row1 = false;
if($_SERVER['REQUEST_METHOD']==='POST'){
    foreach( $_POST as $key=>$value ){
        $_POST[$key] =htmlentities($value);
    }
    $email = $pdo->query('SELECT * FROM profile WHERE email = \''.$_POST['email']. '\' and profile_id != '.$_POST['id']);
    $row1 = $email->fetch(PDO::FETCH_ASSOC);
    if(!$row1)
    {    $stmt = $pdo->prepare('UPDATE Profile
        SET first_name = :fn, last_name =:ln, email=:em, headline=:he, summary=:su
        WHERE profile_id = :pid');
        var_dump($_POST);
        foreach( $_POST as $key=>$value ){
            $_POST[$key] =htmlentities($value);
        }
        $stmt->execute(array(
        ':pid'=> $_POST['id'],
        ':fn' => $_POST['fname'],
        ':ln' => $_POST['lname'],
        ':em' => $_POST['email'],
        ':he' => $_POST['headline'],
        ':su' => $_POST['summary'])
        );
        if($stmt){
            header('Location: index.php');
            return;
        }
    }
}
?>


    <title>Bryan Gil - EDIT</title>
</head>
<body>
    <form  method="post">
        <input type="number" style="display: none;" name="id" value="<?php echo $row['profile_id'];?>">
        <label for="fname">First Name</label>
        <input name="fname" id="fname" value="<?php echo $row['first_name'];?>" >
        <label for="lname">Last Name</label>
        <input value="<?php echo $row['last_name'] ?>" name="lname" id="lname" >
        <label for="email">E-mail</label>
        <input value="<?php echo $row['email'] ?>" name="email" id="email" >
        <?php if($row1): ?>
            <p class="error">A perfil with this email exist</p>
        <?php endif; ?>
        <label for="head">Headline</label>
        <input value="<?php echo $row['headline'] ?>" id="head" name="headline" >
        <label for="summary">Sumary</label>
        <input value="<?php echo $row['summary'] ?>" name="summary" id="summary" >
        <button type="submit" onclick="return Validate()" >Update</button>
    </form>
    <script src="/validate.js"></script>
</body>
</html>