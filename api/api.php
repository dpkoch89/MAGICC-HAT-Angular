<!--
	
  File: api.php
  Author: Daniel Koch <dkoch89@gmail.com>
  Date: 14 July 2013

  This file and the other files in the /api folder implement a RESTful interface to the MySQL database. The structure
  of this interface and some of the code were adapted from the tutorial found at
  http://www.gen-x-design.com/archives/create-a-rest-api-with-php/
	
-->

<?php

// include required files
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/rest_utilities.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/rest_request.php');

// do stuff:

/*
 * decode the url to determine which class to use
 * process the HTTP request
 * examine the method (get, post, put, delete) to determine which action that class should take (e.g. query (get all items), get (a single item), create, update, delete)
 * perform the action, get the code and body to return
 * send the response
 */

?>