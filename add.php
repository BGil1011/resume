<?php
include_once 'conexion.php';
if(!isset($_SESSION['user_id']))
{
    header('Location: /login.php');
    return;
}
if( $_SERVER['REQUEST_METHOD']==='POST'){
    $email = $pdo->query('SELECT * FROM profile WHERE email = '.$_POST['email']);
    $row = $email->fetch(PDO::FETCH_ASSOC);
    if($row) return;
    $stmt = $pdo->prepare('INSERT INTO Profile
    (user_id, first_name, last_name, email, headline, summary)
    VALUES ( :uid, :fn, :ln, :em, :he, :su)');
    foreach( $_POST as $key=>$value ){
        $_POST[$key] =htmlentities($value);
    }
    $stmt->execute(array(
    ':uid' => $_SESSION['user_id'],
    ':fn' => $_POST['fname'],
    ':ln' => $_POST['lname'],
    ':em' => $_POST['email'],
    ':he' => $_POST['headline'],
    ':su' => $_POST['summary'])
    );
    if($stmt){
        header('Location: index.php');
    }
}

?>
    <title>Bryan Gil - ADD</title>
</head>
<body>
    <form  method="post">
        <label for="fname">First Name</label>
        <input name="fname" id="fname" >
        <label for="lname">Last Name</label>
        <input name="lname" id="lname">
        <label for="email">E-mail</label>
        <?php if($row): ?>
            <p class="error">A perfil with this email exist</p>
        <?php endif; ?>
        <input name="email" id="email"  >
        <label for="head">Headline</label>
        <input id="head" name="headline" >
        <label for="summary">Sumary</label>
        <input name="summary" id="summary" >
        <button type="submit" onclick = "return Validate();">Add</button>
    </form>
    <script src="/validate.js"></script>
</body>
</html>