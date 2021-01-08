# Codeigniter CRUD REST API

## Requirements

- PHP 7.2 or greater

## SQL Table Configuration
------
```sql
CREATE TABLE `penduduk` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `telp` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```

## ALTER TABLE
------
```sql
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id`);
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
```

## Dummy Data
------
```sql
INSERT INTO `penduduk` (`id`, `nama`, `alamat`, `tgl_lahir`, `telp`, `email`) VALUES
(1, 'Umar Hadi Siswanto', 'disana', '1999-07-31', '082254243096', 'uhsiswanto@icloud.com'),
(2, 'John Doe', 'disini', '1987-09-01', '082312211', 'john@doe.com'),
(3, 'test', 'wkwkwkland', '1999-08-01', '082138018', 'sis@mar.com'),
(4, 'test', 'oii', NULL, '0821380182', 'sis@mssar.coms'),
(8, 'maarrr', 'hoiii', NULL, '029301090', 'adisjdi@m.ocm'),
(9, 'muehehehh', 'oke', NULL, '085464649', 'jsnajsjsj'),
(10, 'usgag', 'hsgaga', NULL, '648464', 'havaga'),
(11, 'qwert', 'ahgaga', NULL, '616464', 'uagqyq'),
(12, 'hoo', 'yasdyat', NULL, '12379128', 'aduadus@d.com'),
(13, 'llasduaiwa', 'sdawweq', NULL, '1231231211', '123123asa@asf.com'),
(14, 'sssssss', 'sdawweq', NULL, '1231231211', '123123asa@asf.com');
```

## Basic GET Example

Here is a basic example. This controller, which should be saved as `Example.php`, can be called in two ways:

* `http://domain/index.php/api/example/users` will return the list of all users
* `http://domain/index.php/api/example/users/id/1` will only return information about the user with id = 1

```php
defined('BASEPATH') OR exit('No direct script access allowed');

use umarhadi\RestServer\RestController;

class Api extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function users_get()
    {
        // Users from a data store e.g. database
        $users = [
            ['id' => 1, 'name' => 'Umar', 'email' => 'uhsiswanto@icloud.com', 'fact' => 'beban keluarga'],
            ['id' => 2, 'name' => 'Bapaknya Umar', 'email' => 'jim@jiahaha.com', 'fact' => 'suka cari duit'],
            ['id' => 3, 'name' => 'Mamaknya Umar', 'email' => 'jane@jiahaha.com', 'fact' => 'suka masak', ['hobi' => ['mancing', 'cari umpan dulu']]],
        ];

        $id = $this->get( 'id' );

        if ( $id === null )
        {
            // Check if the users data store contains users
            if ( $users )
            {
                // Set the response and exit
                $this->response( $users, 200 );
            }
            else
            {
                // Set the response and exit
                $this->response( [
                    'status' => false,
                    'message' => 'No users were found'
                ], 404 );
            }
        }
        else
        {
            if ( array_key_exists( $id, $users ) )
            {
                $this->response( $users[$id], 200 );
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'No such user found'
                ], 404 );
            }
        }
    }
}
```
---
MIT License

Copyright (c) 2021 Umar Hadi Siswanto

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.