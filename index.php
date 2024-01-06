<?php
include_once 'conexion.php';

$rows = $pdo->query('SELECT * FROM profile');


?>

    <title>Bryan Gil - INDEX</title>
</head>
<body>
    <?php if(isset($_SESSION['user_id'])): ?>
    <a href="/add.php">ADD</a>
    <a href="/logout.php">Logout</a>
    <?php else:?>
        <a href="/login.php">Login</a>
    <?php  endif; ?>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>E-mail</th>
                <th>Headline</th>
                <th>Sumary</th>
                <th>View</th>
                <?php if(isset($_SESSION['user_id'])):?>
                    <th>Edit</th>
                    <th>Delete</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
        <?php foreach($rows as $row ): ?>
                <tr>
                     <td><?php echo $row[2]; ?></td>
                     <td><?php echo $row[3]; ?></td>
                     <td><?php echo $row[4]; ?></td>
                     <td><?php echo $row[5]; ?></td>
                     <td><?php echo $row[6]; ?></td>
                     <td><a href="/view.php?id=<?php echo $row[0];?>">View</a></td>
                     <?php if(isset($_SESSION['user_id'])): ?> 
                     <td><a href="/edit.php?id=<?php echo $row[0];?>">EDIT</a></td>
                     <td><a id="delete" href="/delete.php?id=<?php echo $row[0];?>" >DELETE</a></td>
                     <?php endif; ?>
                </tr>
        <?php endforeach; ?>            
        </tbody>
    </table>
</body>
</html>