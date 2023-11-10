<?php
    require_once dirname(__DIR__)."/lab4/connection.php";

    // CREATE && EDIT process
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        switch($_POST['action']) {
            case "create":
                if($_POST) {
                    // Assign formData values to variables
                    $playerName = $_POST['playerName'];
                    $playerJerseyNumber = $_POST['playerJerseyNumber'];
                    $playerTeam = $_POST['playerTeam'];

                    // INSERT Query Statement
                    $statement = "INSERT INTO `players_tbl` (`name`, `jersey`, `team`) VALUES (?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $statement);
                    mysqli_stmt_bind_param($stmt, "sis", $playerName, $playerJerseyNumber, $playerTeam);
            
                    // Run query statement
                    mysqli_stmt_execute($stmt);

                    // If query not success, output FAILED
                    if($stmt->error) {
                        echo "Error: " . $stmt->error;
                    }
                }
                break;
            case "edit":
                if($_POST) {
                    $id = $_POST['id'];
                    $playerName = $_POST['playerName'];
                    $playerJerseyNumber = $_POST['playerJerseyNumber'];
                    $playerTeam = $_POST['playerTeam'];

                    // INSERT Query Statement
                    $statement = "UPDATE `players_tbl` SET `name` = ?, `jersey` = ?, `team` = ? WHERE `id` = ?";
                    $stmt = mysqli_prepare($conn, $statement);
                    mysqli_stmt_bind_param($stmt, "siii", $playerName, $playerJerseyNumber, $playerTeam, $id);
            
                    // Run query statement
                    mysqli_stmt_execute($stmt);

                    // If query not success, output FAILED
                    if($stmt->error) {
                        echo "Error: " . $stmt->error;
                    }
                }
                break;
        }
    }

    // DELETE process
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        if(!isset($_GET['id']) && empty($_GET['id'])) {
            echo "Parameter error";
            exit;
        }

        // Assign identifier value to variable
        $id = $_GET["id"];

        // DELETE Query Statement
        $statement = "DELETE FROM `players_tbl` WHERE id=?";
        $stmt = mysqli_prepare($conn, $statement);
        mysqli_stmt_bind_param($stmt, "s", $id);

        // Run query statement
        mysqli_stmt_execute($stmt);

        // If query not success, output FAILED
        if($stmt->error) {
            echo "Error: " . $stmt->error;
        }
    }
        
    header('location: index.php');
?>
