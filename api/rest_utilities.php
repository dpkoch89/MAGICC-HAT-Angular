<?php

/*
 * File: rest_utilities.php
 * Author: Daniel Koch <dkoch89@gmail.com>
 * Date: 14 July 2013
 * 
 * Provides the RestUtilities class
 */

// include required files
require_once('rest_request.php');

/*
 * RestUtilities
 * 
 * This class provides utility functions needed for creating the REST API (handling the HTTP request and sending the
 * response)
 */

class RestUtilities
{
  // processes the HTTP request, returning a RestRequest object containing the request data
  public static function processRequest()
  {
    // initialize return object and variables
    $return_obj = new RestRequest();
    $data = array();
    
    // get request method
    $request_method = strtolower($_SERVER['REQUEST_METHOD']);
    $return_obj->setMethod($request_method);
    
    // get table and id from URL
    $url_array = explode('/', $_SERVER['REQUEST_URI']);
    array_shift($url_array); // remove first entry (empty)
    array_shift($url_array); // remove second entry ('api')
    
    $return_obj->setTable($url_array[0]);
    
    if (isset($url_array[1]))
    {
      $return_obj->setHasID(true);
      $return_obj->setID($url_array[1]);
    }
    else
    {
      $return_obj->setHasID(false);
    }
    
    // get data
    switch ($request_method)
    {
      /*case 'get': // do we even want to implement this for get?
        $data = $_GET;
        // like this? (test): $data = get_object_vars(json_decode(file_get_contents('php://input')));
        break;*/
      case 'post':
        $payload = file_get_contents('php://input');
        $data = get_object_vars(json_decode($payload));
        break;
      case 'put':
        $payload = file_get_contents('php://input');
        $data = get_object_vars(json_decode($payload));
        break;
        
      // note: we don't accept data for delete request, so 'delete' is not included in this switch statement 
    }
    
    // store the raw request payload (probably don't need to do this)
    $return_obj->setRequestPayload($payload);
    
    // store the decoded data
    $return_obj->setData($data);
    
    // return the object
    return $return_obj;
  }
  
  // sends the HTTP response with the status code and body provided in the function arguments
  public static function sendResponse($status = 200, $body = '', $content_type = 'text/html')
  {
    $status_header = 'HTTP/1.1 ' . $status . ' ' . RestUtilities::getStatusCodeMessage($status);
    header($status_header);
    
    if ($body != '')
    {
      header('Content-type: ' . $content_type);
      echo $body;
      exit;
    }
    else
    {
      header('Content-type: text/html');
      $message = '';
      
      switch ($status) {
        case 400:
          $message = 'The server could not process your request: the request was bad.';
          break;
        case 404:
          $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
          break;
        case 500:
          $message = 'The server encountered an error processing your request.';
          break;
        case 501:
          $message = 'The requested method is not implemented.';
          break;
      }
      
      // servers don't always have a signature turned on (this is an apache directive "ServerSignature On")
      $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
      
      $body = '<!DOCTYPE html>
      <html>
      <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html">
        <title>' . $status . ' ' . RestUtilities::getStatusCodeMessage($status) . '</title>
      </head>
      <body>
        <h1>' . RestUtilities::getStatusCodeMessage($status) . '</h1>
        <p>' . $message . '</p>
        <hr>
        <address>' . $signature . '</address>
      </body>
      </html>';
        
      echo $body;
    }
  }
  
  // gets the human-readable message associated with the given status code
  public static function getStatusCodeMessage($status)
  {
    $codes = Array(
      100 => 'Continue',
      101 => 'Switching Protocols',
      200 => 'OK',
      201 => 'Created',
      202 => 'Accepted',
      203 => 'Non-Authoritative Information',
      204 => 'No Content',
      205 => 'Reset Content',
      206 => 'Partial Content',
      300 => 'Multiple Choices',
      301 => 'Moved Permanently',
      302 => 'Found',
      303 => 'See Other',
      304 => 'Not Modified',
      305 => 'Use Proxy',
      306 => '(Unused)',
      307 => 'Temporary Redirect',
      400 => 'Bad Request',
      401 => 'Unauthorized',
      402 => 'Payment Required',
      403 => 'Forbidden',
      404 => 'Not Found',
      405 => 'Method Not Allowed',
      406 => 'Not Acceptable',
      407 => 'Proxy Authentication Required',
      408 => 'Request Timeout',
      409 => 'Conflict',
      410 => 'Gone',
      411 => 'Length Required',
      412 => 'Precondition Failed',
      413 => 'Request Entity Too Large',
      414 => 'Request-URI Too Long',
      415 => 'Unsupported Media Type',
      416 => 'Requested Range Not Satisfiable',
      417 => 'Expectation Failed',
      500 => 'Internal Server Error',
      501 => 'Not Implemented',
      502 => 'Bad Gateway',
      503 => 'Service Unavailable',
      504 => 'Gateway Timeout',
      505 => 'HTTP Version Not Supported'
    );
    
    return (isset($codes[$status])) ? $codes[$status] : '';
  }

}

?>