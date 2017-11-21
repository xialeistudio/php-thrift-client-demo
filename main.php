<?php
/**
 * @author xialeistudio<xialeistudio@gmail.com>
 * @date 2017/11/21
 */
error_reporting(E_ALL);
require_once __DIR__.'/lib/Thrift/ClassLoader/ThriftClassLoader.php';
require_once __DIR__.'/format_data.php';
require_once __DIR__.'/Types.php';

$loader = new \Thrift\ClassLoader\ThriftClassLoader();
$loader->registerNamespace('Thrift', __DIR__.'/lib');
$loader->register();

$socket = new \Thrift\Transport\TSocket('localhost', 9090);
$transport = new \Thrift\Transport\TFramedTransport($socket);
$protocol = new \Thrift\Protocol\TBinaryProtocol($transport);
$client = new format_dataClient($protocol);

$transport->open();
$data = $client->do_format(new Data(['text' => 'Hello World']));
print_r($data->text);
$transport->close();