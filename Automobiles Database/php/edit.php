<?php
    session_start();
    require_once "pdo.php";

    if(!isset($_SESSION['name']) || strlen($_SESSION['name']) < 1)  die("ACCESS DENIED");

    if(isset($_POST['action']) && $_POST['action'] == "Cancel") {
        header('Location: index.php'); 
        return;
    }

    if(isset($_POST['action']) && isset($_POST['model']) && isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['autos_id'])){
        $make = $_POST['make'];
        $year = $_POST['year'];
        $mileage = $_POST['mileage'];
        $model = $_POST['model'];
        $id = $_POST['autos_id'];

        if(strlen($make) < 1 || strlen($model) < 1 || strlen($mileage) < 1 || strlen($year) < 1) {
            $_SESSION['error'] = "All fields are required\n";
            header("Location: edit.php");
            return;
        } else if(!is_numeric($mileage)) {
            $_SESSION['error'] = "Mileage must be an integer\n";
            header("Location: edit.php");
            return;
        } else if (!is_numeric($year)) {
            $_SESSION['error'] = "Year must be an integer\n";
            header("Location edit.php");
            return;
        } else {
            $stmt = $pdo->prepare('UPDATE autos SET make = :mk, model = :md, year = :yr, mileage = :mi WHERE autos_id = :id');
            $stmt->execute(array(':mk' => $make, ':md' => $model, ':yr' => $year, ':mi' => $mileage, ':id' => $id));
            $_SESSION['success'] = "Record updated\n";
            header("Location: index.php");
            return;
        }
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
	<title>Saad Makrod Edit</title>

	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<h1> 
        <?php
            echo "Editing Autos for ";
            echo htmlentities($_SESSION['name']);
            echo "\n"; 
        ?> 
    </h1>

    <?php
        if(isset($_SESSION['error'])) {
            echo "<p id='message'> ";
            echo htmlentities($_SESSION['error']);
            echo " </p>";
            unset($_SESSION['error']);
        }
    ?>
		
    <form method="post">
        Make: <input type="text" id="make" name="make" value="<?= htmlentities($row['make'])?>"> <br>
        Model: <input type="text" id="model" name="model" value="<?= htmlentities($row['model'])?>"> <br>
        Year: <input type="text" id="year" name="year" value="<?= htmlentities($row['year'])?>"> <br>
        Mileage: <input type="text" id="mileage" name="mileage" value="<?= htmlentities($row['mileage'])?>"> <br>
        <input type="hidden" name="autos_id" value="<?=$row['autos_id']?>">
        <input type="submit" name="action" value="Save">
        <input type="submit" name="action" value="Cancel">
    </form>
</body>
</html>