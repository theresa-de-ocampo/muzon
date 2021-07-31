USE mysql;
DROP DATABASE IF EXISTS muzon;
CREATE DATABASE muzon;
USE muzon;

CREATE TABLE household (
	house_no CHAR(10) NOT NULL,
	street ENUM (
			'A. Bonifacio',
			'Callejon II',
			'D. Silang',
			'Diosomito',
			'E. Aguinaldo',
			'E. Balagtas',
			'E. Jacinto',
			'Lapu-Lapu',
			'Lopez',
			'M. Agoncillo',
			'M. Aquino'
		) NOT NULL,
	household_status ENUM (
			'Active',
			'Deleted'
		) DEFAULT 'Active' NOT NULL,

	CONSTRAINT pk_household PRIMARY KEY (house_no, street)
) Engine=InnoDB;

CREATE TABLE resident (
	resident_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	fname VARCHAR(50) NOT NULL,
	mname VARCHAR(50),
	lname VARCHAR(50) NOT NULL,
	sex ENUM (
			'Male',
			'Female'
		) NOT NULL,
	bday DATE NOT NULL,
	educ ENUM (
			'Some Elementary',
			'Elementary Graduate',
			'Some High School',
			'High School Graduate',
			'Some College',
			'College Graduate',
			'Vocational',
			'Advanced Degree',
			'N/A'
		) NOT NULL,
	occupation VARCHAR(50) NOT NULL,
	citizenship VARCHAR(30) DEFAULT 'Filipino' NOT NULL,
	religion ENUM (
			'Non-religious',
			'Christian',
			'Iglesia ni Cristo',
			'Islam',
			'Jehovah',
			'Roman Catholic',
			'Sabbath',
			'Others'
		) NOT NULL,
	contact_no CHAR(11) NOT NULL,
	civil_status ENUM (
			'Annulled',
			'Married',
			'Separated',
			'Single',
			'Widowed'
		) NOT NULL,
	resident_status ENUM (
			'Active',
			'Deleted'
		) DEFAULT 'Active' NOT NULL,
	house_no CHAR(10) NOT NULL,
	street ENUM (
			'A. Bonifacio',
			'Callejon II',
			'D. Silang',
			'Diosomito',
			'E. Aguinaldo',
			'E. Balagtas',
			'E. Jacinto',
			'Lapu-Lapu',
			'Lopez',
			'M. Agoncillo',
			'M. Aquino'
		) NOT NULL,

	CONSTRAINT fk_resident_household FOREIGN KEY (house_no, street)
		REFERENCES household (house_no, street)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
) Engine=InnoDB;

CREATE TABLE complainant_outsider (
	complainant_outsider_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	fname VARCHAR(50) NOT NULL,
	mname VARCHAR(50),
	lname VARCHAR(50) NOT NULL,
	contact_no CHAR(11) NOT NULL,
	house_no CHAR(10) NOT NULL,
	street VARCHAR(30) NOT NULL,
	barangay VARCHAR(30) NOT NULL,
	city_town VARCHAR(30) NOT NULL,
	provice VARCHAR(30)
) Engine=InnoDB;

CREATE TABLE blotter (
	blotter_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	date_time_reported DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	incident_date_time DATETIME NOT NULL,
	incident_place VARCHAR(255) NOT NULL,
	blotter_status ENUM (
			'Pending',
			'Settled',
			'Filed to Action'
		) DEFAULT 'Pending' NOT NULL,
	offense_subject VARCHAR(255) NOT NULL,
	incident_narrative VARCHAR(2000) NOT NULL,
	complained_resident_id INT UNSIGNED NOT NULL,
	guardian_complained_resident_id INT UNSIGNED, -- For children in conflict with the law
	complainant_resident_id INT UNSIGNED,
	complainant_outsider_id INT UNSIGNED,
	
	CONSTRAINT fk_blotter_complained_resident_id FOREIGN KEY (complained_resident_id)
		REFERENCES resident (resident_id)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	CONSTRAINT fk_blotter_guardian_complained_resident_id FOREIGN KEY (guardian_complained_resident_id)
		REFERENCES resident (resident_id)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	CONSTRAINT fk_blotter_complainant_resident_id FOREIGN KEY (complainant_resident_id)
		REFERENCES resident (resident_id)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	CONSTRAINT fk_blotter_complainant_outsider_id FOREIGN KEY (complainant_outsider_id)
		REFERENCES complainant_outsider (complainant_outsider_id)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
) Engine=InnoDB;

