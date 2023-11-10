<?php
include 'connection.php';

$condition = "";
$keyword = "";
if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    //* QUESTION #8.d TODO here
    $condition = "WHERE players_tbl.name LIKE '%$keyword%' OR teams_tbl.name LIKE '%$keyword%' OR teams_tbl.abbr LIKE '%$keyword%'";
}

//* QUESTION #8.a TODO here
// Run query statement
// return MYSQLI RESULT OBJECT
$statement = "SELECT players_tbl.*, teams_tbl.abbr
              FROM players_tbl
              LEFT JOIN teams_tbl ON players_tbl.team_id = teams_tbl.id
              $condition
              ORDER BY players_tbl.name ASC";
$playerResults = mysqli_query($conn, $statement);
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
<div class="container-fluid mt-3">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Players</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container-fluid mt-4">
    <div class="container">
        <!-- //* QUESTION #8.b MAKE THIS PLAYER COUNT DYNAMIC BASED ON THE TOTAL PLAYERS STORED ON THE DATABASE -->
        <h3 class="mb-3">List of players (<?php echo $playerCount; ?>)</h3>
        <form class="mb-3" action="players.php" method="GET">
            <div class="d-flex flex-row align-items-center">
                <div class="form-group me-2">
                    <label>Search</label>
                </div>
                <div class="form-group me-2">
                    <input type="text" class="form-control" style="width: 450px;" placeholder="Search player name, team name and abbreviation..." name="keyword" value="<?php echo $keyword; ?>">
                </div>
                <div class="form-group me-2">
                    <label></label>
                    <button class="btn btn-primary">Search</button>
                </div>
                <?php
                if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
                    echo '
                                    <div class="form-group">
                                        <label></label>
                                        <a class="btn btn-secondary" href="players.php">Clear search</a>
                                    </div>
                                ';
                }
                ?>
            </div>
        </form>
        <table class="table table-light table-striped">
            <thead>
            <tr>
                <th class="table-dark" scope="col">#</th>
                <th class="table-dark" scope="col">Name</th>
                <th class="table-dark" scope="col">Position</th>
                <th class="table-dark" scope="col">Team</th>
                <th class="table-dark" scope="col">Height</th>
                <th class="table-dark" scope="col">Weight</th>
                <th class="table-dark text-center" scope="col">Total Players</th>
                <th class="table-dark" scope="col"></th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            <?php
            if ($playerCount) {
                $i = 1;
                while ($row = mysqli_fetch_assoc($playerResults)) {
                    $playerAvatar = file_exists('assets/players/' . $row['name'] . '.png') ? $row['name'] : 'default';
                    $teamLogo = file_exists('assets/teams/' . $row['abbr'] . '.png') ? $row['abbr'] : 'logo';
                    //* QUESTION #8.c TODO here
                    // SHOW ALL PLAYERS HERE USING TEMPLATES ABOVE
                    echo '
                            <tr>
                                <th scope="row">' . $i . '</th>
                                <td><img src="assets/players/' . $playerAvatar . '.png" height="36"> ' . $row['name'] . ' #' . $row['jersey'] . '</td>
                                <td>' . $row['position'] . '</td>
                                <td><img src="assets/teams/' . $teamLogo . '.png" height="36"> ' . $row['abbr'] . '</td>
                                <td>' . $row['height'] . ' m</td>
                                <td>' . $row['weight'] . ' kg</td>
                                <td class="text-center">
                                    <a class="btn btn-primary" href="team_profile.php?id=' . $row['team_id'] . '">View Team</a>
                                </td>
                            </tr>
                        ';
                    $i++;
                }
            } else {
                echo '<tr><td colspan="8" class="text-center">No players found.</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</html>
