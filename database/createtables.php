<?php
include ("./connect.php");
$sqltbleusers="CREATE TABLE IF NOT EXISTS users
(
    userid bigint NOT NULL  AUTO_INCREMENT,
    fullname text  NOT NULL,
    email text  NOT NULL,
    phonenumber text  NOT NULL,
    username text  NOT NULL,
    password text ,
    PRIMARY KEY (userid)
);";

$sqltblecustomers="CREATE TABLE IF NOT EXISTS customers(
    custid INTEGER NOT NULL AUTO_INCREMENT,
    firstname varchar(255) NOT NULL,
    lastname varchar(255)  NOT NULL,
    dob varchar(255)  NOT NULL,
    nationalid varchar(255) NOT NULL,
    photo LONGTEXT  NOT NULL,
    address varchar(255)    NOT NULL,
    email varchar(255)   NOT NULL,
    phonenumber varchar(255) NOT NULL,
    CONSTRAINT PRIMARY KEY (custid)
);";

$sqltbleaccounts="CREATE TABLE IF NOT EXISTS accounts
(
    accountnumber text  NOT NULL,
    coutomerid INTEGER NOT NULL,
    createdon varchar(255) NOT NULL,
    balance numeric NOT NULL,
    userid bigint NOT NULL,
    CONSTRAINT  PRIMARY KEY (accountnumber),
    CONSTRAINT  FOREIGN KEY (coutomerid)
        REFERENCES customers (custid) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT  FOREIGN KEY (userid)
        REFERENCES users (userid) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)";

$sqltbletransactions="CREATE TABLE IF NOT EXISTS transactions
(
    transactionid bigint NOT NULL AUTO_INCREMENT,
    accounnumber text NOT NULL,
    amount text NOT NULL,
    transactiontype text NOT NULL,
    balance numeric NOT NULL,
    createdon text,
    userid bigint,
    CONSTRAINT  PRIMARY KEY (transactionid),
    CONSTRAINT  FOREIGN KEY (accounnumber)
        REFERENCES accounts (accountnumber) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT FOREIGN KEY (userid)
        REFERENCES users (userid) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)";

if ($mysqli -> multi_query($sqltbleusers.$sqltblecustomers.$sqltbleaccounts.$sqltbletransactions)) {
    do {
      if ($result = $mysqli -> store_result()) {
        while ($row = $result -> fetch_row()) {
          echo $row[0];
        }
       $result -> free_result();
      }
    
      if ($mysqli -> more_results()) {
        echo "-------------\n";
      }
    } while ($mysqli -> next_result());
  }
  else {
      echo $mysqli->error;
  }
  
  $mysqli -> close();

?>






