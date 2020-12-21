-- laravel will take care of dropping and creating the database

-- DROP DATABASE IF EXISTS apiabees;

-- CREATE DATABASE apiabees;

USE apiabees;

CREATE TABLE action_types (
	name VARCHAR(32) NOT NULL PRIMARY KEY,
	deleted_at TIMESTAMP NULL

);

CREATE TABLE actions (
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	employee_PESEL CHAR(11) NOT NULL,
	performed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
	description TEXT,
	hive_id INTEGER,
	type_name VARCHAR(32) NOT NULL,
	deleted_at TIMESTAMP NULL
);

CREATE UNIQUE INDEX UC_actions__idx ON actions  (employee_PESEL, performed_at);

CREATE TABLE apiaries (
	code_name VARCHAR(32) NOT NULL PRIMARY KEY,
	name VARCHAR(64) NOT NULL,
	area DECIMAL(10, 2) NOT NULL,
	parcel VARCHAR(8) NOT NULL,
	street VARCHAR(32) NOT NULL,
	city VARCHAR(32) NOT NULL,
	col_num INTEGER NOT NULL CHECK (col_num >= 0),
	row_num INTEGER NOT NULL CHECK (row_num >= 0),
	latitude DECIMAL(10, 7) NOT NULL CHECK (latitude > 0),
	longitude DECIMAL(10, 7) NOT NULL CHECK (longitude > 0),
	deleted_at TIMESTAMP NULL
);

CREATE TABLE attendances (
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	started_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
	finished_at TIMESTAMP NULL,
	employee_PESEL CHAR(11) NOT NULL,
	deleted_at TIMESTAMP NULL,
	CHECK (finished_at >= started_at OR finished_at IS NULL)
);

CREATE UNIQUE INDEX UC_attendances__idx ON attendances (employee_PESEL, started_at);


CREATE TABLE bee_families (
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	acquired_at DATE DEFAULT CURRENT_TIMESTAMP NOT NULL,
	population INTEGER NOT NULL,
	die_off_date DATE NULL,
	species_name VARCHAR(32) NOT NULL,
	hive_id INTEGER NOT NULL,
	deleted_at TIMESTAMP NULL,
	CHECK ( die_off_date >= acquired_at OR die_off_date IS NULL )
);

CREATE UNIQUE INDEX bee_families__idx ON bee_families ( hive_id ASC );

CREATE TABLE employees (
	PESEL CHAR(11) NOT NULL PRIMARY KEY,
	first_name VARCHAR(32) NOT NULL,
	last_name VARCHAR(32) NOT NULL,
	salary DECIMAL(10, 2) NOT NULL,
	date_of_employment DATE DEFAULT CURRENT_TIMESTAMP NOT NULL,
	date_of_release DATE NULL,
	appartement VARCHAR(4) NULL,
	house_number VARCHAR(8) NOT NULL,
	street VARCHAR(32) NOT NULL,
	city VARCHAR(32) NOT NULL,
	CHECK (date_of_release >= date_of_employment OR date_of_release IS NULL)
);

CREATE TABLE family_states (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	checked_at TIMESTAMP NOT NULL,
	inspection_description TEXT NULL,
	bee_family_id INTEGER NOT NULL,
	deleted_at TIMESTAMP NULL,
	state_type_name VARCHAR(32) NOT NULL
);

CREATE UNIQUE INDEX family_states__idx ON family_states (bee_family_id, checked_at);

CREATE TABLE hives (
	id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	material VARCHAR(32) NOT NULL,
	nfc_tag VARCHAR(128) NULL,
	qr_code VARCHAR(32) NULL,
	apiary_code_name VARCHAR(32) NULL,
	location_row INTEGER NULL,
	location_column INTEGER NULL,
	bee_family_id INTEGER NULL,
	deleted_at TIMESTAMP NULL
);

CREATE UNIQUE INDEX hives__idx ON hives ( bee_family_id );

CREATE TABLE honey_productions (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	produced_at DATE NOT NULL,
	produced_weight DECIMAL(10, 2) NOT NULL,
	honey_type_name VARCHAR(32) NOT NULL,
	apiary_code_name VARCHAR(32) NOT NULL
);

CREATE UNIQUE INDEX honey_productions__idx ON honey_productions ( apiary_code_name, produced_at );

