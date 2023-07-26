CREATE DATABASE documents
	CHARACTER SET utf8
	COLLATE utf8_hungarian_ci;

CREATE TABLE documents.categories (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL UNIQUE,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_hungarian_ci;

ALTER TABLE documents.categories 
  ADD UNIQUE INDEX name(name);

CREATE TABLE documents.publishers (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL UNIQUE,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_hungarian_ci;

ALTER TABLE documents.publishers 
  ADD UNIQUE INDEX name(name);

CREATE TABLE documents.roles (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_hungarian_ci;

ALTER TABLE documents.roles 
  ADD UNIQUE INDEX name(name);

CREATE TABLE documents.users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(20) NOT NULL,
  role_id INT(11) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_hungarian_ci;

ALTER TABLE documents.users 
  ADD UNIQUE INDEX name(name);

ALTER TABLE documents.users 
  ADD CONSTRAINT FK_users_role_id FOREIGN KEY (role_id)
    REFERENCES documents.roles(id) ON DELETE NO ACTION;

CREATE TABLE documents.documents (
  id INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  short_text VARCHAR(255) NOT NULL,
  logo_url VARCHAR(50) DEFAULT NULL,
  content VARCHAR(65535) DEFAULT NULL,
  role_id INT(11) DEFAULT NULL,
  publisher_id INT(11) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB;

ALTER TABLE documents.documents 
  ADD CONSTRAINT FK_documents_role_id FOREIGN KEY (role_id)
    REFERENCES documents.roles(id) ON DELETE NO ACTION;

ALTER TABLE documents.documents 
  ADD CONSTRAINT FK_documents_publisher_id FOREIGN KEY (publisher_id)
    REFERENCES documents.publishers(id) ON DELETE NO ACTION;

CREATE TABLE documents.categories_documents (
  id INT(11) NOT NULL AUTO_INCREMENT,
  category_id INT(11) NOT NULL,
  document_id INT(11) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
CHARACTER SET utf8,
COLLATE utf8_hungarian_ci;

ALTER TABLE documents.categories_documents 
  ADD CONSTRAINT FK_categories_documents_category_id FOREIGN KEY (category_id)
    REFERENCES documents.categories(id) ON DELETE NO ACTION;

ALTER TABLE documents.categories_documents 
  ADD CONSTRAINT FK_categories_documents_document_id FOREIGN KEY (document_id)
    REFERENCES documents.documents(id) ON DELETE NO ACTION;

ALTER TABLE documents.documents 
  ADD UNIQUE INDEX UK_documents(title, publisher_id);

ALTER TABLE documents.categories_documents 
  ADD UNIQUE INDEX UK_categories_documents(category_id, document_id);


INSERT INTO `categories` (`id`, `name`) 
  VALUES (NULL, 'intézkedési terv'), (NULL, 'utasítás'), (NULL, 'nyomtatvány'), (NULL, 'meghatalmazás');

INSERT INTO `publishers` (`id`, `name`) 
  VALUES (NULL, 'Ügyvezetés'), (NULL, 'HR osztály'), (NULL, 'Pénzügyi osztály'), (NULL, 'Igazgatóság');

INSERT INTO `roles` (`id`, `name`) 
VALUES (NULL, 'munkavállaló'), (NULL, 'HR asszisztens'), (NULL, 'titkárnő'), (NULL, 'admin'), (NULL, 'vezetőség');

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role_id`) VALUES 
  (NULL, 'Gizike', 'gizi12', 'gizi12p', '3'), 
  (NULL, 'János', 'janos', 'janosp', '2'), 
  (NULL, 'Tímea', 'timi', 'timip', '4'), 
  (NULL, 'Kata', 'kata', 'katap', '4');

INSERT INTO `documents` (`id`, `title`, `short_text`, `logo_url`, `content`, `role_id`, `publisher_id`) VALUES 
  (NULL, 'Kártya kiadás', 'Sed vitae lectus sapien..', NULL, 'Ez a kártya kiadásáról szóló dokumentum.', '3', '1'), 
  (NULL, 'Nyilatkozat', 'Új belépő esetén', NULL, 'Nyilatkozat\r\n\r\nAlulírott ................ nyilatkozom, hogy.................\r\n\r\n\r\n', '2', '2'), 
  (NULL, 'Pótszabadság igénylés', 'A munkavállaló által kezdeményezve', NULL, 'Pótszabadság igénylése\r\n\r\nAlulírott, ................, ... nap pótszabadságot igényelek.', NULL, '2'), 
  (NULL, 'Kiküldetési megbízás', 'Munkavállalók részére', NULL, 'Kiküldetési megbízás\r\n\r\n............ munkavállalót megbízzuk, hogy .................', NULL, '1');

UPDATE `documents` SET `role_id` = NULL WHERE `documents`.`id` = 3;
UPDATE `documents` SET `role_id` = NULL WHERE `documents`.`id` = 4;

INSERT INTO `categories_documents` (`id`, `category_id`, `document_id`) VALUES 
  (NULL, '1', '1'), 
  (NULL, '2', '1'), 
  (NULL, '3', '2'), 
  (NULL, '1', '3'), 
  (NULL, '3', '4');



