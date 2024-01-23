<?php

namespace Archive7z\Tests;
include_once('../src/Archive7z.php');
use Archive7z\Archive7z;

class MyArchive7z extends Archive7z
{
    protected $timeout = 120;
    protected $compressionLevel = 6;
    protected $overwriteMode = self::OVERWRITE_MODE_S;
    protected $outputDirectory = '/path/to/custom/output/directory';
}

$obj = new MyArchive7z('path_to_7z_file.7z');

if (!$obj->isValid()) {
    throw new \RuntimeException('Incorrect archive');
}

// $obj->setPassword('123');

foreach ($obj->getEntries() as $entry) {
        print_r($entry);
/*
Archive7z\Entry Object
(
    [path:Archive7z\Entry:private] => 1.jpg
    [size:Archive7z\Entry:private] => 91216
    [packedSize:Archive7z\Entry:private] => 165344
    [modified:Archive7z\Entry:private] => 2013-06-10 09:56:07
    [created:Archive7z\Entry:private] => 
    [attributes:Archive7z\Entry:private] => A
    [crc:Archive7z\Entry:private] => 871345C2
    [encrypted:Archive7z\Entry:private] => +
    [method:Archive7z\Entry:private] => LZMA:192k 7zAES:19
    [block:Archive7z\Entry:private] => 0
    [comment:Archive7z\Entry:private] => 
    [hostOs:Archive7z\Entry:private] => 
    [characteristics:Archive7z\Entry:private] => 
    [folder:Archive7z\Entry:private] => 
    [archive:Archive7z\Entry:private] => MyArchive7z Object
        (
            [timeout:protected] => 60
            [compressionLevel:protected] => 6
            [overwriteMode:protected] => -aos
            [outputDirectory:protected] => /path/to/custom/output/directory
            [binary7z:Archive7z\Archive7z:private] => C:\Program Files\7-Zip\7z.exe
            [filename:Archive7z\Archive7z:private] => s:\VCS\Git\Archive7z\tests/fixtures/testPasswd.7z
            [password:Archive7z\Archive7z:private] => 123
            [encryptFilenames:protected] => 
        )
)
*/

    if ($entry->getPath() === 'test/test.txt') {
        $entry->extractTo('path_to_extract_folder/'); // extract the file
    }
}

echo $obj->getContent('test/test.txt'); // show content of the file
$obj->setOutputDirectory('path_to_extract_folder/')->extract(); // extract the archive
$obj->setOutputDirectory('path_to_extract_pass_folder/')->setPassword('pass')->extractEntry('test/test.txt'); // extract the password-protected entry

$obj->addEntry(__FILE__); // add file to the archive
$obj->addEntry(__DIR__);  // add directory to the archive (include subfolders)

$obj->renameEntry(__FILE__, __FILE__.'new'); // rename the file in the archive
$obj->delEntry(__FILE__.'new'); // remove the file from the archive