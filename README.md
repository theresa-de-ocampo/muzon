# Web-based Barangay Management System with a Separate Site for Public View
[Visit Public Site](https://bmms.000webhostapp.com/public/index.php)

[Visit Admin Site](https://bmms.000webhostapp.com/admin/index.php) | **Email:** brgy.muzon.naic.cavite@gmail.com | **Password:** Jeremiah 29:11

## Overview
<sup>[[?]](https://www.definitions.net/definition/barangay#:~:text=Freebase-,Barangay,suburb%20or%20a%20suburban%20neighborhood. "A barangay is the smallest administrative division in the Philippines and is the native Filipino term for a village, district or ward.")</sup> Barangay Muzon is the client of this project which is small neighborhood (313 hectares) in Naic, Cavite with a total population of 2,491 last 2017. The Department of the Interior and Local Government (DILG) mandates every barangay to enforce a Barangay Performance Management System (BGPMS) which is currently being implemented by the client through traditional file processing system. With that being said, BGPMS was broken down into smaller stand-alone subsystems, one of which is the system in this repository.

## Features
1. Tables
	1. Provision for printing.
	2. Provision for exporting to csv.
2. Login & Account Management
	1. Password update
	2. Strong password requirement.
	3. Only the master admin can create and revoke an account for the officers.
3. Dashboard
	1. Population groupings
	2. Officials
		1. List of current officials
		2. Insert new cycle
		3. Terminate an official
4. Residents
	1. Displays list residents
	2. Register a new resident
	3. Update information of a resident
	4. Archive a resident
	5. Search residents by any attribute (first name, last name, age, house number, etc.)
5. Household
	1. Displays list of households
	2. Provision for copying the address (house number and street to clipboard) – used for filtering the list of residents based on where they live.
6. Blotter
	1. Displays list of pending cases
	2. View case details
	3. Insert a new case
	4. Search a case by any attribute (complainant name, complained resident name, etc.)
	5. Settle a pending case
	6. Printable list of pending cases
7. Posts
	1. Post a news article.
	2. Edit published article.
	3. Unpublish an article.
	4. Every change made is reflected on the public side.
8. Archives
	1. Displays history of officers
	2. Displays list of terminated officers
	3. Displays list of archived residents
		8.3.1. Restore archived resident
	4. Displays list of unoccupied units
	5. Displays list of resolved blotter cases
		8.6. View resolved blotter case details
	7. Display list of unpublished posts.
		1. View an unpublished article.
		2. Restore a deleted post.

## Requirements
- Apache Server 2.4.41 or higher.
- PHP 7.4.0 or higher.
- MySQL 8.0.21 or higher.

## Installation
1. Clone the repository.
	```bash
		git clone https://github.com/theresa-de-ocampo/muzon.git
	```
2. Run SQL file through MySQL Console.
	```sql
		source your-path/setup.sql
	```
3. Change DSN at ```commons/src/inc/dbh.php```.
	```php
		define("DB_HOST", "your-hosting-site");
		define("DB_USER", "your-username");
		define("DB_PASSWORD", "your-password");
	``` 
4. Open the websites (```admin/index.php```, and ```public/index.php```).

## Future Updates
* Automatic Database Back-up
* Document Requests
* Data Analysis