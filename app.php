#!/usr/bin/php
<?php

use App\Factory\CakeCalculatorFactory;

ini_set('auto_detect_line_endings',TRUE);
date_default_timezone_set('UTC');
require __DIR__ . '/vendor/autoload.php';

$climate = new League\CLImate\CLImate;

$climate->out('Please enter the path and filename for input data');
$climate->out('E.g.: /var/tmp/birthdays.csv');

$input = $climate->input('Path and filename for input data: ');
$climate->out('Or just hit ENTER for default "./bdinput.csv"');
$input->defaultTo(__DIR__ . '/bdinput.csv');
$csvFilename = $input->prompt();

$output = $climate->input('Path and filename for output data: ');
$climate->out('Default output to: ./bdcakes.csv');
$output->defaultTo('bdcakes.csv');
$csvFileOut = $output->prompt();

$climate->info('The keyboard arrows to navigate, spacebar to select an item.');
$options  = ['Yes', 'No'];
$input    = $climate->checkboxes('View result in terminal:', $options);
$return = $input->prompt();

$cakes = CakeCalculatorFactory::calculate($csvFilename, $csvFileOut, $return[0]);
if($return[0] == 'Yes'){
    $climate->table($cakes);
}
$climate->blue($csvFileOut . ' file created successfully!');

ini_set('auto_detect_line_endings',FALSE);
