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
   public function query($request)
   {
     parent::executeQuery($request, "SELECT * FROM people");
   }
   
   // returns a single record from the database object
   public function get($request)
   {
     $personID = $request->getID();
     parent::executeGet($request, "SELECT * FROM people WHERE personID = $personID");
   }
   
 }
?>