-- Setup of `resolution` table
CREATE TABLE resolution LIKE blotter;

ALTER TABLE resolution
CHANGE COLUMN blotter_id resolution_id INT UNSIGNED AUTO_INCREMENT NOT NULL;

ALTER TABLE resolution
ALTER blotter_status DROP DEFAULT;

ALTER TABLE resolution
ADD COLUMN resolution_narrative VARCHAR(2000) NOT NULL;

ALTER TABLE resolution
ADD COLUMN date_resolved DATE NOT NULL;

CREATE TABLE officer (
	officer_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	officer_position ENUM (
			'Captain',
			'Secretary',
			'Treasurer',
			'Chairman of Committee on Agriculture',
			'Chairman of Committee on Sports and Education',
			'Chairman of Committee on Health',
			'Chairman of Committee on Peace and Order',
			'Chairman of Committee on Environmental Protection',
			'Chairman of Committee on Budget and Appropriations',
			'Chairman of Committee on Public Works',
			'Youth Council Chairman'
		) NOT NULL,
	start_date DATE NOT NULL DEFAULT (CURDATE()),
	end_date DATE DEFAULT NULL,
	officer_status ENUM (
			'Current',
			'Past'
		) NOT NULL,
	resident_id INT UNSIGNED NOT NULL,

	CONSTRAINT fk_officer_resident_id FOREIGN KEY (resident_id)
		REFERENCES resident (resident_id)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
) Engine=InnoDB;

CREATE TABLE administrator (
	admin_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	admin_email VARCHAR(100) NOT NULL,
	admin_password VARCHAR(255) NOT NULL,
	officer_id INT UNSIGNED,

	CONSTRAINT fk_admin_officer_id FOREIGN KEY (officer_id)
		REFERENCES officer (officer_id)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
) Engine=InnoDB;

CREATE TABLE terminated_officer (
	terminated_officer_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	officer_position ENUM (
			'Captain',
			'Secretary',
			'Treasurer',
			'Chairman of Committee on Agriculture',
			'Chairman of Committee on Sports and Education',
			'Chairman of Committee on Health',
			'Chairman of Committee on Peace and Order',
			'Chairman of Committee on Environmental Protection',
			'Chairman of Committee on Budget and Appropriations',
			'Chairman of Committee on Public Works',
			'Youth Council Chairman'
		) NOT NULL,
	start_date DATE NOT NULL,
	date_terminated DATE NOT NULL,
	cause_of_termination ENUM (
			'Resignation',
			'Transfer of Residence',
			'Transfer of Place of Work',
			'Withdrawal of Appointment'
		) NOT NULL,
	termination_narrative VARCHAR(2000) NOT NULL,
	resident_id INT UNSIGNED NOT NULL,

	CONSTRAINT fk_terminated_officer_resident_id FOREIGN KEY (resident_id)
		REFERENCES resident (resident_id)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
) Engine=InnoDB;

CREATE TABLE post (
	post_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(255) NOT NULL,
	date_time_posted DATETIME NOT NULL DEFAULT (NOW()),
	content VARCHAR(2000) NOT NULL,
	image VARCHAR(255) NOT NULL,
	post_status ENUM (
			'Active',
			'Deleted',
			'Edited'
		) NOT NULL DEFAULT 'Active'
) Engine=InnoDB;

-- [TRIGGER] before_insert_blotter_complainant
DELIMITER $$
CREATE TRIGGER before_insert_blotter_complainant
BEFORE INSERT ON blotter
FOR EACH ROW
BEGIN
	IF 
		(NEW.complainant_resident_id IS NULL AND NEW.complainant_outsider_id IS NULL) OR
		(NEW.complainant_resident_id IS NOT NULL AND NEW.complainant_outsider_id IS NOT NULL)
	THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Complainant must only either be a local resident, or an outsider.';
	END IF;
