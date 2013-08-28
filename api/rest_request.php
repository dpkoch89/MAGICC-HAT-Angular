<?php

/*
 * File: rest_request.php
 * Author: Daniel Koch <dkoch89@gmail.com>
 * Date: 14 July 2013
 * 
 * Provides the RestRequest class
 */

/*
 * RestRequest
 * 
 * This class is used for storing information about the http request so that other classes can access that information
 */
class RestRequest
{
  private $request_vars_; // the request variables passed in with the HTTP request
  private $data_; // the parsed JSON data passed in with the HTTP request
  private $http_accept_; // we don't need this?
  private $method_; // the HTTP request method
  
  public function __construct()
  {
    $this->request_vars_ = array();
    $this->data_ = '';
    $this->http_accept_ = 'json'; // do we need this if we're only providing json encoded data?
    $this->method_ = 'get';
  }
  
  public function getRequestVars()
  {
    return $this->request_vars_;
  }
  
  public function setRequestVars($request_vars)
  {
    $this->request_vars_ = $request_vars;
  }
  
  public function getData()
  {
    return $this->data_;
  }
  
  public function setData($data)
  {
    $this->data_ = $data;
  }
  
  public function getHttpAccept() // do we need this?
  {
    return $this->http_accept_;
  }
  
  public function getMethod()
  {
    return $this->method_;
  }
  
  public function setMethod($method)
  {
    $this->method_ = $method;
  }
}

?>