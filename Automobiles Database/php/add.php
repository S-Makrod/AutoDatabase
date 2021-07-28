<?php
    session_start();
    require_once "pdo.php";
    $make = "";
    $year = "";
    $mileage = "";
    $model = "";

    if(!isset($_SESSION['name']) || strlen($_SESSION['name']) < 1)  die("ACCESS DENIED");

    if(isset($_POST['action']) && $_POST['action'] == "Cancel") {
        unset($_SESSION['make']);
        unset($_SESSION['model']);
        unset($_SESSION['year']);
        unset($_SESSION['mileage']);
        header('Location: index.php'); 
        return;
    }

    if(isset($_POST['action']) && isset($_POST['model']) && isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])){
        $make = $_POST['make'];
        $year = $_POST['year'];
        $mileage = $_POST['mileage'];
        $model = $_POST['model'];
        $_SESSION['make'] = $make;
        $_SESSION['model'] = $model;
        $_SESSION['year'] = $year;
        $_SESSION['mileage'] = $mileage;

        if(strlen($make) < 1 || strlen($model) < 1 || strlen($mileage) < 1 || strlen($year) < 1) {
            $_SESSION['error'] = "All fields are required\n";
            header("Location: add.php");
            return;
        } else if(!is_numeric($mileage) || !is_numeric($year)) {
            $_SESSION['error'] = "Mileage and Year must be integers\n";
            header("Location: add.php");
            return;
        } else {
            $stmt = $pdo->prepare('INSERT INTO autos(make, model, year, mileage) VALUES ( :mk, :md, :yr, :mi)');
            $stmt->execute(array(':mk' => $make, ':md' => $model, ':yr' => $year, ':mi' => $mileage));
            $_SESSION['success'] = "Record added\n";
            unset($_SESSION['make']);
            unset($_SESSION['model']);
            unset($_SESSION['year']);
            unset($_SESSION['mileage']);
            header("Location: index.php");
            return;
        }
    }
    
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Saad Makrod Add</title>

	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<h1> 
        <?php
            echo "Tracking Autos for ";
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

    <?php
        if(isset($_SESSION['make'])) $make = $_SESSION['make'];
        if(isset($_SESSION['model'])) $model = $_SESSION['model'];
        if(isset($_SESSION['year'])) $year = $_SESSION['year'];
        if(isset($_SESSION['mileage'])) $mileage = $_SESSION['mileage'];
    ?>
		
    <form method="post">
        Make: <input type="text" id="make" name="make" value="<?= htmlentities($make)?>"> <br>
        Model: <input type="text" id="model" name="model" value="<?= htmlentities($model)?>"> <br>
        Year: <input type="text" id="year" name="year" value="<?= htmlentities($year)?>"> <br>
        Mileage: <input type="text" id="mileage" name="mileage" value="<?= htmlentities($mileage)?>"> <br>
        <input type="submit" name="action" value="Add">
        <input type="submit" name="action" value="Cancel">
    </form>
</body>
</html>