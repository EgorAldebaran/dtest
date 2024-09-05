<?php

require 'vendor/autoload.php';

use League\Csv\Reader;
use League\Csv\Writer;
use League\Csv\Statement;

$reader = Reader::createFromPath('source300withHeaders.csv', 'r');
$reader->setDelimiter('|');
$reader->setHeaderOffset(0); //set the CSV header offset


$records = $reader->getRecords();
$source = [];
$matrix = [];
$size = 100;

foreach ($records as $offset => $record) {
    $source[] .= (int)$record['value'];
}

//var_dump ($source);die();

// Создание матрицы

// Проверка, что массив содержит достаточно элементов
if (count($source) < $size * $size) {
    throw new Exception("Недостаточно данных для создания матрицы размером $size x $size");
}


for ($i = 0; $i < $size; $i++) {
    $row = [];
    for ($y = 0; $y < $size; $y++) {
        $index = $i * $size + $y;
        $row[] = $source[$index];
    }
    $matrix[] = $row;
}

// Создание объекта Writer
$csv = Writer::createFromPath('matrix.csv', 'w+');

// Запись данных в CSV
foreach ($matrix as $row) {
    $csv->insertOne($row);
}

echo "Матрица успешно сохранена в файл matrix.csv.\n";
