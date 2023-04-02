<?php

require_once __DIR__ . '/../src/Bitmask.php';
require_once __DIR__ . '/../src/Utils.php';
require_once __DIR__ . '/UserTypeBitmask.php';

$currentBitmask = UserTypeBitmask::ADMIN | UserTypeBitmask::VERIFIED; // 3

$userType = new UserTypeBitmask($currentBitmask, 3);

var_dump($userType->isEnabled(UserTypeBitmask::ADMIN)); // true
var_dump($userType->isEnabled(UserTypeBitmask::VERIFIED)); // true
var_dump($userType->isEnabled(UserTypeBitmask::BANNED)); // false

$userType->disable(UserTypeBitmask::VERIFIED);
var_dump($userType->isEnabled(UserTypeBitmask::VERIFIED)); // false

$newBitmask = $userType->getBitmask();
var_dump($newBitmask); // 1

$userType->enable(UserTypeBitmask::BANNED);
var_dump($userType->getBitmask()); // 5