END $$
DELIMITER ;

-- [TRIGGER] before_insert_blotter_complained
DELIMITER $$
CREATE TRIGGER before_insert_blotter_complained
BEFORE INSERT ON blotter
FOR EACH ROW
BEGIN
	DECLARE birthday DATE;
	DECLARE age INT UNSIGNED;

	SELECT
		bday INTO birthday 
	FROM
		resident
	WHERE
		resident_id = NEW.complained_resident_id;

	SELECT
		TIMESTAMPDIFF(YEAR, birthday, CURDATE())
	INTO age;

	IF age < 18 AND NEW.guardian_complained_resident_id IS NULL THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Underage complained resident must have a guardian.';
	END IF;
END $$
DELIMITER ;

-- [TRIGGER] before_insert_blotter
DELIMITER $$
CREATE TRIGGER before_insert_blotter
BEFORE INSERT ON blotter
FOR EACH ROW
BEGIN
	IF NEW.blotter_status != 'Pending' THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Newly reported cases should have a status of ''Pending''.';
	END IF;
END $$
DELIMITER ;

-- [TRIGGER] before_insert_officer
DELIMITER $$
CREATE TRIGGER before_insert_officer
BEFORE INSERT ON officer
FOR EACH ROW
BEGIN
	DECLARE n_curr_officers, taken INT UNSIGNED;

	IF NEW.officer_status = 'Current' THEN
		SELECT
			COUNT(officer_id) INTO n_curr_officers
		FROM
			officer
		WHERE
			officer_position = NEW.officer_position AND
			officer_status = 'Current';

		SELECT
			COUNT(officer_id) INTO taken
		FROM
			officer
		WHERE
			resident_id = NEW.resident_id AND
			officer_status = 'Current';

		IF n_curr_officers >= 1 THEN
			SIGNAL SQLSTATE '45000'
				SET MESSAGE_TEXT = 'There should only be one current officer per position.';
		END IF;

		IF taken >= 1 THEN
			SIGNAL SQLSTATE '45000'
				SET MESSAGE_TEXT = 'An officer can only hold one position per term.';
		END IF;
	END IF;
END $$
DELIMITER ;

-- [STORED PROCEDURE] get_complained_resident
DELIMITER $$
CREATE PROCEDURE get_complained_resident (
	IN p_resident_id INT UNSIGNED,
	OUT p_resident_name VARCHAR(100)
)
BEGIN
	SELECT
		CONCAT(fname, ' ', LEFT(mname, 1), '. ', lname) INTO p_resident_name
	FROM
		resident
	WHERE
		resident_id = p_resident_id;
END $$
DELIMITER ;

-- [STORED PROCEDURE] get_complainant
DELIMITER $$
CREATE PROCEDURE get_complainant (
	IN p_resident_id INT UNSIGNED,
	IN p_outsider_id INT UNSIGNED,
	OUT p_complainant_name VARCHAR(100)
)
BEGIN
	IF p_resident_id IS NOT NULL THEN
		SELECT
			CONCAT(fname, ' ', LEFT(mname, 1), '. ', lname) INTO p_complainant_name
		FROM
			resident
		WHERE
			resident_id = p_resident_id;
	ELSE
		SELECT
			CONCAT(fname, ' ', LEFT(mname, 1), '. ', lname) INTO p_complainant_name
		FROM
			complainant_outsider
		WHERE
			complainant_outsider_id = p_outsider_id;
	END IF;
END $$
DELIMITER ;

-- [STORED PROCEDURE] calculate_age
DELIMITER $$
CREATE PROCEDURE calculate_age (
	IN p_bday DATE,
	OUT p_age INT UNSIGNED
)
BEGIN
	SELECT
		TIMESTAMPDIFF(YEAR, p_bday, CURDATE())
	INTO
		p_age;
