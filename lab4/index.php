<?php
    require_once dirname(__DIR__)."/lab4/connection.php";

    // Select query statement for all teams
    $statement = "SELECT * FROM `teams_tbl` ORDER BY `abbr`";

    // Select query statement for all players joined with teams
    $statement2 = "SELECT `T`.`abbr` `team_abbr`, `T`.`name` `team_name` , `PL`.`id` `player_id`, `PL`.`name` `player_name`, `PL`.`jersey` `player_jersey` FROM `players_tbl` `PL` LEFT JOIN `teams_tbl` `T` ON `PL`.`team` = `T`.`id`";

    // Run query statement
    // return MYSQLI RESULT OBJECT
    $teamResults = mysqli_query($conn, $statement);
    $playersResults = mysqli_query($conn, $statement2);

    $name = '';
    $jersey = '';
    $team = '';

    // For editing player details
    // Example URL: ?id=1&action=edit
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];

        // Select query statement to find player
        $statement3 = "SELECT name, jersey, team FROM `players_tbl` WHERE id=?";
        $stmt = mysqli_prepare($conn, $statement3);
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Run query statement
        mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);

        // Check if there are returned rows
        if(mysqli_num_rows($results) > 0) {
            while($row = $results->fetch_assoc()) {
                $team = $row["team"];
                $jersey = $row["jersey"];
                $name = $row["name"];
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <title>NBA Players</title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="container">
                <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
                    <a href="./" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                        <img class="me-2" src="assets/logo.png" height="36">
                        <span class="fs-4 fw-bold">NBA</span>
                    </a>
                </header>
                <h3>Create player</h3>
                <form action="crud.php" method="POST">
                    <?php
                        if(isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] === 'edit') {
                            if(isset($_GET['id']) && !empty($_GET['id'])) {
                                echo '<input type="hidden" name="id" value="' . $_GET['id'] . '">';
                            }
                        }
                    ?>
                    <input type="hidden" name="action" value="<?php echo (isset($_GET['action']) && !empty($_GET['action']) ? $_GET['action'] : 'create');?>">
                    <div class="mb-3">
                        <label for="playerName" class="form-label fw-bold">Player name</label>
                        <input type="text" name="playerName" class="form-control" placeholder="Type name..." value="<?php echo $name;?>">
                    </div>
                    <div class="mb-3">
                        <label for="jersey" class="form-label fw-bold">Jersey Number</label>
                        <input type="number" name="playerJerseyNumber" class="form-control" placeholder="Type jersey number..." value="<?php echo $jersey;?>">
                    </div>
                    <div class="mb-3">
                        <label for="team" class="form-label fw-bold">Team</label>
                        <select name="playerTeam" class="form-select">
                            <option value="" selected disabled>Select team...</option>
                            <?php
                                if($teamResults) {
                                    while($teamArray = mysqli_fetch_array($teamResults, MYSQLI_BOTH)) {
                                        echo '<option value="' . $teamArray['id'] . '" ' . ($teamArray['id'] == $team ? 'selected' : '') . '>' . $teamArray['abbr'] . ' - ' . $teamArray['name'] . '</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <?php
                        if(isset($_GET['action']) && !empty($_GET['action']) && $_GET['action'] === 'edit') {
                            if(isset($_GET['id']) && !empty($_GET['id'])) {
                                echo '<a class="btn btn-secondary btn-sm" href="./">Cancel Edit</a>';
                            }
                        }
                    ?>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </form>
                <hr>
                <!-- MAKE THIS PLAYERS COUNT DYNAMIC BASED ON THE TOTAL PLAYERS STORED ON THE DATABASE -->
                <h3>List of players (<?php echo mysqli_num_rows($playersResults) ?>)</h3>
                <div class="row mt-4 mb-4 gap-4">
                    <!-- MAKE THIS SAMPLE TEMPLATE DYNAMIC BASED ON PLAYERS STORED ON THE DATABASE -->
                    <?php
                        if($playersResults) {
                            while($playerArray = mysqli_fetch_array($playersResults, MYSQLI_BOTH)) {
                                echo '<div class="col-3 mb-3">
                                    <div class="card h-100" style="width: 18rem;">
                                        <div style="background-image: url(assets/teams/'.$playerArray["team_abbr"].'.png);">
                                            <img src="assets/players/'. (file_exists("assets/players/".$playerArray["player_name"].".png") ? $playerArray["player_name"] : "default") .'.png" class="card-img-top object-fit-cover" alt="'.$playerArray["player_name"].' picture">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">'.$playerArray["player_name"].' (#'.$playerArray["player_jersey"].')</h5>
                                            <p class="card-text"><img src="assets/teams/'.$playerArray["team_abbr"].'.png" alt="'.$playerArray["team_name"].' Logo" height="32"> '.$playerArray["team_name"].'</p>
                                            <a href="?id='.$playerArray["player_id"].'&action=edit" class="btn btn-primary">Edit</a>
                                            <a href="crud.php?id='.$playerArray["player_id"].'&action=delete" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>';
                            }
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</html>