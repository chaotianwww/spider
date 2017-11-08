[![Build Status](https://travis-ci.org/voku/simple-mysqli.svg?branch=master)](https://travis-ci.org/voku/simple-mysqli)
[![Coverage Status](https://coveralls.io/repos/github/voku/simple-mysqli/badge.svg?branch=master)](https://coveralls.io/github/voku/simple-mysqli?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/voku/simple-mysqli/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/voku/simple-mysqli/?branch=master)
[![Codacy Badge](https://www.codacy.com/project/badge/797ba3ba657d4e0e86f0bade6923fdec)](https://www.codacy.com/app/voku/simple-mysqli)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f1ad7660-6b85-4e1e-a7a3-8489b96b64f8/mini.png)](https://insight.sensiolabs.com/projects/f1ad7660-6b85-4e1e-a7a3-8489b96b64f8)
[![Dependency Status](https://www.versioneye.com/php/voku:simple-mysqli/dev-master/badge.svg)](https://www.versioneye.com/php/voku:simple-mysqli/dev-master)
[![Latest Stable Version](https://poser.pugx.org/voku/simple-mysqli/v/stable)](https://packagist.org/packages/voku/simple-mysqli) 
[![Total Downloads](https://poser.pugx.org/voku/simple-mysqli/downloads)](https://packagist.org/packages/voku/simple-mysqli) 
[![Latest Unstable Version](https://poser.pugx.org/voku/simple-mysqli/v/unstable)](https://packagist.org/packages/voku/simple-mysqli) 
[![PHP 7 ready](http://php7ready.timesplinter.ch/voku/simple-mysqli/badge.svg)](https://travis-ci.org/voku/simple-mysqli)
[![License](https://poser.pugx.org/voku/simple-mysqli/license)](https://packagist.org/packages/voku/simple-mysqli)

Simple MySQLi Class
===================


This is a simple MySQL Abstraction Layer compatible with PHP 5.3+, PHP 7 that provides a simple 
and _secure_ interaction with your database using mysqli_* functions at 
its core. This is perfect for small scale applications such as cron jobs, 
facebook canvas campaigns or micro frameworks or sites. 


## Get "Simple MySQLi"

You can download it from here, or require it using [composer](https://packagist.org/packages/voku/simple-mysqli).
```json
  {
      "require": {
        "voku/simple-mysqli": "5.*"
      }
  }
```

## Install via "composer require"
```shell
  composer require voku/simple-mysqli
```

* [Starting the driver](#starting-the-driver)
* [Multiton && Singleton](#multiton--singleton)
* [Using the "DB"-Class](#using-the-db-class)
  * [Selecting and retrieving data from a table](#selecting-and-retrieving-data-from-a-table)
  * [Inserting data on a table](#inserting-data-on-a-table)
  * [Binding parameters on queries](#binding-parameters-on-queries)
  * [Transactions](#transactions)
* [Using the "Result"-Class](#using-the-result-class)
  * [Fetching all data](#fetching-all-data) 
  * [Fetching database-table-fields](#fetching-database-table-fields)
  * [Fetching + Callable](#fetching--callable)
  * [Fetching + Transpose](#fetching--transpose)
  * [Fetching + Pairs](#fetching--pairs)
  * [Fetching + Groups](#fetching--groups)
  * [Fetching + first](#fetching--first)
  * [Fetching + last](#fetching--last)
  * [Fetching + slice](#fetching--slice)
  * [Fetching + map](#fetching--map)
  * [Fetching + aliases](#fetching--aliases)
  * [Fetching + Iterations](#fetching--iterations)
* [Using the "Prepare"-Class](#using-the-prepare-class)
  * [INSERT-Prepare-Query (example)](#insert-prepare-query-example)
  * [SELECT-Prepare-Query (example)](#select-prepare-query-example)
* [Using the "ActiveRecord"-Class (OOP database-access)](#using-the-activerecord-class-oop-database-access)
    * [setDb(DB $db)](#setdbdb-db)
    * [insert() : boolean|int](#insert--booleanint)
    * [fetch(integer $id = null) : boolean|\ActiveRecord](#fetchinteger--id--null--booleanactiverecord)
    * [fetchAll() : $this[]](#fetchall--this)
    * [update() : boolean|int](#update--booleanint)
    * [delete() : boolean](#update--booleanint)
  * [Active Record | SQL part functions](#active-record--sql-part-functions)
    * [select()](#select)
    * [from()](#from)
    * [join()](#join)
    * [where()](#where)
    * [group()](#group)
    * [order()](#order)
    * [limit()](#limit)
  * [Active Record | WHERE conditions](#active-record--where-conditions)
    * [equal()/eq()](#equaleq)
    * [notEqual()/ne()](#notequalne)
    * [greaterThan()/gt()](#greaterthangt)
    * [lessThan()/lt()](#lessthanlt)
    * [greaterThanOrEqual()/ge()/gte()](#greaterthanorequalgegte)
    * [lessThanOrEqual()/le()/lte()](#lessthanorequallelte)
    * [like()](#like)
    * [in()](#in)
    * [notIn()](#notin)
    * [isNull()](#isnull)
    * [isNotNull()/notNull()](#isnotnullnotnull)
  * [Active Record | Demo](#active-record---demo)
* [Logging and Errors](#logging-and-errors)
* [Changelog](#changelog)


## Starting the driver
```php
  use voku\db\DB;

  require_once 'composer/autoload.php';

  $db = DB::getInstance('yourDbHost', 'yourDbUser', 'yourDbPassword', 'yourDbName');
  
  // example
  // $db = DB::getInstance('localhost', 'root', '', 'test');
```

## Multiton && Singleton

You can use ```DB::getInstance()``` without any parameters and you will get your (as "singleton") first initialized connection. Or you can change the parameter and you will create an new "multiton"-instance which works like an singleton, but you need to use the same parameters again, otherwise (without the same parameter) you will get an new instance. 

## Using the "DB"-Class

There are numerous ways of using this library, here are some examples of the most common methods.

#### Selecting and retrieving data from a table

```php
  use voku\db\DB;
  
  $db = DB::getInstance();
  
  $result = $db->query("SELECT * FROM users");
  $users  = $result->fetchAll();
```

But you can also use a method for select-queries:

```php
  $db->select(string $table, array $where); // generate an SELECT query
```

Example: SELECT
```php
  $where = array(
      'page_type ='         => 'article',
      'page_type NOT LIKE'  => '%öäü123',
      'page_id >='          => 2,
  );
  $articles = $db->select('page', $where);
  
  echo 'There are ' . count($articles) . ' article(s):' . PHP_EOL;
  
  foreach ($articles as $article) {
      echo 'Type: ' . $article['page_type'] . PHP_EOL;
      echo 'ID: ' . $article['page_id'] . PHP_EOL;
  }
```

Here is a list of connectors for the "WHERE"-array:
'NOT', 'IS', 'IS NOT', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN', 'LIKE', 'NOT LIKE', '>', '<', '>=', '<=', '<>'

INFO: use an array as $value for "[NOT] IN" and "[NOT] BETWEEN"

Example: SELECT with "NOT IN"
```php
  $where = array(
      'page_type NOT IN'     => array(
          'foo',
          'bar'
      ),
      'page_id >'            => 2,
  );
  $resultSelect = $db->select('page', $where);
```

Example: SELECT with Cache
```php
  $resultSelect = $db->execSQL("SELECT * FROM users", true, 3600);
```

The result (via $result->fetchAllArray()) is only cached for 3600s when the query was a SELECT statement, otherwise you get the default result from the ```$db->query()``` function. 

#### Inserting data on a table

to manipulate tables you have the most important methods wrapped,
they all work the same way: parsing arrays of key/value pairs and forming a safe query

the methods are:
```php
  $db->insert( string $table, array $data );                // generate an INSERT query
  $db->replace( string $table, array $data );               // generate an REPLACE query
  $db->update( string $table, array $data, array $where );  // generate an UPDATE query
  $db->delete( string $table, array $where );               // generate a DELETE query
```

All methods will return the resulting `mysqli_insert_id()` or true/false depending on context.
The correct approach if to always check if they executed as success is always returned

Example: DELETE
```php
  $deleteArray = array('user_id' => 9);
  $ok = $db->delete('users', $deleteArray);
  if ($ok) {
    echo "user deleted!";
  } else {
    echo "can't delete user!";
  }
```

**note**: all parameter values are sanitized before execution, you don\'t have to escape values beforehand.

Example: INSERT
```php
  $insertArray = array(
    'name'   => "John",
    'email'  => "johnsmith@email.com",
    'group'  => 1,
    'active' => true,
  );
  $newUserId = $db->insert('users', $insertArray);
  if ($newUserId) {
    echo "new user inserted with the id $new_user_id";
  }
```

Example: REPLACE
```php
  $replaceArray = array(
      'name'   => 'lars',
      'email'  => 'lars@moelleken.org',
      'group'  => 0
  );
  $tmpId = $db->replace('users', $replaceArray);
```

#### Binding parameters on queries

Binding parameters is a good way of preventing mysql injections as the parameters are sanitized before execution.

```php
  $sql = "SELECT * FROM users 
    WHERE id_user = :id_user
    AND active = :active
    LIMIT 1
  ";
  $result = $db->query($sql, array('id_user' => 11, 'active' => 1));
  if ($result) {
    $user = $result->fetchArray();
    print_r($user);
  } else {
    echo "user not found";
  }
```

#### Transactions

Use `begin()`, `commit()`, and `rollback()` to manage transactions:

```php
$db->beginTransaction();

$db->query(
    'UPDATE `users` SET `foo` = :foo WHERE id = :id',
    array('foo' => 100, 'id' => 1)
);
$db->query(
    'UPDATE `users_noop` SET `foo` = :foo WHERE id = :id',
    array('foo' => 100, 'id' => 2)
);

$db->endTransaction();
```

Any SQL errors between `begin()` and `commit()` will yield a `RuntimeException`.

You can also use the `DB->transact()` method. The following is equivalent
to the above:

```php
$db->transact(function($db) {
    $db->query(
        'UPDATE `users` SET `foo` = :foo WHERE id = :id',
        array('foo' => 100, 'id' => 1)
    );
    $db->query(
        'UPDATE `users_noop` SET `foo` = :foo WHERE id = :id',
        array('foo' => 100, 'id' => 2)
    );
});
```

## Using the "Result"-Class

After executing a `SELECT` query you receive a `Result` object that will help you manipulate the resultant data.
there are different ways of accessing this data, check the examples bellow:

#### Fetching all data

```php
  $result = $db->query("SELECT * FROM users");
  $allUsers = $result->fetchAll();
```
Fetching all data works as `object`, `array` or `Arrayy` the `fetchAll()` method will return the default based on the `$_default_result_type` config.
Other methods are:

```php
  $row = $result->fetch();        // fetch an single result row as defined by the config (array, object or Arrayy)
  $row = $result->fetchArray();   // fetch an single result row as array
  $row = $result->fetchObject();  // fetch an single result row as object
  
  $data = $result->fetchAll();        // fetch all result data as defined by the config (array, object or Arrayy)
  $data = $result->fetchAllArray();   // fetch all result data as array
  $data = $result->fetchAllObject();  // fetch all result data as object
  
  $data = $result->fetchColumn(string $column, bool $skipNullValues);    // fetch a single column as string
  $data = $result->fetchAllColumn(string $column, bool $skipNullValues); // fetch a single column as an 1-dimension array
  $data = $result->fetchArrayPair(string $key, string $value);           // fetch data as a key/value pair array
```

#### Fetching database-table-fields

Returns rows of field information in a result set:

```php
$fields = $result->fetchFields();
```

Pass `true` as argument if you want each field information returned as an
associative array instead of an object. The default is to return each as an
object, exactly like the `mysqli_fetch_fields` function.

#### Fetching + Callable

Fetches a row or a single column within a row:

```php
$data = $result->fetch($row_number, $column);
```

This method forms the basis of all fetch_ methods. All forms of fetch_ advances
the internal row pointer to the next row. `null` will be returned when there are
no more rows to be fetched.

#### Fetching + Transpose

Returns all rows at once, transposed as an array of arrays:

```php
$plan_details = $plans->fetchTranspose();
```

Transposing a result set of X rows each with Y columns will result in an array
of Y rows each with X columns.

Pass a column name as argument to return each column as an associative array
with keys taken from values of the provided column. If not provided, the keys
will be numeric starting from zero.

e.g.:
```php
$transposedExample = array(
  'title' => array(
    1 => 'Title #1',
    2 => 'Title #2',
    3 => 'Title #3',
  )
);
```

#### Fetching + Pairs

Returns all rows at once as key-value pairs using the column in the first
argument as the key:

```php
$countries = $result->fetchPairs('id');
```

Pass a column name as the second argument to only return a single column as the
value in each pair:

```php
$countries = $result->fetchPairs('id', 'name');

/*
array(
  1 => 'Title #1',
  2 => 'Title #2',
  3 => 'Title #3',
)
*/
```

#### Fetching + Groups

Returns all rows at once as a grouped array:

```php
$students_grouped_by_gender = $result->fetchGroups('gender');
```

Pass a column name as the second argument to only return single columns as the
values in each groups:

```php
$student_names_grouped_by_gender = $result->fetchGroups('gender', 'name');
```

#### Fetching + first

Returns the first row element from the result:

```php
$first = $result->first();
```

Pass a column name as argument to return a single column from the first row:

```php
$name = $result->first('name');
```

#### Fetching + last

Returns the last row element from the result:

```php
$last = $result->last();
```

Pass a column name as argument to return a single column from the last row:

```php
$name = $result->last('name');
```

#### Fetching + slice

Returns a slice of rows from the result:

```php
$slice = $result->slice(1, 10);
```

The above will return 10 rows skipping the first one. The first parameter is the
zero-based offset; the second parameter is the number of elements; the third
parameter is a boolean value to indicate whether to preserve the keys or not
(optional and defaults to false). This methods essentially behaves the same as
PHP's built-in `array_slice()` function.

#### Fetching + map

Sets a mapper callback function that's used inside the `Result->fetchCallable()` method:

```php
$result->map(function($row) {
    return (object) $row;
});
$object = $result->fetchCallable(0);
```

The above example will map one row (0) from the result into a
object. Set the mapper callback function to null to disable it.

#### Fetching + aliases
```php
  $db->get()                  // alias for $db->fetch();
  $db->getAll()               // alias for $db->fetchAll();
  $db->getObject()            // alias for $db->fetchAllObject();
  $db->getArray()             // alias for $db->fetchAllArray();
  $db->getArrayy()            // alias for $db->fetchAllArrayy();
  $db->getColumn($key)        // alias for $db->fetchColumn($key);
```

#### Fetching + Iterations
To iterate a result-set you can use any fetch() method listed above.

```php
  $result = $db->select('users');

  // using while
  while ($row = $result->fetch()) {
    echo $row->name;
    echo $row->email;
  }

  // using foreach (v1)
  foreach($result->fetchAll() as $row) {
    echo $row->name;
    echo $row->email;
  }
  
  // using foreach (v2)
  foreach($result as $row) {
    echo $row->name;
    echo $row->email;
  }
  
  // INFO: "while + fetch()" will use less memory that "foreach + "fetchAll()", because we will fetch each result entry seperatly
```

## Using the "Prepare"-Class

Prepare statements have the advantage that they are built together in the MySQL-Server, so the performance is better.

But the debugging is harder and logging is impossible (via PHP), so we added a wrapper for "bind_param" called "bind_param_debug". 
With this wrapper we pre-build the sql-query via php (only for debugging / logging). Now you can e.g. echo the query.

INFO: You can still use "bind_param" instead of "bind_param_debug", e.g. if you need better performance.

#### INSERT-Prepare-Query (example)
```php
  use voku\db\DB;
  
  $db = DB::getInstance();
  
  // ------------- 
  // prepare the queries
  
  $query = 'INSERT INTO users
    SET 
      name = ?, 
      email = ?
  ';
  
  $prepare = $db->prepare($query);
  
  $name = '';
  $email = '';
  
  $prepare->bind_param_debug('ss', $name, $email);
  
  // -------------
  // execute query no. 1
  
  // INFO: "$template" and "$type" are references, since we use "bind_param" or "bind_param_debug" 
  $name = 'name_1_中';
  $email = 'foo@bar.com';
  
  $prepare->execute();
  
  // DEBUG
  echo $prepare->get_sql_with_bound_parameters();
  
  // -------------
  // execute query no. 2
  
  // INFO: "$template" and "$type" are references, since we use "bind_param" or "bind_param_debug"  
  $name = 'Lars';
  $email = 'lars@moelleken.org';
  
  $prepare->execute();
  
  // DEBUG
  echo $prepare->get_sql_with_bound_parameters();
```

#### SELECT-Prepare-Query (example)
```php
  use voku\db\DB;
  
  $db = DB::getInstance();
  
  // -------------
  // insert some dummy-data, first
  
  $data = array(
      'page_template' => 'tpl_test_new123123',
      'page_type'     => 'ö\'ä"ü',
  );

  // will return the auto-increment value of the new row
  $resultInsert[1] = $db->insert($this->tableName, $data);
  $resultInsert[2] = $db->insert($this->tableName, $data);

  // ------------- 
  // prepare the queries

  $sql = 'SELECT * FROM ' . $this->tableName . ' 
    WHERE page_id = ?
  ';

  $prepare = $this->db->prepare($sql);
  $page_id = 0;
  $prepare->bind_param_debug('i', $page_id);

  // ------------- 
  // execute query no. 1

  $page_id = $resultInsert[1];
  $result = $prepare->execute();
  $data = $result->fetchArray();

  // $data['page_template'] === 'tpl_test_new123123'
  // $data['page_id'] === $page_id

  // ------------- 
  // execute query no. 2

  $page_id = $resultInsert[2];
  $result = $prepare->execute();
  $data = $result->fetchArray();

  // $data['page_id'] === $page_id
  // $data['page_template'] === 'tpl_test_new123123'
```

## Using the "ActiveRecord"-Class (OOP database-access)

A simple implement of active record pattern via Arrayy.

#### setDb(DB $db) 
set the DB connection.

```php
  $db = DB::getInstance('YOUR_MYSQL_SERVER', 'YOUR_MYSQL_USER', 'YOUR_MYSQL_PW', 'YOUR_DATABASE');
  ActiveRecord::setDb($db);
```

#### insert() : boolean|int
This function can build insert SQL queries and can insert the current record into database.
If insert was successful, it will return the new id, otherwise it will return false or true (if there are no dirty data).

```php
  $user = new User();
  $user->name = 'demo';
  $user->password = password_hash('demo', PASSWORD_BCRYPT, array("cost"=>15));
  $user_id = $user->insert();
  
  var_dump($user_id); // the new id 
  var_dump($user->id); // also the new id 
  var_dump($user->getPrimaryKey()); // also the new id 
```

#### fetch(integer  $id = null) : boolean|\ActiveRecord
This function can fetch one record and assign in to current object, otherwise it will return "false".
If you call this function with the $id parameter, it will fetch records by using the current primary-key-name.

```php
  $user = new User();

  $user->notnull('id')->order('id desc')->fetch();
  
  // OR //
  
  $user->fetch(1);
  
  // OR //
  
  $user->fetchById(1); // thows "FetchingException" if the ID did not exists
  
  // OR //
  
  $user->fetchByIdIfExists(1); // return NULL if the ID did not exists
  
  var_dump($user->id); // (int) 1
  var_dump($user->getPrimaryKey()); // (int) 1
```

#### fetchAll() : $this[]
This function can fetch all records in the database and will return an array of ActiveRecord objects.

```php
  $user = new User();

  $users = $user->fetchAll();
  
  // OR //
  
  $users = $user->fetchByIds(array(1));
  
  // OR //
  
  $users = $user->fetchByIdsPrimaryKeyAsArrayIndex(array(1));
    
  var_dump($users[0]->id) // (int) 1
  var_dump($users[0]->getPrimaryKey()); // (int) 1
```

#### update() : boolean|int
This function can build update SQL queries and can update the current record in database, just write the dirty data into database.
If update was successful, it will return the affected rows as int, otherwise it will return false or true (if there are no dirty data).

```php
  $user = new User();
  $user->notnull('id')->orderby('id desc')->fetch();
  $user->email = 'test@example.com';
  $user->update();
```

#### delete() : boolean
This function can delete the current record in the database. 

### Active Record | SQL part functions

#### select()
This function can set the select columns.

```php
  $user = new User();
  $user->select('id', 'name')->fetch();
```

#### from()
This function can set the table to fetch record from.

```php
  $user = new User();
  $user->select('id', 'name')->from('user')->fetch();
```

#### join()
This function can set the table to fetch record from.

```php
  $user = new User();
  $user->join('contact', 'contact.user_id = user.id')->fetch();
```

#### where()
This function can set where conditions.

```php
  $user = new User();
  $user->where('id=1 AND name="demo"')->fetch();
```

#### group()
This function can set the "group by" conditions.

```php
  $user = new User();
  $user->select('count(1) as count')->group('name')->fetchAll();
```

#### order()
This function can set the "order by" conditions.

```php
  $user = new User();
  $user->order('name DESC')->fetch();
```

#### limit()
This function can set the "limit" conditions.

```php
  $user = new User();
  $user->order('name DESC')->limit(0, 1)->fetch();
```

### Active Record | WHERE conditions

#### equal()/eq()

```php
  $user = new User();
  $user->eq('id', 1)->fetch();
```

#### notEqual()/ne()

```php
  $user = new User();
  $user->ne('id', 1)->fetch();
```

#### greaterThan()/gt()

```php
  $user = new User();
  $user->gt('id', 1)->fetch();
```

#### lessThan()/lt()

```php
  $user = new User();
  $user->lt('id', 1)->fetch();
```

#### greaterThanOrEqual()/ge()/gte()

```php
  $user = new User();
  $user->ge('id', 1)->fetch();
```

#### lessThanOrEqual()/le()/lte()

```php
  $user = new User();
  $user->le('id', 1)->fetch();
```

#### like()

```php
  $user = new User();
  $user->like('name', 'de')->fetch();
```

#### in()

```php
  $user = new User();
  $user->in('id', array(1, 2))->fetch();
```

#### notIn()

```php
  $user = new User();
  $user->notin('id', array(1,3))->fetch();
```

#### isNull()

```php
  $user = new User();
  $user->isnull('id')->fetch();
```

#### isNotNull()/notNull()

```php
  $user = new User();
  $user->isNotNull('id')->fetch();
```


### Active Record |  Demo

#### Include && Init

```php
use voku\db\DB;
use voku\db\ActiveRecord;

require_once 'composer/autoload.php';

$db = DB::getInstance('YOUR_MYSQL_SERVER', 'YOUR_MYSQL_USER', 'YOUR_MYSQL_PW', 'YOUR_DATABASE');
ActiveRecord::setDb($db);
```

#### Define Class
```php
namespace demo;

use voku\db\ActiveRecord;

class User extends ActiveRecord {
  public $table = 'user';
  public $primaryKey = 'id';
  
  public $relations = array(
    // format is array($relation_type, $child_namespaced_classname, $foreign_key_of_child)
    'contacts' => array(
      self::HAS_MANY, 
      'Contact', 
      'user_id'
    ),
    // format may be array($relation_type, $child_namespaced_classname, $foreign_key_of_child, $array_of_sql_part_functions)
    'contact' => array(
      self::HAS_ONE, 
      'Contact', 
      'user_id', 
      array(
        'where' => '1', 
        'order' => 
        'id desc')
      ),
  );
}

class Contact extends ActiveRecord{
  public $table = 'contact';
  public $primaryKey = 'id';
  
  public $relations = array(
    // format is array($relation_type, $parent_namespaced_classname, $foreign_key_in_current_table)
    'user' => array(
      self::BELONGS_TO, 
      'User', 
      'user_id'
    ),
  );
}
```

#### Init data (for testing - use migrations for this step, please)
```php
ActiveRecord::execute("
  CREATE TABLE IF NOT EXISTS user (
    id INTEGER PRIMARY KEY, 
    name TEXT, 
    password TEXT 
  );"
);

ActiveRecord::execute("
  CREATE TABLE IF NOT EXISTS contact (
    id INTEGER PRIMARY KEY, 
    user_id INTEGER, 
    email TEXT,
    address TEXT
  );"
);
```

#### Insert one User into database.
```php
use demo\User;

$user = new User();
$user->name = 'demo';
$user->password = password_hash('demo', PASSWORD_BCRYPT, array("cost"=>15));
$user_id = $user->insert();

var_dump($user_id); // the new id 
var_dump($user->id); // also the new id 
var_dump($user->getPrimaryKey()); // also the new id 
```

#### Insert one Contact belongs the current user.
```php
use demo\Contact;

$contact = new Contact();
$contact->address = 'test';
$contact->email = 'test1234456@domain.com';
$contact->user_id = $user->id;

var_dump($contact->insert()); // the new id 
var_dump($contact->id); // also the new id 
var_dump($contact->getPrimaryKey()); // also the new id 
```

#### Example to using relations 
```php
use demo\User;
use demo\Contact;

$user = new User();

// fetch one user
var_dump($user->notnull('id')->orderby('id desc')->fetch());

echo "\nContact of User # {$user->id}\n";
// get contacts by using relation:
//   'contacts' => array(self::HAS_MANY, 'Contact', 'user_id'),
var_dump($user->contacts);

$contact = new Contact();

// fetch one contact
var_dump($contact->fetch());

// get user by using relation:
//    'user' => array(self::BELONGS_TO, 'User', 'user_id'),
var_dump($contact->user);
```

## Logging and Errors

You can hook into the "DB"-Class, so you can use your personal "Logger"-Class. But you have to cover the methods:

```php
$this->trace(string $text, string $name) { ... }
$this->debug(string $text, string $name) { ... }
$this->info(string $text, string $name) { ... }
$this->warn(string $text, string $name) { ... } 
$this->error(string $text, string $name) { ... }
$this->fatal(string $text, string $name) { ... }
```

You can also disable the logging of every sql-query, with the "getInstance()"-parameter "logger_level" from "DB"-Class.
If you set "logger_level" to something other than "TRACE" or "DEBUG", the "DB"-Class will log only errors anymore.

```php
DB::getInstance(
    getConfig('db', 'hostname'),        // hostname
    getConfig('db', 'username'),        // username
    getConfig('db', 'password'),        // password
    getConfig('db', 'database'),        // database
    getConfig('db', 'port'),            // port
    getConfig('db', 'charset'),         // charset
    true,                               // exit_on_error
    true,                               // echo_on_error
    'cms\Logger',                       // logger_class_name
    getConfig('logger', 'level'),       // logger_level | 'TRACE', 'DEBUG', 'INFO', 'WARN', 'ERROR', 'FATAL'
    getConfig('session', 'db')          // session_to_db
);
```

Showing the query log: The log comes with the SQL executed, the execution time and the result row count.

```php
  print_r($db->log());
```

To debug mysql errors, use `$db->errors()` to fetch all errors (returns false if there are no errors) or `$db->lastError()` for information about the last error. 

```php
  if ($db->errors()) {
    echo $db->lastError();
  }
```

But the easiest way for debugging is to configure "DB"-Class via "DB::getInstance()" to show errors and exit on error (see the example above). Now you can see SQL-errors in your browser if you are working on "localhost" or you can implement your own "checkForDev()" via a simple function, you don't need to extend the "Debug"-Class. If you will receive error-messages via e-mail, you can implement your own "mailToAdmin()"-function instead of extending the "Debug"-Class.

## Changelog

See [CHANGELOG.md](CHANGELOG.md).