END $$
DELIMITER ;

-- [STORED PROCEDURE] get_admin_name
DELIMITER $$
CREATE PROCEDURE get_officer_admin (
	IN p_officer_id INT UNSIGNED,
	OUT p_admin_name VARCHAR(100),
	OUT p_admin_position VARCHAR(50)
)
BEGIN
	SELECT
		CONCAT(fname, ' ', LEFT(mname, 1), '. ', lname),
		officer_position
	INTO
		p_admin_name,
		p_admin_position
	FROM
		administrator
	INNER JOIN officer
		USING (officer_id)
	INNER JOIN resident
		USING (resident_id)
	WHERE
		officer_id = p_officer_id;
END $$
DELIMITER ;

-- [VIEW] curr_officers
CREATE VIEW curr_officers AS
SELECT
	officer_id,
	officer_position,
	CONCAT(fname, ' ', LEFT(mname, 1), '. ', lname) AS name
FROM
	officer
INNER JOIN
	resident USING (resident_id)
WHERE
	officer_status = 'Current';

-- [VIEW] past_officers
CREATE VIEW past_officers AS
SELECT
	officer_position,
	CONCAT(fname, ' ', LEFT(mname, 1), '. ',  lname) AS name,
	start_date,
	end_date
FROM
	officer
INNER JOIN resident
	USING (resident_id)
WHERE
	officer_status = 'Past'
UNION
SELECT
	officer_position,
	CONCAT(fname, ' ', LEFT(mname, 1), '. ', lname) AS name,
	start_date,
	date_terminated
FROM
	terminated_officer
INNER JOIN resident
	USING (resident_id);

-- [VIEW] terminated_officers
CREATE VIEW terminated_officers AS
SELECT
	officer_position,
	CONCAT(fname, ' ', LEFT(mname, 1), '. ', lname) AS name,
	cause_of_termination,
	start_date,
	date_terminated
FROM
	terminated_officer
INNER JOIN
	resident USING (resident_id);

-- [VIEW] officers_without_account
CREATE VIEW officers_without_account AS
SELECT
	officer_id,
	officer_position,
	CONCAT(fname, ' ', LEFT(mname, 1), '. ', lname) AS name
FROM 
	officer
LEFT JOIN administrator
	USING (officer_id)
INNER JOIN resident
	USING (resident_id)
WHERE
	officer_status = 'Current' AND
	administrator.officer_id IS NULL;

-- [VIEW] officers_with_account
CREATE VIEW officers_with_account AS
SELECT
	officer_id,
	officer_position,
	CONCAT(fname, ' ', LEFT(mname, 1), '. ', lname) AS name
FROM
	administrator
INNER JOIN officer
	USING (officer_id)
INNER JOIN resident
	USING (resident_id)
WHERE
	officer_status = 'Current' AND
	admin_email != 'brgy.muzon.naic.cavite@gmail.com';

-- [EVENT] clean_posts
CREATE EVENT clean_posts
ON SCHEDULE EVERY 3 MONTH
STARTS CURRENT_TIMESTAMP
ENDS '2031-01-01 00:00:00'
DO
	UPDATE
		post
	SET
		post_status = 'Deleted'
	WHERE
		date_time_posted < NOW() - INTERVAL 1 YEAR;

INSERT INTO
	household (house_no, street)
VALUES
	('200', 'A. Bonifacio'),
	('213', 'A. Bonifacio'),
	('220', 'A. Bonifacio'),
	('345', 'Callejon II'),
	('347', 'Callejon II'),
	('353', 'Callejon II'),
	('366', 'Callejon II'),
	('367', 'Callejon II'),
	('411', 'Callejon II'),
	('439', 'Callejon II'),
	('25', 'D. Silang'),
	('74', 'E. Balagtas'),
	('96', 'E. Balagtas'),
	('229', 'D. Silang'),
	('112', 'M. Aquino'),
	('113', 'M. Aquino'),
	('481', 'Lapu-Lapu');

INSERT INTO
	resident
