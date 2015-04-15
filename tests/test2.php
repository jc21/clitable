<?php

// Test with different table border characters

require_once __DIR__ . '/../vendor/autoload.php';

use jc21\CliTable;
use jc21\CliTableManipulator;

include('data.php');

$table = new CliTable;
$table->setChars(array(
    'top'          => '-',
    'top-mid'      => '+',
    'top-left'     => '+',
    'top-right'    => '+',
    'bottom'       => '-',
    'bottom-mid'   => '+',
    'bottom-left'  => '+',
    'bottom-right' => '+',
    'left'         => '|',
    'left-mid'     => '+',
    'mid'          => '-',
    'mid-mid'      => '+',
    'right'        => '|',
    'right-mid'    => '+',
    'middle'       => '| ',
));

$table->setTableColor('green');
$table->setHeaderColor('yellow');
$table->addField('First Name', 'firstName',    false,                               'cyan');
$table->addField('Last Name',  'lastName',     false,                               'cyan');
$table->addField('DOB',        'dobTime',      new CliTableManipulator('datelong'));
$table->addField('Admin',      'isAdmin',      new CliTableManipulator('yesno'),    'yellow');
$table->addField('Last Seen',  'lastSeenTime', new CliTableManipulator('nicetime'), 'red');
$table->addField('Expires',    'expires',      new CliTableManipulator('duetime'),  'white');
$table->injectData($data);
$table->display();