CREATE TABLE honey_types (
	name VARCHAR(32) NOT NULL PRIMARY KEY,
	deleted_at TIMESTAMP NULL
);

CREATE TABLE task_assignments (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	assignment_date DATE DEFAULT CURRENT_TIMESTAMP NOT NULL,
	employee_PESEL CHAR(11) NOT NULL,
	task_type_name VARCHAR(64) NOT NULL,
	apiary_code_name VARCHAR(32) NOT NULL,
	deleted_at TIMESTAMP NULL
);

CREATE UNIQUE INDEX task_assignments__idx ON task_assignments ( employee_PESEL, task_type_name, apiary_code_name, assignment_date );

CREATE TABLE species (
	name VARCHAR(32) NOT NULL PRIMARY KEY,
	latin_name VARCHAR(32) NOT NULL,
	is_aggressive BOOL NOT NULL,
	deleted_at TIMESTAMP NULL
);

CREATE TABLE state_types (
	name VARCHAR(32) NOT NULL PRIMARY KEY,
	deleted_at TIMESTAMP NULL
);

CREATE TABLE task_types (
	name VARCHAR(64) NOT NULL PRIMARY KEY,
	deleted_at TIMESTAMP NULL
);

CREATE TABLE wax_productions (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	produced_at DATE NOT NULL,
	produced_weight DECIMAL(10, 2) NOT NULL,
	apiary_code_name VARCHAR(32) NOT NULL
);

CREATE UNIQUE INDEX wax_productions__idx ON wax_productions ( apiary_code_name, produced_at );

ALTER TABLE actions ADD CONSTRAINT actions_action_types_fk FOREIGN KEY (type_name) REFERENCES action_types (name) ON UPDATE CASCADE;

ALTER TABLE actions ADD CONSTRAINT actions_employees_fk FOREIGN KEY (employee_PESEL) REFERENCES employees (PESEL);

ALTER TABLE actions ADD CONSTRAINT actions_hives_fk FOREIGN KEY (hive_id) REFERENCES hives (id);

ALTER TABLE attendances ADD CONSTRAINT attendances_employees_fk FOREIGN KEY (employee_PESEL) REFERENCES employees (PESEL);

ALTER TABLE bee_families ADD CONSTRAINT bee_families_species_fk FOREIGN KEY (species_name) REFERENCES species (name) ON UPDATE CASCADE;

ALTER TABLE bee_families ADD CONSTRAINT bee_families_hives_fk FOREIGN KEY (hive_id) REFERENCES hives (id);

ALTER TABLE family_states ADD CONSTRAINT family_states_bee_families_fk FOREIGN KEY (bee_family_id) REFERENCES bee_families (id);

ALTER TABLE family_states ADD CONSTRAINT family_states_state_types_fk FOREIGN KEY (state_type_name) REFERENCES state_types (name) ON UPDATE CASCADE;

ALTER TABLE hives ADD CONSTRAINT hives_bee_families_fk FOREIGN KEY (bee_family_id) REFERENCES bee_families (id);

ALTER TABLE hives ADD CONSTRAINT hives_apiaries_fk FOREIGN KEY (apiary_code_name) REFERENCES apiaries (code_name);

ALTER TABLE honey_productions ADD CONSTRAINT honey_productions_types_fk FOREIGN KEY (honey_type_name) REFERENCES honey_types (name) ON UPDATE CASCADE;

ALTER TABLE honey_productions ADD CONSTRAINT honey_productions_apiaries_fk FOREIGN KEY (apiary_code_name) REFERENCES apiaries (code_name);

ALTER TABLE task_assignments ADD CONSTRAINT assigned_tasks_employees_fk FOREIGN KEY (employee_PESEL) REFERENCES employees (pesel);

ALTER TABLE task_assignments ADD CONSTRAINT assigned_tasks_tasks_fk FOREIGN KEY (task_type_name) REFERENCES task_types (name) ON UPDATE CASCADE;

ALTER TABLE task_assignments ADD CONSTRAINT assigned_tasks_apiaries_fk FOREIGN KEY (apiary_code_name) REFERENCES apiaries (code_name);

ALTER TABLE wax_productions ADD CONSTRAINT wax_productions_apiaries_fk FOREIGN KEY (apiary_code_name) REFERENCES apiaries (code_name);

COMMIT;
