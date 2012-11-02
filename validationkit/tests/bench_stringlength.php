<?php

$useExt = isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] == 'ext' : false;
if($useExt) {
    dl("validationkit.so");
}else {
    require('Validator.php');
    require('ValidationMessage.php');
    require('StringLengthValidator.php');
    require('StringValidator.php');
}

    $start = microtime(true);
    $stringValidator = new \ValidationKit\StringLengthValidator(array("max"=>20, "min"=>5));

    $validCount = 0;
    $invalidCount =0;

    for ($i=0; $i < 5000; $i++) {
        $str = str_repeat("hello", rand(1,6));
        $r = $stringValidator->validate($str);
        if ($r) $validCount++;
        else $invalidCount++;
    }
    $end = microtime(true);

    printf("StringLength    valid = %04d, invalid = %04d, ms = %s \n", $validCount, $invalidCount, ($end-$start));

    $start = microtime(true);
    $stringValidator = new \ValidationKit\StringValidator(array("ends_with"=>"LIN", "ignore_case"=>true));

    $validCount = 0;
    $invalidCount =0;

    for ($i=0; $i < 5000; $i++) {
        $str = str_repeat("hello", rand(1,6)). " lin" ;
        $r = $stringValidator->validate($str);
        if ($r) $validCount++;
        else $invalidCount++;
    }
    $end = microtime(true);

    printf("String          valid = %04d, invalid = %04d, ms = %s \n", $validCount, $invalidCount, ($end-$start));

