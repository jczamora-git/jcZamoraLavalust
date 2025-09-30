<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

// Load environment variables manually
if (!function_exists('load_env')) {
    function load_env($file_path) {
        if (!file_exists($file_path)) {
            return false;
        }
        
        $lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue; // Skip comments
            }
            
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                
                if (!array_key_exists($key, $_ENV)) {
                    $_ENV[$key] = $value;
                }
            }
        }
        
        return true;
    }
}

if (!function_exists('env')) {
    function env($key, $default = null) {
        return isset($_ENV[$key]) ? $_ENV[$key] : $default;
    }
}

// Load environment variables
if (defined('ROOT_DIR')) {
    load_env(ROOT_DIR . '.env');
} else {
    load_env(__DIR__ . '/../../.env');
}

/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['driver'] 		The driver of your database server.
|	['hostname'] 	The hostname of your database server.
|	['port'] 		The port used by your database server.
|	['username'] 	The username used to connect to the database
|	['password'] 	The password used to connect to the database
|	['database'] 	The name of the database you want to connect to
|	['charset']		The default character set
|   ['dbprefix']    You can add an optional prefix, which will be added
|				    to the table name when using the  Query Builder class
|   You can create new instance of the database by adding new element of
|   $database variable.
|   Example: $database['another_example'] = array('key' => 'value')
*/

$database['main'] = array(
    'driver'	=> 'mysql',
    'hostname'	=> env('DB_HOSTNAME', 'localhost'),
    'port'		=> env('DB_PORT', '3306'),
    'username'	=> env('DB_USERNAME', 'root'),
    'password'	=> env('DB_PASSWORD', ''),
    'database'	=> env('DB_DATABASE', 'students_db'),
    'charset'	=> env('DB_CHARSET', 'utf8mb4'),
    'dbprefix'	=> env('DB_PREFIX', ''),
    // Optional for SQLite
    'path'      => ''
);

?>