VALUES
	(DEFAULT, 'Teresita', 'Gumapas', 'De Ocampo', 'Female', '1959-12-03', 'Advanced Degree', 'Teacher', 'Filipino',
		'Roman Catholic', '09568700018', 'Married', DEFAULT, '366', 'Callejon II'),
	(DEFAULT, 'Rizaldy', 'Gumapas', 'De Ocampo', 'Male', '1958-12-02', 'Some High School', 'Sewer', 'Filipino', 
		'Roman Catholic', '0949636880', 'Married', DEFAULT, '366', 'Callejon II'),
	(DEFAULT, 'Farrah Faye', 'Gumapas', 'De Ocampo', 'Female', '1988-11-08', 'College Graduate', 'Accountant', 'Filipino',
		'Roman Catholic', '09173996481', 'Single', DEFAULT, '366', 'Callejon II'),
	(DEFAULT, 'Ralph Rian', 'Gumapas', 'De Ocampo', 'Male', '1995-02-07', 'College Graduate', 'DevOps Engineer', 'Filipino',
		'Roman Catholic', '09477854445', 'Single', DEFAULT, '366', 'Callejon II'),
	(DEFAULT, 'Jovylyn', 'Caturay', 'Busque', 'Female', '1981-04-28', 'College Graduate', 'Software Tester', 'Filipino',
		'Roman Catholic', '09490394823', 'Married', DEFAULT, '367', 'Callejon II'),
	(DEFAULT, 'Allan', 'Angue', 'Busque', 'Male', '1981-10-13', 'College Graduate', 'Software Tester', 'Filipino',
		'Roman Catholic', '09491128936', 'Married', DEFAULT, '367', 'Callejon II'),
	(DEFAULT, 'Nathaniel Aaron', 'Caturay', 'Busque', 'Male', '2010-03-30', 'Some Elementary', 'N/A', 'Filipino',
		'Roman Catholic', '09490394823', 'Single', DEFAULT, '367', 'Callejon II'),
	(DEFAULT, 'Amy', 'Angue', 'Cahu', 'Female', '1995-02-06', 'College Graduate', 'Electrical Engineer', 'French',
		'Jehovah', '09079038153', 'Annulled', DEFAULT, '25', 'D. Silang'),
	(DEFAULT, 'Roxane', 'Angue', 'Cahu', 'Female', '1999-11-22', 'Some College', 'N/A', 'French',
		'Jehovah', '09075175481', 'Single', DEFAULT, '25', 'D. Silang'),
	(DEFAULT, 'Axelle', 'Angue', 'Cahu', 'Female', '2004-05-28', 'Some High School', 'N/A', 'French',
		'Jehovah', '09983408648', 'Single', DEFAULT, '25', 'D. Silang'),
	(DEFAULT, 'Felicita', 'Rodriguez', 'Imbis', 'Female', '1956-06-01', 'College Graduate', 'Civil Servant', 'Filipino',
		'Roman Catholic', '09186475411', 'Married', DEFAULT, '347', 'Callejon II'),
	(DEFAULT, 'Riza', 'Lagatoc', 'Malaluan', 'Female', '1980-05-25', 'High School Graduate', 'Laundrywoman', 'Filipino',
		'Roman Catholic', '09282308934', 'Married', DEFAULT, '229', 'D. Silang'),
	(DEFAULT, 'Editha', 'Magpali', 'Hallare', 'Female', '1956-01-15', 'Some College', 'Civil Servant', 'Filipino',
		'Roman Catholic', '09089792979', 'Married', DEFAULT, '353', 'Callejon II'),
	(DEFAULT, 'Alvin', 'Jeciel', 'Hallare', 'Male', '1961-06-06', 'High School Graduate', 'Civil Servant', 'Filipino',
		'Roman Catholic', '09186829559', 'Married', DEFAULT, '353', 'Callejon II'),
	(DEFAULT, 'Raquel', 'Pagtakhan', 'Loyola', 'Female', '1980-05-25', 'College Graduate', 'Civil Servant', 'Filipino',
		'Roman Catholic', '09184720087', 'Married', DEFAULT, '220', 'A. Bonifacio'),
	(DEFAULT, 'Iconarclo', 'Domingo', 'Api', 'Male', '1969-10-09', 'High School Graduate', 'Welder', 'Filipino',
		'Roman Catholic', '09497266639', 'Married', DEFAULT, '74', 'E. Balagtas'),
	(DEFAULT, 'Aniceta', 'Magtibay', 'Mercado', 'Female', '1963-04-17', 'High School Graduate', 'Cook', 'Filipino',
		'Roman Catholic', '09494704213', 'Married', DEFAULT, '411', 'Callejon II'),
	(DEFAULT, 'Jeel', 'Magtalas', 'Salvador', 'Male', '1984-11-05', 'High School Graduate', 'Factory Worker', 'Filipino',
		'Iglesia ni Cristo', '09089792979', 'Married', DEFAULT, '439', 'Callejon II'),
	(DEFAULT, 'Daisy', 'Alcantara', 'Oneza', 'Female', '1965-09-11', 'College Graduate', 'Civil Servant', 'Filipino',
		'Roman Catholic', '09485760732', 'Married', DEFAULT, '345', 'Callejon II'),
	(DEFAULT, 'Macario', 'Lubag', 'Mercada', 'Male', '1956-05-16', 'College Graduate', 'Civil Servant', 'Filipino',
		'Roman Catholic', '09569126747', 'Married', DEFAULT, '96', 'E. Balagtas'),
	(DEFAULT, 'Rodolfo', 'Nacalaban', 'Años', 'Male', '1956-08-23', 'College Graduate', 'Civil Servant', 'Filipino',
		'Iglesia ni Cristo', '09071294783', 'Married', DEFAULT, '213', 'A. Bonifacio'),
	(DEFAULT, 'Leonardo', 'Domingo', 'Api', 'Male', '1973-10-09', 'College Graduate', 'Civil Servant', 'Filipino',
		'Roman Catholic', '09495619046', 'Married', DEFAULT, '74', 'E. Balagtas'),
	(DEFAULT, 'Violeta', 'Balatico', 'Hera', 'Female', '1980-11-05', 'College Graduate', 'Civil Servant', 'Filipino',
		'Jehovah', '09072914753', 'Single', DEFAULT, '200', 'A. Bonifacio'),
	(DEFAULT, 'Jasmine', 'Rodriguez', 'Imbis', 'Female', '1995-06-01', 'College Graduate', 'Bank Teller', 'Filipino',
		'Roman Catholic', '09186475411', 'Married', DEFAULT, '347', 'Callejon II'),
	(DEFAULT, 'Rosmarilin', 'Cabadin', 'Medina', 'Female', '1999-11-13', 'Some College', 'N/A', 'Filipino',
		'Roman Catholic', '09452579778', 'Married', DEFAULT, '112', 'M. Aquino'),
	(DEFAULT, 'Odile', 'O''dair', 'Medina', 'Female', '1999-10-28', 'Some College', 'N/A', 'American',
		'Roman Catholic', '09071093583', 'Married', DEFAULT, '112', 'M. Aquino'),
	(DEFAULT, 'Maria Patrice', 'Bigalbal', 'Pabiton', 'Female', '1999-05-23', 'Some College', 'N/A', 'Filipino',
		'Iglesia ni Cristo', '09350928946', 'Single', DEFAULT, '112', 'M. Aquino'),
	(DEFAULT, 'Etchell', 'Bigalbal', 'Pabiton', 'Female', '1965-07-19', 'College Graduate', 'Florist', 'Filipino',
		'Iglesia ni Cristo', '09359218835', 'Married', DEFAULT, '113', 'M. Aquino'),
	(DEFAULT, 'Benjamin James', 'Reyes', 'Sanchez', 'Male', '1984-01-01', 'College Graduate', 'Art Director', 'Filipino',
		'Roman Catholic', '09358314949', 'Single', DEFAULT, '481', 'Lapu-Lapu');

