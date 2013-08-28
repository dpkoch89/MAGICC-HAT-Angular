<?php

/*
 * File: database_object.php
 * Author: Daniel Koch <dkoch89@gmail.com>
 * Date: 14 July 2013
 * 
 * Provides the DatabaseObject class
 */

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
   protected $request_data_;
   protected $status_code_;
   protected $body_;
   protected $db_connection_;
   
   // private functions
   protected function connectToDB()
   {
     $this->db_connection_ = mysqli_connect("localhost", "root", "mysql", "magicc_hat");
     
     if (mysqli_connect_errno($this->db_connection_))
     {
       $this->status_code_ = 500;
       $this->body_ = '';
       return false;
     }
     else
     {
       return true;
     }
   }
   
   protected function disconnectFromDB()
   {
     mysqli_close($this->db_connection_);
   }
   
   protected function setData($request_data) // is this how we should do this? or should this be private and called by each of the other functions?
   {
     $this->request_data_ = $request_data;
   }
   
   // public functions
   // note: for all functions below, should we pass the data in as one of its arguments? Also, each function needs to return the body to be sent back as the response
   
   public function __construct()
   {
     $this->request_data_ = array();
     $this->status_code_ = 200;
     $this->body = '';
   }
   
   // returns all records in the database object
   public function query($request_data) {}
   
   // returns a single record from the database object
   public function get($request_data) {}
   
   // creates a new record in the database object
   public function create($request_data) {}
   
   // updates an existing record in the database object
   public function update($request_data) {}
   
   // deletes a record from the database object
   public function delete($request_data) {}
   
   // gets the status code
   public function getStatusCode()
   {
     return $this->status_code_;
   }
   
   // gets the body
   public function getBody()
   {
     return $this->body_;
   }
   
 }
