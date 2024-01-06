<?php 
include_once 'conexion.php';

if(isset($_SESSION['user_id'])){
    header('Location: index.php');
    return;
}
if($_SERVER['REQUEST_METHOD']==='POST'){
    $salt =  'XyZzy12*_';
    foreach( $_POST as $key=>$value ){
        $_POST[$key] =htmlentities($value);
    }
    $check = hash('md5', $salt.$_POST['pass']);

     $stmt = $pdo->prepare('SELECT user_id, name FROM users WHERE email = :em AND password = :pw');

     $stmt->execute(array( ':em' => $_POST['email'], ':pw' => $check));

     $row = $stmt->fetch(PDO::FETCH_ASSOC);
     if ( $row !== false ) {

        $_SESSION['name'] = $row['name'];

        $_SESSION['user_id'] = $row['user_id'];

        header("Location: index.php");
        return;
     }
}


?>
   <title>Bryan Gil - LOGIN</title>
</head>
<body>
    <form method="post">
        <label for="email">Email</label>
        <input id="email" name="email">
        <label for="id_1723">Password</label>
        <input type="password" name="pass" id="id_1723">
     <button type="submit" onclick="return doValidate();" >Log In</button>
    </form>
    <script >
        function doValidate() {
         
         try {
             const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const email = document.getElementById('email').value;
            if(!regex.test(email)){
                 alert("invalid email address");
                 return false;
            }
             const pw = document.getElementById('id_1723').value;
             if (pw == null || pw == "") {
                 alert("Both fields must be filled out");
                 return false;
             }
             return true;
         } catch(e) {
             return false;
         }
         
     }
     
    </script>
</body>
</html>