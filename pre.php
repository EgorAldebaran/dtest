<?php

require 'vendor/autoload.php'; // Подключаем автозагрузчик Composer

use League\Csv\Reader;
use League\Csv\Writer;

// Имя исходного и нового файла
$inputFile = 'source300.csv';
$outputFile = 'source300withHeaders.csv';

// Создаем объект Reader для чтения исходного файла
$reader = Reader::createFromPath($inputFile, 'r');
$reader->setDelimiter('|'); // Устанавливаем разделитель

// Создаем объект Writer для записи в новый файл
$writer = Writer::createFromPath($outputFile, 'w+');
$writer->setDelimiter('|'); // Устанавливаем разделитель

// Записываем заголовки
$writer->insertOne(['id', 'value']);

// Копируем данные из исходного файла в новый файл
foreach ($reader->getRecords() as $record) {
    $writer->insertOne($record);
}

echo "Файл с заголовками создан как '$outputFile'.\n";
