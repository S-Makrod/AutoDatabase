<?php
    session_start();
    require_once "pdo.php";

    if(!isset($_SESSION['name']) || strlen($_SESSION['name']) < 1)  die("ACCESS DENIED");

    if(isset($_POST['action']) && $_POST['action'] == "Cancel") {
        header('Location: index.php'); 
        return;
    }

    if(isset($_POST['action']) && isset($_POST['autos_id'])){
        $stmt = $pdo->prepare('DELETE FROM autos WHERE autos_id = :id');
        $stmt->execute(array(':id' => $_POST['autos_id']));
        $_SESSION['success'] = "Record deleted\n";
        header("Location: index.php");
        return;
    }
    
    $stmt = $pdo->prepare("SELECT * FROM autos WHERE autos_id = :id");
    $stmt->execute(array(':id' => $_GET['autos_id']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row === false){
        $_SESSION['error'] = "Bad value for autos_id\n";
        header("Location: index.php");
        return;
    }
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Saad Makrod Delete</title>

	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<h1> 
        <?php
            echo "Deleteing Autos for ";
            echo htmlentities($_SESSION['name']);
            echo "\n"; 
        ?> 
    </h1>
		
    <p>
    <?php
            echo "Deleteing ";
            echo htmlentities($row['make']." ".$row['model']);
            echo " from the database. Are you sure?\n";
        ?> 
    </p>
    <form method="post">
        <input type="hidden" name="autos_id" value="<?=$row['autos_id']?>">
        <input type="submit" name="action" value="Delete">
        <input type="submit" name="action" value="Cancel">
    </form>
</body>
</html>