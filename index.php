<?php
// Include the Database class file
include_once 'include/Database.php'; 

// Create an instance of the Database class
$db = new Database();

// CREATE: Insert a new record
$db->create("players", [
    "name" => "naymar",
    "position" => "st",
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
    echo "<br>"."player_id: "
            . $player['player_id']
            . " | - Name: " . $player['name'] 
            . " | - position: " . $player['position']
            . " | - photo: " .$player['photo']
            . " | - nationality_id: " .$player['nationality_id']
            . " | - club_id: " .$player['club_id']
            . " | - rating: " .$player['rating']
            . " | - pace: " .$player['pace']
            . " | - shooting: " .$player['shooting']
            . " | - passing: " .$player['passing'] 
            . " | - dribling: " .$player['dribling'] 
            . " | - defending: " .$player['defending']
            . " | - physical:| " .$player['physical'] .
    
    "<br>";
}

?>



