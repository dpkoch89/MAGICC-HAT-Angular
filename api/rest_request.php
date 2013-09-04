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
  private $method_; // the HTTP request method
  private $table_; // the database table specified in the request URL
  private $id_; // the record ID (if any) specified in the request URL
  private $data_; // the parsed JSON data passed in with the HTTP request
  
  public function __construct()
  {
    $this->table_ = '';
    $this->id_ = '';
    $this->has_id_ = false;
    $this->request_payload_ = array();
    $this->data_ = '';
    $this->method_ = 'get';
  }
  
  public function getMethod()
  {
    return $this->method_;
  }
  
  public function setMethod($method)
  {
    $this->method_ = $method;
  }
  
  public function getTable()
  {
    return $this->table_;
  }
  
  public function setTable($table)
  {
    $this->table_ = $table;
  }
  
  public function getID()
  {
    return $this->id_;
  }
  
  public function setID($id)
  {
    $this->id_ = $id;
  }
  
  public function getHasID()
  {
    return $this->has_id_;
  }
  
  public function setHasID($has_id)
  {
    $this->has_id_ = $has_id;
  }
  
  public function getData()
  {
    return $this->data_;
  }
  
  public function setData($data)
  {
    $this->data_ = $data;
  }
}

?>