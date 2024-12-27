CREATE TABLE players(
    player_id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50),
    photo VARCHAR(255),
    position ENUM('gk', 'CBL', 'CBR', 'LB', 'RB', 'CML', 'CMR', 'LM', 'RM', 'STL', 'STR'),
    nationality_id INT NOT NULL,
    club_id INT NOT NULL,
    rating INT NOT NULL,
    PRIMARY KEY (player_id),

    pace INT NOT NULL,
    shooting INT NOT NULL,
    passing INT NOT NULL,
    dribling INT NOT NULL,
    defending INT NOT NULL,
    physical INT NOT NULL
);