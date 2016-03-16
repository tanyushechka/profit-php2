CREATE TABLE users
(
  id         BIGINT(20) UNSIGNED PRIMARY KEY      NOT NULL,
  username   VARCHAR(30)                          NOT NULL,
  email      VARCHAR(30)                          NOT NULL,
  password   VARCHAR(32)                          NOT NULL,
  created_at DATETIME DEFAULT 'CURRENT_TIMESTAMP' NOT NULL,
  first_name VARCHAR(30)                          NOT NULL,
  last_name  VARCHAR(30)
);
CREATE UNIQUE INDEX id ON users (id);
CREATE UNIQUE INDEX username ON users (username);

INSERT INTO php2.users (id, username, email, password, created_at, first_name, last_name)
VALUES (1, 'ivan', 'ivan@example.com', 'Ivan_10', '2016-01-27 20:21:25', 'Иван', 'Иванов');
INSERT INTO php2.users (id, username, email, password, created_at, first_name, last_name)
VALUES (2, 'petr', 'petr@example.com', 'Petr_10', '2016-01-27 21:03:39', 'Петр', 'Петров');
INSERT INTO php2.users (id, username, email, password, created_at, first_name, last_name)
VALUES (3, 'sidor', 'sidor@example.com', 'Sidor_10', '2016-01-27 21:05:17', 'Сидор', 'Сидоров');
INSERT INTO php2.users (id, username, email, password, created_at, first_name, last_name)
VALUES (4, 'qwe', 'qwe@example.com', 'qwert', '2016-01-27 21:25:16', 'aA', 'DSXC');