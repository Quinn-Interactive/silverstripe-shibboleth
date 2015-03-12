<?php
Authenticator::register_authenticator('ShibbolethAuthenticator');

## The following is for debugging
$baseSAMLPath = dirname(__FILE__) . '/thirdparty/simplesaml';
set_include_path(get_include_path() . PATH_SEPARATOR . $baseSAMLPath . PATH_SEPARATOR . $baseSAMLPath . '/lib'  );
require_once 'lib/_autoload.php';
