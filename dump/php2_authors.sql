CREATE TABLE authors
(
  id   BIGINT(20) UNSIGNED NOT NULL,
  name VARCHAR(255)        NOT NULL
);
CREATE UNIQUE INDEX id ON authors (id);

INSERT INTO php2.authors (id, name) VALUES (1, 'Александр Панасенко');
INSERT INTO php2.authors (id, name) VALUES (2, 'Александр Серебряков');
INSERT INTO php2.authors (id, name) VALUES (3, 'Александр Пушкин');
INSERT INTO php2.authors (id, name) VALUES (4, 'Сулейман Рахманов');
INSERT INTO php2.authors (id, name) VALUES (5, 'Мак Робертсон');
INSERT INTO php2.authors (id, name) VALUES (7, 'сэр Тоби');
INSERT INTO php2.authors (id, name) VALUES (8, 'Павел Петров');
INSERT INTO php2.authors (id, name) VALUES (9, 'Карл Маркс');
