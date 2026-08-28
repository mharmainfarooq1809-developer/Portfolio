<?php

declare(strict_types=1);
ini_set('display_errors', '0');
header('Content-Type: application/json; charset=utf-8');
echo json_encode(['online' => true, 'provider' => 'local']);
