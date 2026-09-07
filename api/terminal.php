<?php

header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../includes/functions.php';
$commands = getCommands();
$result = [];
foreach ($commands as $command) $result[$command['command']] = $command['output'];
echo json_encode(['commands' => $result]);
