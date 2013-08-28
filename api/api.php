<?php

error_reporting(E_ALL);

/*
 * File: api.php
 * Author: Daniel Koch <dkoch89@gmail.com>
 * Date: 14 July 2013
 *
 * This file and the other files in the /api folder implement a RESTful interface to the MySQL database. The structure
 * of this interface and some of the code were adapted from the tutorial found at
 * http://www.gen-x-design.com/archives/create-a-rest-api-with-php/
 */

// include required files
require_once('rest_utilities.php');
require_once('rest_request.php');
require_once('people.php');

// process the HTTP request
$rest_request = RestUtilities::processRequest();

// determine which class to use
switch ($rest_request->getTable())
{
  case 'people':
    $database_object = new People();
    break;
  default:
    // report bad request
    RestUtilities::sendResponse(400);
    die();
    break;
}

// determine which action to take and execute that action
switch($rest_request->getMethod())
{
  case 'get':
    if ($rest_request->getHasID())
    {
      $database_object->get($rest_request);
    }
    else
    {
      $database_object->query($rest_request);
    }
    break;
  default:
    // report not implemented
    RestUtilities::sendResponse(501);
    die();
    break;
}

// send the response
RestUtilities::sendResponse($database_object->getStatusCode(), $database_object->getBody());

?>