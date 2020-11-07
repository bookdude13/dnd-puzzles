# Requirements
- PHP 7+
- MySQL 8+
- Laragon

# Setup
## Database
```
CREATE DATABASE IF NOT EXISTS dndpuzzles;
USE dndpuzzles;

CREATE USER IF NOT EXISTS dndpuzzles IDENTIFIED BY '73uYEufYkytI8g8j';
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
    room_id_a CHAR(36),
    room_id_b CHAR(36),
    PRIMARY KEY (room_id_a, room_id_b),
    FOREIGN KEY (room_id_a) REFERENCES twowaycombo_room (room_id),
    FOREIGN KEY (room_id_b) REFERENCES twowaycombo_room (room_id)
);
```

