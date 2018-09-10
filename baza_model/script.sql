/*
Created		10. 09. 2018
Modified		10. 09. 2018
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/


Create table hotels (
	id Int NOT NULL,
	city_id Int NOT NULL,
	user_id Int NOT NULL,
	name Varchar(200) NOT NULL,
	address Varchar(200) NOT NULL,
	date_from Timestamp NOT NULL,
	date_to Timestamp NOT NULL,
	insert_date Timestamp NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table users (
	id Int NOT NULL,
	email Varchar(200) NOT NULL,
	username Varchar(200) NOT NULL,
	password Varchar(200) NOT NULL,
	edit_hotels Int NOT NULL DEFAULT 0,
	avatar Varchar(200) NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table admin (
	id Int NOT NULL,
	email Varchar(200) NOT NULL,
	username Varchar(200) NOT NULL,
	password Varchar(200) NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table hotel_logins (
	id Int NOT NULL,
	user_id Int NOT NULL,
	hotel_id Int NOT NULL,
	login_date Timestamp NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;

Create table cities (
	id Int NOT NULL,
	name Varchar(200) NOT NULL,
 Primary Key (id)) ENGINE = MyISAM;


