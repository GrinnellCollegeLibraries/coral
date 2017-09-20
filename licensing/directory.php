<?php
/*
**************************************************************************************************************************
** CORAL Licensing Module v. 1.0
**
** Copyright (c) 2010 University of Notre Dame
**
** This file is part of CORAL.
**
** CORAL is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
**
** CORAL is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
**
** You should have received a copy of the GNU General Public License along with CORAL.  If not, see <http://www.gnu.org/licenses/>.
**
**************************************************************************************************************************
*/

// Define the MODULE base directory, ending with |/|.
define('BASE_DIR', dirname(__FILE__) . '/');

function format_date($mysqlDate) {

	//see http://php.net/manual/en/function.date.php for options

	//there is a dependence on strtotime recognizing date format for date inputs
	//thus, european format (d-m-Y) must use dashes rather than slashes

	//upper case Y = four digit year
	//lower case y = two digit year
	//make sure digit years matches for both directory.php and common.js

	//SUGGESTED: "m/d/Y" or "d-m-Y"

	return date("m/d/Y", strtotime($mysqlDate));

}

// Include file of language codes
include_once 'LangCodes.php';
$lang_name = new LangCodes();

// Verify the language of the browser
global $http_lang;
if(isset($_COOKIE["lang"])){
    $http_lang = $_COOKIE["lang"];
}else{
    $codeL = str_replace("-","_",substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,5));
    $http_lang = $lang_name->getLanguage($codeL);
    if($http_lang == "")
      $http_lang = "en_US";
}
putenv("LC_ALL=$http_lang");
setlocale(LC_ALL, $http_lang.".utf8");
bindtextdomain("messages", dirname(__FILE__) . "/locale");
textdomain("messages");
?>
