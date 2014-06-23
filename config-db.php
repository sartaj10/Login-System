<?php
  include 'config.inc.php';

  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  $createUsersTable = "CREATE TABLE users (
                         id INT NOT NULL AUTO_INCREMENT,
                         name VARCHAR(100) NOT NULL,
                         user_email VARCHAR(30) NOT NULL UNIQUE,
                         pass_hash VARCHAR(64) NOT NULL,
                         salt VARCHAR(30) NOT NULL,
                         gender CHAR(1),
                         type CHAR(1) NOT NULL,
                         PRIMARY KEY(id)
                       );";
  $createPackagesTable = "CREATE TABLE packages (
                            id INT NOT NULL AUTO_INCREMENT,
                            user_id INT NOT NULL,
                            desc VARCHAR(3000) NOT NULL,
                            PRIMARY KEY(id)
                          );";
  $createImagesTable = "CREATE TABLE images (
                          id INT NOT NULL AUTO INCREMENT,
                          package_id INT NOT NULL,
                          file_name VARCHAR(200) NOT NULL,
                          file_size VARCHAR(200) NOT NULL,
                          file_type VARCHAR(200) NOT NULL,
                          PRIMARY KEY(id)
                        );";

  mysqli_query($connection, $createUsersTable);
?>
