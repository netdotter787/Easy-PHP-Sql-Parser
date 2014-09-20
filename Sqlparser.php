<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
  /**
  * Easy SQL Query Parser
  *
  * This is a wrapper class/library for php-sql-parser a pure PHP SQL (non validating) parser w/ focus on MySQL dialect of SQL.
  * 
  * Based on php-sql-parser -  https://code.google.com/p/php-sql-parser/  
  * ========================================================================
  *
  * WORKS ONLY WITH MYSQL Database Drivers
  * WILL NOT WORK FOR STORED PROCEDURES & FUNCTIONS
  *
  * ========================================================================
  * 
  * @package    CodeIgniter
  * @subpackage libraries
  * @category   library
  * @version    2.0 <beta>
  * @author     Abin Andrews Prem @mail : abinandrews@gmail.com
  */
  class Sqlparser
  {

    public $sql = "";
    public $parser;
    public $output; 

    public function __construct()
    {
      //error_reporting(E_ERROR);
      $this->ci =& get_instance();
      if ( $this->ci->db->dbdriver != 'mysql' )
      {
        show_error('Easy SQL Query Parser Library <br/> Needs the $db["default"]["dbdriver"] = "mysql"; to be set to MySQL (mysql) <br/> in application/config/database.php',  500);
        exit();
      }
      require_once dirname(__FILE__) . '/php-sql-parser/PHPSQLParser.php';     
    }

    public function parse()
    {
      try
      {
      $this->parser = new PHPSQLParser($this->sql, true);
     
      //var_dump($this->parser->parsed);
      //var_dump($this->parser->parsed['INSERT']);
      //var_dump($this->parser->parsed['UPDATE']);
      return TRUE;
      }
      catch(Exception $e)
      {
        //show_error('Easy SQL Query Parser Library <br/> '. $e . ' </b> <br/> <em>Warning and Notice errors are hidden</em>',  500);
      }
    }

    public function getTableName($id = 1)
    {
      if(array_key_exists('SELECT', $this->parser->parsed))
      {
        if( strlen($this->parser->parsed['FROM'][0]['table']) > 0 )
        {     
        $this->output = array();
        foreach( $this->parser->parsed['FROM'] as $tableName )
        {
          if($id == 1)
          array_push($this->output, $tableName['no_quotes']);

          if($id == 2)
          array_push($this->output, $tableName['table']);
        }
        return $this->output;
        }
      }

      if(array_key_exists('INSERT', $this->parser->parsed))
      {
        if( strlen($this->parser->parsed['INSERT'][0]['table']) > 0 )
        {     
        $this->output = array();
        foreach( $this->parser->parsed['INSERT'] as $tableName )
        {
          if($id == 1)
          array_push($this->output, $tableName['no_quotes']);

          if($id == 2)
          array_push($this->output, $tableName['table']);
        }
        return $this->output;
        }
      }

      if(array_key_exists('UPDATE', $this->parser->parsed))
      {
        if( strlen($this->parser->parsed['UPDATE'][0]['table']) > 0 )
        {     
        $this->output = array();
        foreach( $this->parser->parsed['UPDATE'] as $tableName )
        {
          if($id == 1)
          array_push($this->output, $tableName['no_quotes']);

          if($id == 2)
          array_push($this->output, $tableName['table']);
        }
        return $this->output;
        }
      }

      if(array_key_exists('DELETE', $this->parser->parsed))
      {
        if( strlen($this->parser->parsed['FROM'][0]['table']) > 0 )
        {     
        $this->output = array();
        foreach( $this->parser->parsed['FROM'] as $tableName )
        {
          if($id == 1)
          array_push($this->output, $tableName['no_quotes']);

          if($id == 2)
          array_push($this->output, $tableName['table']);
        }
        return $this->output;
        }
      }


      show_error('Easy SQL Query Parser Library <br/> Please check your query because no table specified <br/>
       <b>'. $this->sql . ' </b> <br/> <em>Warning and Notice errors are hidden</em>',  500);
      exit();
    }

  }