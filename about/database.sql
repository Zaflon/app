-- CREATE TABLE colors

CREATE TABLE IF NOT EXISTS colors (
    id INT AUTO_INCREMENT,
    color VARCHAR(255) NOT NULL UNIQUE,
    hexadecimal VARCHAR(6) NOT NULL,
    created_at TIMESTAMP NOT NULL, 
    updated_at TIMESTAMP NOT NULL,
    deleted_at TIMESTAMP NOT NULL,
    PRIMARY KEY (id)
) ENGINE=INNODB;

INSERT INTO colors (color, hexadecimal, created_at, updated_at, deleted_at) VALUES ('White', 'FFFFFF', NOW(), NOW(), '0000-00-00 00:00:00');
INSERT INTO colors (color, hexadecimal, created_at, updated_at, deleted_at) VALUES ('Black', '000000', NOW(), NOW(), '0000-00-00 00:00:00');
INSERT INTO colors (color, hexadecimal, created_at, updated_at, deleted_at) VALUES ('Red', 'FF0000', NOW(), NOW(), '0000-00-00 00:00:00');
INSERT INTO colors (color, hexadecimal, created_at, updated_at, deleted_at) VALUES ('Green', '00FF00', NOW(), NOW(), '0000-00-00 00:00:00');
INSERT INTO colors (color, hexadecimal, created_at, updated_at, deleted_at) VALUES ('Blue', '0000FF', NOW(), NOW(), '0000-00-00 00:00:00');

---------------------------------------------------------------------------------------------------------------------------------------------

-- CREATE TABLE difficulties

CREATE TABLE IF NOT EXISTS difficulties (
    id INT AUTO_INCREMENT,
    detail VARCHAR(255) NOT NULL,
    color_id INT NOT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL,
    deleted_at TIMESTAMP NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (color_id)
        REFERENCES colors (id)
            ON UPDATE RESTRICT ON DELETE CASCADE
) ENGINE=INNODB;

---------------------------------------------------------------------------------------------------------------------------------------------

-- CREATE TABLE types

CREATE TABLE IF NOT EXISTS types (
    id INT AUTO_INCREMENT,
    detail VARCHAR (255),
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL,
    deleted_at TIMESTAMP NOT NULL,
    PRIMARY KEY (id)
) ENGINE=INNODB;

---------------------------------------------------------------------------------------------------------------------------------------------

-- CREATE TABLE users

CREATE TABLE IF NOT EXISTS persons (
    id INT AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    detail TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL,
    deleted_at TIMESTAMP NOT NULL,
    PRIMARY KEY (id)
) ENGINE=INNODB;

INSERT INTO persons (name, detail, created_at, updated_at, deleted_at) VALUES ('Wesley', 'Cadastro Simples', NOW(), NOW(), NOW());
INSERT INTO persons (name, detail, created_at, updated_at, deleted_at) VALUES ('Pedro', 'Cadastro Simples', NOW(), NOW(), NOW());
INSERT INTO persons (name, detail, created_at, updated_at, deleted_at) VALUES ('Maria Helena', 'Cadastro Simples', NOW(), NOW(), NOW());

---------------------------------------------------------------------------------------------------------------------------------------------

-- CREATE TABLE tasks

CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT,
    person_id INT NOT NULL,
    todo VARCHAR(255) NOT NULL,
    difficulty_id INT NOT NULL,
    type_id INT NOT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL,
    deleted_at TIMESTAMP NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (person_id)
        REFERENCES persons (id)
            ON UPDATE RESTRICT ON DELETE CASCADE,
    FOREIGN KEY (difficulty_id)
        REFERENCES difficulties (id)
            ON UPDATE RESTRICT ON DELETE CASCADE,
    FOREIGN KEY (type_id)
        REFERENCES types (id)
            ON UPDATE RESTRICT ON DELETE CASCADE
) ENGINE=INNODB;