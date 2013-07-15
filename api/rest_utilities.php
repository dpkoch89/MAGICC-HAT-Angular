<!--
  
  File: rest_utilities.php
  Author: Daniel Koch <dkoch89@gmail.com>
  Date: 14 July 2013
  
  Provides the RestUtilities class
  
-->

<?php

// include required files
require_once($_SERVER['DOCUMENT_ROOT'] . '/api/rest_request.php');

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
    
    // get data
    switch ($request_method)
    {
      case 'get':
        $data = $_GET;
        break;
      case 'post':
        $data = $_POST;
        break;
      case 'put':
        parse_str(file_get_contents('php://input'), $put_vars);
        $data = $put_vars;
        break;
        
      // note: we don't accept data for delete request, so 'delete' is not included in this switch statement 
    }

    // store the method
    $return_obj->setMethod($request_method);
    
    // store the raw data in case we need it later
    $return_obj->setRequestVars($data['data']); // assumes the data is passed in as JSON data with 'data' as the key (e.g. /..?data=<json data>), may need to change depending on how AngularJS does it
    
    // store the decoded data
    if (isset($data['data']))
    {
      $return_obj->setData(json_decode($data['data']));
    }
    
    // return the object
    return $return_obj;
  }
  
  // sends the HTTP response with the status code and body provided in the function arguments
  public static function sendResponse($status = 200, $body = '', $content_type = 'text/html')
  {
    
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
    
    return (isset($codes($status))) ? $codes($status) : '';
  }

}

?>