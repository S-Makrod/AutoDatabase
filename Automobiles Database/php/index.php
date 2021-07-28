<?php
    session_start();
    require_once 'pdo.php';
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>

	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<h1>Welcome to Automobiles Database</h1>

    <?php
        if(!isset($_SESSION['name'])){
            echo "<p>";
            echo "<a href='login.php'>Please Sign In</a> <br> <br>";
            echo "Attempt to go to <a href='edit.php'>edit</a> without log in. <br>";
            echo "Attempt to go to <a href='add.php'>add</a> without log in. <br>";
            echo "Attempt to go to <a href='delete.php'>delete</a> without log in.";
            echo "</p>\n";
        } else {
            echo "<p>";
            echo "Welcome ";
            echo htmlentities($_SESSION['name']);
            echo "</p>\n";
            if(isset($_SESSION['success'])) {
                echo "<p id='insert'> ";
                echo htmlentities($_SESSION['success']); 
                echo " </p>";
                unset($_SESSION['success']);
            }

            if(isset($_SESSION['error'])) {
                echo "<p id='message'> ";
                echo htmlentities($_SESSION['error']);
                echo " </p>";
                unset($_SESSION['error']);
            }
            
            $stmt = $pdo->query("SELECT make, model, year, mileage, autos_id FROM  autos");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row === false) echo "No rows found";
            else {
                echo "<table>\n";
                echo "<tr><th>Make</th><th>Model</th><th>Year</th><th width>Mileage</th><th>Action</th></tr>\n";
                while($row !== false){
                    echo "<tr><td>";
                    echo(htmlentities($row['make']));
                    echo("</td><td>");
                    echo(htmlentities($row['model']));
                    echo("</td><td>");
                    echo(htmlentities($row['year']));
                    echo("</td><td>");
                    echo(htmlentities($row['mileage']));
                    echo("</td><td>");
                    echo('<a href="edit.php?autos_id='.$row['autos_id'].'">Edit</a> / ');
                    echo('<a href="delete.php?autos_id='.$row['autos_id'].'">Delete</a>');
                    echo("</td></tr>\n");
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                }
                echo "</table>\n";
            }
            echo "<p>";
            echo "<a href='add.php'>Add New Entry</a> <br> <br>";
            echo "<a href='logout.php'>Logout</a>";
            echo "</p>\n";
        }
    ?>

</body>
</html>