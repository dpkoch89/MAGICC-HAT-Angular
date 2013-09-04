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
   public function query($request) {}
   
   // returns a single record from the database object
   public function get($request) {}
   
   // creates a new record in the database object
   public function create($request) {}
   
   // updates an existing record in the database object
   public function update($request) {}
   
   // deletes a record from the database object
   public function delete($request) {}
   
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
   
   // performs the actual query operation
   protected function executeQuery($request, $query)
   {
     if ($this->connectToDB())
     {
       // retrieve records from database
       $sql = mysqli_query($this->db_connection_, $query);
      
       // return results encoded in JSON format
       $result = array();
       while ($rlt = mysqli_fetch_assoc($sql))
       {
         $result[] = $rlt;
       }
       
       $this->status_code_ = 200;
       $this->body_ = json_encode($result);
       $this->disconnectFromDB();
     }
     else // could not connect to database
     {
       $this->status_code_ = 500;
       $this->body_ = '';
     }
   }
   
   // performs the actual get operation
   protected function executeGet($request, $query)
   {
     if ($request->getHasID())
     {
       if ($this->connectToDB())
       {
         $sql = mysqli_query($this->db_connection_, $query);
         
         $this->status_code_ = 200;
         $this->body_ = json_encode(mysqli_fetch_assoc($sql));
         
         $this->disconnectFromDB();
       }
       else // could not connect to database
       {
         $this->status_code_ = 500;
         $this->body_ = '';
       }
     }
     else // request did not contain personID
     {
       $this->status_code_ = 400;
       $this->body_ = '';
     }
   }
   
   // performs the actual update operation
   protected function executeUpdate($request, $query)
   {
     if ($request->getHasID())
     {
       if ($this->connectToDB())
       {
         // perform the update operation
         mysqli_query($this->db_connection_, $query);
         //$meh = mysqli_affected_rows($this->db_connection_);
         
         // send the updated record ID back as the response
         $this->status_code_ = 200;
         $this->body_ = $request->getID();
         //$this->body_ = $meh;
         //$this->body_ = $sql;
         //$this->body_ = $query . PHP_EOL . 'Rows affected: ' . $meh;
         
         $this->disconnectFromDB();
       }
       else // could not connect to database
       {
         $this->status_code_ = 500;
         $this->body_ = '';
       }
     }
     else // request did not contain personID
     {
       $this->status_code_ = 400;
       $this->body_ = '';
     }
   }
   
 }