INSERT INTO
	officer
VALUES
	(DEFAULT, 1, '2013-05-13', '2018-05-15', 'Past', 11),
	(DEFAULT, 2, '2013-05-13', '2018-05-15', 'Past', 12),
	(DEFAULT, 3, '2013-05-13', '2018-05-15', 'Past', 13),
	(DEFAULT, 4, '2013-05-13', '2018-05-15', 'Past', 14),
	(DEFAULT, 5, '2013-05-13', '2018-05-15', 'Past', 15),
	(DEFAULT, 6, '2013-05-13', '2018-05-15', 'Past', 16),
	(DEFAULT, 7, '2013-05-13', '2018-05-15', 'Past', 17),
	(DEFAULT, 8, '2013-05-13', '2018-05-15', 'Past', 18),
	(DEFAULT, 9, '2013-05-13', '2018-05-15', 'Past', 19),
	(DEFAULT, 10, '2013-05-13', '2018-05-15', 'Past', 20),
	(DEFAULT, 11, '2013-05-13', '2018-05-15', 'Past', 24),
	(DEFAULT, 1, '2018-05-15', DEFAULT, 'Current', 11),
	(DEFAULT, 2, '2018-05-15', DEFAULT, 'Current', 21),
	(DEFAULT, 3, '2018-05-15', DEFAULT, 'Current', 13),
	(DEFAULT, 4, '2018-05-15', DEFAULT, 'Current', 14),
	(DEFAULT, 5, '2018-05-15', DEFAULT, 'Current', 15),
	(DEFAULT, 6, '2018-05-15', DEFAULT, 'Current', 16),
	(DEFAULT, 7, '2018-05-15', DEFAULT, 'Current', 22),
	(DEFAULT, 8, '2018-05-15', DEFAULT, 'Current', 23),
	(DEFAULT, 9, '2018-05-15', DEFAULT, 'Current', 19),
	(DEFAULT, 10, '2018-05-15', DEFAULT, 'Current', 20),
	(DEFAULT, 11, '2018-05-15', DEFAULT, 'Current', 24);

