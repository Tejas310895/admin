<?php
require "PhpOffice/vendor/autoload.php";
include "functions.php";

if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $assets_url = '../uploads/';
} else {
    $assets_url = '../images/uploads/';
}

if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];
    $project_data = get_project_complete($project_id);
    $project_data = array_shift($project_data);
    // (A) LOAD PHPWORD
    $PHPWord = new \PhpOffice\PhpWord\PhpWord();
    // New portrait section
    $section = $PHPWord->addSection(array('borderColor' => '00FF00', 'borderSize' => 12));
    $section->addText('I am placed on a default section.');

    // New landscape section
    // $section = $PHPWord->addSection(array('orientation' => 'landscape'));
    // $section->addText('I am placed on a landscape section. Every page starting from this section will be landscape style.');
    // $section->addPageBreak();
    // $section->addPageBreak();

    // New portrait section
    // $section = $PHPWord->addSection(array('marginLeft' => 600, 'marginRight' => 600, 'marginTop' => 600, 'marginBottom' => 600));
    // $section->addText('This section uses other margins.');



    // Save File
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($PHPWord, 'Word2007');
    $objWriter->save($assets_url . 'helloWorld.doc');
}
