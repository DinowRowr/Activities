<?php
include 'connection.php';

//* QUESTION #5 TODO inside this file
// CREATE && EDIT process
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($_POST['action']) {
        case "create":
            if ($_POST) {
                // Assign formData values to variables
                $name = $_POST['name'];
                $jersey = $_POST['jersey'];
                $team_id = $_POST['team'];

                $position = $_POST['position'];
                $height = $_POST['height'];
                $weight = $_POST['weight'];

                // INSERT Query Statement
                $statement = "INSERT INTO players_tbl (team_id, name, jersey, position, height, weight) VALUES ($team_id, '{$name}', $jersey, '{$position}', '{$height}', '{$weight}')";

                // Run query statement
                // If query not success, output FAILED
                if (mysqli_query($conn, $statement)) {
                    $player_id = mysqli_insert_id($conn);
                    header('location: team_profile.php?id=' . $team_id . '&player_id=' . $player_id);
                    exit;
                } else {
                    echo "FAILED";
                }
            }
            break;
        case "edit":
            if ($_POST) {
                // Assign formData values to variables
                $name = $_POST['name'];
                $jersey = $_POST['jersey'];
                $team_id = $_POST['team'];
                $player_id = $_POST['id'];

                $position = $_POST['position'];
                $height = $_POST['height'];
                $weight = $_POST['weight'];

                // UPDATE Query Statement
                $statement = "UPDATE players_tbl SET team_id = $team_id, name = '{$name}', jersey = $jersey, position = '{$position}', height = '{$height}', weight = '{$weight}' WHERE id = $player_id";

                // Run query statement
                // If query not success, output FAILED
                if (mysqli_query($conn, $statement)) {
                    header('location: team_profile.php?id=' . $team_id . '&player_id=' . $player_id);
                    exit;
                } else {
                    echo "FAILED";
                }
            }
            break;
    }
}

// DELETE process
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['id']) && empty($_GET['id'])) {
        echo "Parameter error";
        exit;
    }
    // Assign identifier value to variable
    $id = $_GET['id'];
    $team_id = $_GET['team_id'];
    // DELETE Query Statement
    $statement = "DELETE FROM players_tbl WHERE id = $id";
    // Run query statement
    // If query not success, output FAILED
    if (mysqli_query($conn, $statement)) {
        header('location: team_profile.php?id=' . $team_id);
        exit;
    } else {
        echo "FAILED";
    }
}

header('location: team_profile.php?id=' . $team_id);
?>