-- Passwords inserted here are hashed using PHP's encoding algorithm. 
INSERT INTO
	administrator (admin_email, admin_password, officer_id)
VALUES
	('brgy.muzon.naic.cavite@gmail.com', '$2y$10$CtnzbINrxyH1wLupEyJ2U.ta2WbMK5PdJi8AXNPEK.dQffNpNr5.2', NULL),
	('riza.malaluan@gmail.com', '$2y$10$MTlKxMqwYNONcXUEi.wFMuWZyOCejJxIqtt5oKs3r7ez9BFl4b9uW', 2),
	('felicita.imbis@gmail.com', '$2y$10$uyNGNk8Ccj35tfSpFOWVte4rOjE02VDMYTBMYJAqULRysMSDYWjuO', 12);

INSERT INTO
	complainant_outsider
VALUES
	(DEFAULT, 'Sage', 'Santos', 'Sy', '09985693185', '2897-B', 'Gen. Del Pilar St.', 'Bangkal', 'Makati', NULL);

INSERT INTO
	blotter
VALUES
	(DEFAULT, '2020-11-10 15-00-00', '2020-11-07 06-30-00', 'Amy''s Bakery', DEFAULT, 'Theft', 'Ms. Pabiton took a tray of bread worth Php 700 from Ms. Cahu''s bakery store. According to Ms. Cahu, this isn''t the first time that Ms. Pabiton took something from their store. For the last few weeks, Ms. Pabiton took flour, eggs, oil, and spatula from the bakery.', 27, NULL, 8, NULL),
	(DEFAULT, '2020-12-01 09-00-00', '2020-07-21 14-30-00', 'Sy Residences', DEFAULT, 'Fraud', 'Mr. Sanchez introduced himself as an employee of Sun Life, and convinced Mr. Sy to avail a life insurance. Mr. Sy paid a down payment last July 21 worth Php 50,000. He has been trying to contact Mr. Sanchez for the next few months regarding the unfinished transactions. However, Mr. Sanchez was deliberately ignoring his phone calls. Hence, Mr. Sy went to Mr. Sanchez'' abode only to discover that he wasn''t actually working for Sun Life.', 29, NULL, NULL, 1);

