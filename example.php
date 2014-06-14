<?php

require_once 'ThirtyOneEvSDK.php';

$sdk = new ThirtyOneEvSDK();

$sdk->authencicate('test', 'test');

$sdk->eventCreate(
    "Test Title",
    "Test Subj",
    "Test Content",
    "Test Location",
    "US-Mountain",
    "03/31/2014 12:00",
    "04/01/2014 12:00",
    5,
    0,
    "",
    "",
    "",
    "",
    ""
);