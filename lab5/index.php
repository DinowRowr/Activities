<?php
    include 'connection.php';
    // Select query statement for all teams
    $statement = "SELECT * FROM `teams_tbl` ORDER BY `abbr`";

    // Run query statement
    // return MYSQLI RESULT OBJECT
    $teamResults = mysqli_query($conn, $statement);
        
    $name = "";
    $jersey = "";
    $team = "";
    $position = "";
    $height = "";
    $weight = "";

    // For editing player details
    // Example URL: ?id=1&action=edit
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];

        // Select query statement to find player
        $statement2 = "SELECT * FROM players_tbl WHERE id = $id";
        // Run query statement
        $results = mysqli_query($conn, $statement2);

        // Check if there are returned rows
        if (mysqli_num_rows($results) > 0) {
            // Fetch the results and assign to variables above
            $row = mysqli_fetch_array($results, MYSQLI_BOTH);

            $name = $row['name'];
            $jersey = $row['jersey'];
            $team = $row['team_id'];
            //* QUESTION #4 TODO here
            $position = $row['position']; 
            $height = $row['height'];  
            $weight = $row['weight']; 
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/custom.css" rel="stylesheet">
        <title>NBA Players</title>
    </head>
    <body>
        <?php
            include_once 'partials/header.php';
        ?>
        <div class="container-fluid">
            <div class="container">
                <h3 class="mt-4">Create player</h3>
                <!-- //* QUESTION #3 Inside form tag -->
                <form method="POST" action="crud.php">
                    <?php
                    if (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] === 'edit') {
                        if (isset($_GET['id']) && !empty($_GET['id'])) {
                            echo '<input type="hidden" name="id" value="' . $_GET['id'] . '">';
                        }
                    }
                    ?>
                    <input type="hidden" name="action" value="<?php echo (isset($_GET['action']) && !empty($_GET['action']) ? $_GET['action'] : 'create'); ?>">
                    <div class="row mb-3">
                        <div class="form-group col-4">
                            <label for="playerName" class="form-label fw-bold">Player name</label>
                            <input type="text" class="form-control" name="name" placeholder="Type name..." value="<?php echo $name; ?>">
                        </div>
                        <div class="form-group col-4">
                            <label for="team" class="form-label fw-bold">Team</label>
                            <select class="form-select" name="team">
                                <option value="" selected disabled>Select team...</option>
                                <?php
                                if ($teamResults) {
                                    while ($teamArray = mysqli_fetch_array($teamResults, MYSQLI_BOTH)) {
                                        echo '<option value="' . $teamArray['id'] . '" ' . ($teamArray['id'] == $team ? 'selected' : '') . '>' . $teamArray['abbr'] . ' - ' . $teamArray['name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label for="jersey" class="form-label fw-bold">Jersey Number</label>
                            <input type="number" class="form-control" name="jersey" placeholder="Type jersey number..." value="<?php echo $jersey; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-4">
                            <label for="position" class="form-label fw-bold">Position</label>
                            <input type="text" class="form-control" name="position" placeholder="Type position..." value="<?php echo $position; ?>">
                        </div>
                        <div class="form-group col-4">
                            <label for="height" class="form-label fw-bold">Height (m)</label>
                            <input type="text" class="form-control" name="height" placeholder="Type height number..." value="<?php echo $height; ?>">
                        </div>
                        <div class="form-group col-4">
                            <label for="weight" class="form-label fw-bold">Weight (kg)</label>
                            <input type="text" class="form-control" name="weight" placeholder="Type weight number..." value="<?php echo $weight; ?>">
                        </div>
                    </div>
                    <?php
                    if (isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] === 'edit') {
                        if (isset($_GET['id']) && !empty($_GET['id'])) {
                            echo '<a class="btn btn-secondary btn-sm" href="./">Cancel Edit</a>';
                        }
                    }
                    ?>
                    <button class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </body>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</html>