INSERT INTO
	post
VALUES
	(DEFAULT, 'Cavite Now MECQ', '2020-08-04 07:00:00', 'The MECQ was imposed in Cavite, along with Metro Manila, Rizal, Laguna, and Bulacan from August 4 to 18 following the request of the medical community for a “timeout” amid increasing COVID-19 cases under relaxed quarantine protocols.', '1.jpg', DEFAULT),
	(DEFAULT, 'New COVID-19 Case', '2020-09-02 09:00:00', 'The Naic Municipality Government recorded 5 new Covid-19 cases coming from 2 barangays: 4 cases coming from Brgy. Ibayo Silangan, and one from Brgy. Muzon.This makes the town''s confirmed Covid-19 cases tally count to 125 with 82 recoveries, and 6 deaths.', '2.jpg', DEFAULT),
	(DEFAULT, 'Barangay Assembly', '2020-11-07 16:00:00', 'The Provincial Government – Environment and Natural Resources (PGENRO) sprays disinfectant from a truck as it drives through Barangay Muzon in Naic, Cavite on Saturday, part of the town''s ongoing efforts to stop the spread of Covid-19. Naic has recorded 342 cases, including 308 recoveries and 13 deaths.', '3.jpg', DEFAULT),
	(DEFAULT, 'Disinfecting Muzon', '2020-11-23 13:00:00', 'The Provincial Government – Environment and Natural Resources (PGENRO) sprays disinfectant from a truck as it drives through Barangay Muzon in Naic, Cavite on Saturday, part of the town''s ongoing efforts to stop the spread of Covid-19. Naic has recorded 342 cases, including 308 recoveries and 13 deaths.', '4.jpg', DEFAULT),
	(DEFAULT, 'COVID-19 Free', '2020-12-29 10:00:00', 'The Municipality of Naic, Cavite remains at 0 covid-19 case as of December 29, 2020 despite of the recent holiday. The town has been virus-free since December 20, 2020 with only a total of 355 cases, including 340 recoveries and 13 deaths.', '5.jpg', DEFAULT);

-- Inserts a sample record into `resolution`
START TRANSACTION;

SELECT
	date_time_reported,
	incident_date_time,
	incident_place,
	offense_subject,
	incident_narrative,
	complained_resident_id,
	guardian_complained_resident_id,
	complainant_resident_id,
	complainant_outsider_id
INTO
	@date_time_reported,
	@incident_date_time,
	@incident_place,
	@offense_subject,
	@incident_narrative,
	@complained_resident_id,
	@guardian_complained_resident_id,
	@complainant_resident_id,
	@complainant_outsider_id
FROM
	blotter
WHERE
	blotter_id = 1;

INSERT INTO
	resolution
VALUES
	(DEFAULT, @date_time_reported, @incident_date_time, @incident_place, 'Settled', @offense_subject, @incident_narrative, @complained_resident_id, @guardian_complained_resident_id, @complainant_resident_id, @complainant_outsider_id, 'Ms. Pabiton paid a settlement payment of Php 1000 to Ms. Cahu.', '2020-11-25');

DELETE FROM blotter WHERE blotter_id = 1;

COMMIT;

-- Inserts a sample record into `terminated_officer`
START TRANSACTION;

SELECT
	officer_position,
	start_date,
	resident_id
INTO
	@officer_position,
	@start_date,
	@resident_id
FROM
	officer
WHERE
	officer_id = 22;

INSERT INTO
	terminated_officer
VALUES
	(DEFAULT, @officer_position, @start_date, '2019-02-04', 'Withdrawal of Appointment', 'Jasmine Imbis was caught using marijuana. The former Youth Council Chairman did not deny this. Although she was not pressed with any charges, she was immediately removed from service.', @resident_id);

DELETE FROM officer WHERE officer_id = 22;

INSERT INTO
	officer
VALUES
	(DEFAULT, 11, '2019-02-04', NULL, 'Current', 25);

COMMIT;