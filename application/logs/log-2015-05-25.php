<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2015-05-25 20:34:31 --> 404 Page Not Found: Static/js
ERROR - 2015-05-25 20:34:36 --> Severity: Warning --> pg_query(): Query failed: ERROR:  duplicate key value violates unique constraint &quot;chk_unique_nom_mar&quot;
DETAIL:  Key (mar_nom)=(Datsun) already exists. /Applications/MAMP/htdocs/SICH/system/database/drivers/postgre/postgre_driver.php 242
ERROR - 2015-05-25 20:34:36 --> Query error: ERROR:  duplicate key value violates unique constraint "chk_unique_nom_mar"
DETAIL:  Key (mar_nom)=(Datsun) already exists. - Invalid query: INSERT INTO "marca" ("mar_nom") VALUES ( E'Datsun')
ERROR - 2015-05-25 20:34:36 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /Applications/MAMP/htdocs/SICH/system/core/Exceptions.php:272) /Applications/MAMP/htdocs/SICH/system/core/Common.php 569
ERROR - 2015-05-25 20:34:36 --> Severity: Error --> Call to undefined method CI_DB_postgre_driver::_error_number() /Applications/MAMP/htdocs/SICH/application/models/Mark.php 23
