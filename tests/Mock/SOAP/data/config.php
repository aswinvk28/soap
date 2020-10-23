<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$classmap = require_once __DIR__ . '/classmap.php';

return array(
    'authType' => '',
    'encoding' => 'ISO-8859-1',
    'location' => '',
    'uri' => '',
    'soap_version' => SOAP_1_2,
    'compression' => SOAP_COMPRESSION_ACCEPT,
    'trace' => true,
    'classmap' => $classmap,
    'exceptions' => true,
    'connection_timeout' => 20,
    'type_map' => array(
        'type_name' => '',
        'type_ns' => '',
        'from_xml' => '',
        'to_xml' => ''
    ),
    'cache_wsdl' => WSDL_CACHE_NONE,
    'user_agent' => '',
    'stream_context' => array(
        'http' => array(),
        'ftp' => array(),
        'file' => array(),
        'PHP' => array(),
        'ssh' => array()
    ),
    'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
    'keep_alive' => true,
    'ssl_method' => ''
);