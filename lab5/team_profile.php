<?php
include 'connection.php';

// GET ID 
$id = $_GET['id'];

//* QUESTION #7.a TODO here
// Run query statement to fetch team details based on GET id parameter
// return MYSQLI RESULT OBJECT
$teamStatement = "SELECT * FROM teams_tbl WHERE id = " . $id;
$teamResult = mysqli_query($conn, $teamStatement);
$team = mysqli_fetch_assoc($teamResult);

$teamLogo = "";
if (file_exists('assets/teams/' . $team['abbr'] . '.png')) {
    $teamLogo = '<img src="assets/teams/' . $team['abbr'] . '.png">';
} else {
    $teamLogo = '<img src="assets/logo.png" height="300">';
}

//* QUESTION #7.c TODO here
// Run query statement to fetch all players per team
// return MYSQLI RESULT OBJECT
$playerStatement = "SELECT * FROM players_tbl WHERE team_id = " . $id; 
$playerResults = mysqli_query($conn, $playerStatement);
$playerCount = mysqli_num_rows($playerResults);
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
<?php include_once 'partials/header.php'; ?>
<!-- //* QUESTION #7.b TODO-->
<div class="container-fluid mt-3">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="teams.php">Teams</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo ucwords($team['name']); ?></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-fluid bg-dark">
    <div class="container">
        <div class="d-flex flex-row align-items-center">
            <div class="me-3">
                <?php echo $teamLogo; ?>
            </div>
            <div>
                <h1 class="text-white"><?php echo ucwords($team['name']); ?></h1>
                <span class="badge bg-light text-dark"><?php echo ucfirst($team['abbr']); ?></span>
                <span class="badge bg-primary"><?php echo ucfirst($team['division']); ?> division</span>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt-4">
    <div class="container">
        <!-- //* QUESTION #7.d MAKE THIS PLAYERS COUNT DYNAMIC BASED ON THE TOTAL PLAYERS STORED ON THE DATABASE -->
        <h3 class="mb-3">Roster (<?php echo $playerCount; ?>)</h3>
        <div class="row mt-4 mb-4">
            <?php
            if ($playerCount > 0) {
                while ($player = mysqli_fetch_assoc($playerResults)) {
                    $playerAvatar = file_exists('assets/players/' . $player['name'] . '.png') ? $player['name'] : 'default';
                    //* QUESTION #7.e TODO here
                    // SHOW ALL PLAYERS OF SELECTED TEAM USING TEMPLATES ABOVE
                    echo '
                        <div class="col-3 mb-3">
                            <div class="card h-100" style="width: 18rem;">
                                <div style="background-image: url(assets/logo.png);">
                                    <img src="assets/players/' . $playerAvatar . '.png" class="card-img-top object-fit-cover" alt="' . $player['name'] . ' image">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">' . $player['name'] . ' (#' . $player['jersey'] . ')</h5>
                                    <p class="card-text">
                                        <span class="badge bg-dark">' . $player['position'] . '</span>
                                        <span class="badge bg-dark">' . $player['height'] . ' m</span>
                                        <span class="badge bg-dark">' . $player['weight'] . ' kg</span>
                                    </p>
                                    <a href="index.php?id=' . $player['id'] . '&action=edit" class="btn btn-primary">Edit</a>
                                    <a href="crud.php?id=' . $player['id'] . '&action=delete&team_id=' . $id . '" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    ';
                }
            } else {
                echo '<div class="col-12 text-center">No players found for this team</div>';
            }
            ?>
        </div>
    </div>
</div>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
