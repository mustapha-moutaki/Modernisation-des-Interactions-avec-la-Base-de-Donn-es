<?php
// Include the Database class file
include_once 'include/Database.php'; 

// Create an instance of the Database class
$db = new Database();

// CREATE: Insert a new record
$db->create("players", [
    "name" => "naymar",
    "position" => "cbl",
    "photo" =>'img2.jpg',
    "nationality_id" => '13',
    "club_id" => '24',
    "rating" => '33',
    "pace" => '43',
    "shooting" =>'53',
    "passing" =>'63',
    "dribling"=>'73',
    "defending"=>'83',
    "physical"	=>'93'
]);

// display player by his id
// $players = $db->read("players", ["player_id" => "9"]);
$players = $db->read("players");
// print_r($players);

//  update
$updated = $db->update("players", "name", "gon", "player_id", 68);

//  delete
// $db->delete("players", "player_id", 63);

// Display each player on a new line
foreach ($players as $player) {
    // echo "<br>"."player_id: "
    //         . $player['player_id']
    //         . " | - Name: " . $player['name'] 
    //         . " | - position: " . $player['position']
    //         . " | - photo: " .$player['photo']
    //         . " | - nationality_id: " .$player['nationality_id']
    //         . " | - club_id: " .$player['club_id']
    //         . " | - rating: " .$player['rating']
    //         . " | - pace: " .$player['pace']
    //         . " | - shooting: " .$player['shooting']
    //         . " | - passing: " .$player['passing'] 
    //         . " | - dribling: " .$player['dribling'] 
    //         . " | - defending: " .$player['defending']
    //         . " | - physical:| " .$player['physical'] .
    
    // "<br>";


    echo "<table border='1' style='width:100%; text-align:left;'>";
echo "<tr>
        <th>Player ID</th>
        <th>Name</th>
        <th>Position</th>
        <th>Photo</th>
        <th>Nationality ID</th>
        <th>Club ID</th>
        <th>Rating</th>
        <th>Pace</th>
        <th>Shooting</th>
        <th>Passing</th>
        <th>Dribbling</th>
        <th>Defending</th>
        <th>Physical</th>
      </tr>";

    echo "<tr>
            <td>" . $player['player_id'] . "</td>
            <td>" . $player['name'] . "</td>
            <td>" . $player['position'] . "</td>
            <td><img src='" . $player['photo'] . "' alt='" . $player['name'] . "' style='width:50px;'></td>
            <td>" . $player['nationality_id'] . "</td>
            <td>" . $player['club_id'] . "</td>
            <td>" . $player['rating'] . "</td>
            <td>" . $player['pace'] . "</td>
            <td>" . $player['shooting'] . "</td>
            <td>" . $player['passing'] . "</td>
            <td>" . $player['dribling'] . "</td>
            <td>" . $player['defending'] . "</td>
            <td>" . $player['physical'] . "</td>
          </tr>";echo "</table>";
}



?>



