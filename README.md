Easy-PHP-Sql-Parser
===================

A codeigniter library for handling php-sql-parser (Note. Only for handling MySQL database queries)

Uses
===================

  Can be used to check a sql query is correct in syntax before actually executing a query.
  Can be used to verify a query should be executed at all (Secure SQL queries by checking the table name)
  Create SQL queries at runtime (Under Development)
  
  
How to Use in CodeIgniter
==================-

  1. First copy the contents into /application/libraries folder
  
  Use the following in a controller
  2. $this->load->library('sqlparser') to load the library
  
  3. $this->sqlparser->sql = 'Enter your query here';
			if($this->sqlparser->parse())
			{
				
					$tableName = $this->sqlparser->getTableName();
					
			}
			
	4. $tablename will return array of tables present in the queries.
	
	5. To get a tablename $tableName[0] (First table) name

Methods Available
==================

getTableName()

Will return table names irrespective of what type of query is passed.




Thanks, orginal php-sql-parser library 
https://code.google.com/p/php-sql-parser/


MIT License 2014
