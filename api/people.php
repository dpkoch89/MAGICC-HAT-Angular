<?php

/*
 * File: people.php
 * Author: Daniel Koch <dkoch89@gmail.com>
 * Date: 14 July 2013
 * 
 * Provides the People class, which is an extension of the DatabaseObject class
 */

require_once('database_object.php');

/*
 * People
 * 
 * This is the database object class for accessing the people data in the database. It extends the DatabaseObject
 * class.
 */
 class People extends DatabaseObject
 {
   // retrieve all records in the database
   public function query($request_data)
   {     
     if ($this->connectToDB())
     {
       // retrieve records from database
       $sql = mysqli_query($this->db_connection_, "SELECT * FROM people");
      
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
   
   // returns a single record from the database object
   public function get($request_data)
   {
     if (isset($request_data['ID']))
     {
       if ($this->connectToDB())
       {
         $personID = $request_data['ID'];
         $sql = mysqli_query($this->db_connection_, "SELECT * FROM people WHERE personID = $personID");
         
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
   
 }
?>