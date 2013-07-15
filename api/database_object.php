<!--
  
  File: database_object.php
  Author: Daniel Koch <dkoch89@gmail.com>
  Date: 14 July 2013
  
  Provides the DatabaseObject class
  
-->

<?php

/*
 * DatabaseObject
 * 
 * This is the base class from which all database objects (People, Items, etc.) inherit. It defines the interface that
 * will be used by the top-level API handler for interacting with the MySQL database.
 */
 class DatabaseObject
 {
   // constants
   const DB_SERVER = 'localhost';
   const DB_USER = 'root';
   const DB_PASSWORD = 'mysql';
   const DB_NAME = 'maggic_hat';
   
   // member variables
   private $data_;
   
   // private functions
   private function connectToDB() {}
   private function disconnectFromDB() {}
   
   // public functions
   
   public function setData($data) {} // is this how we should do this? or should this be private and called by each of the other functions?
   
   // note: for all functions below, should we pass the data in a one of its arguments? Also, each function needs to return the body to be sent back as the response
   
   // returns all records in the database object
   public function query() {}
   
   // returns a single record from the database object
   public function get() {}
   
   // creates a new record in the database object
   public function create() {}
   
   // updates an existing record in the database object
   public function update() {}
   
   // deletes a record from the database object
   public function delete() {}
   
 }
