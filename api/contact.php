<?php

header('Content-Type: application/json; charset=utf-8');
http_response_code(410);
echo json_encode([
    'success' => false,
    'message' => 'Email contact is disabled. Please use the public email link or WhatsApp contact option.'
]);