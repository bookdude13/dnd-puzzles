# Description
This repository contains various puzzles that can be used within role playing game sessions. They were developed for our campaigns and will hopefully find some love in yours as well :)

# Setup
## Laragon
1. Install laragon
2. [Add php 7.x](https://forum.laragon.org/topic/166/tutorial-how-to-add-another-php-version-php-7-4-updated)

## Puzzles
2. Clone this repository into C:\laragon\www\dnd-puzzles
3. Start laragon
4. Navigate to localhost/dnd-puzzles/<puzzle-name>

## Database
Update the password in the query, then run these SQL commands in Laragon to set up the database, tables and user.

```
CREATE DATABASE IF NOT EXISTS dndpuzzles;
USE dndpuzzles;

CREATE USER IF NOT EXISTS dndpuzzles IDENTIFIED BY '<insert pass here>';
GRANT ALL ON dndpuzzles.* TO 'dndpuzzles'@'%';

CREATE TABLE IF NOT EXISTS twowaycombo_room (
    room_id CHAR(36) PRIMARY KEY,
    creation_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    wheel_0 VARCHAR(16) NOT NULL,
    wheel_1 VARCHAR(16) NOT NULL,
    wheel_2 VARCHAR(16) NOT NULL,
    wheel_3 VARCHAR(16) NOT NULL
);

CREATE TABLE IF NOT EXISTS twowaycombo_room_pair (
    room_id_a CHAR(36) PRIMARY KEY,
    room_id_b CHAR(36) NOT NULL,
    FOREIGN KEY (room_id_a) REFERENCES twowaycombo_room (room_id),
    FOREIGN KEY (room_id_b) REFERENCES twowaycombo_room (room_id)
);
```

## Config
- Copy the example_config.php file to config.php and update with your database user's credentials.
