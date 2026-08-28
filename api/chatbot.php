<?php

header('Content-Type: application/json');
require_once __DIR__ . '/../includes/functions.php';

$query = trim($_POST['query'] ?? '');
if (empty($query)) {
    echo json_encode(['reply' => 'Please ask something.']);
    exit;
}

function getLocalReply($query)
{
    $q = strtolower(trim($query));
    $kb = [
        'bio' => 'Muhammad Harmain is a full stack developer focused on PHP and Laravel, building business management systems, dashboards and portals designed for daily, repeated use rather than one-time demos. Based in Pakistan.',
        'projects' => ['Union Enterprises', 'Online Movie Booking System', 'Jewelry Website', 'Aniwear — Digital Wardrobe + AI Stylist'],
        'skills' => ['PHP', 'Laravel', 'MySQL', 'JavaScript', 'Bootstrap', 'REST APIs', 'AI Integration'],
        'services' => ['Business Management Systems', 'Dashboard Development', 'Client Portals', 'API Development', 'Database Architecture', 'AI-Assisted Features'],
        'contact' => 'Email: mharmainfarooq@gmail.com. Response time: Within 24 hours.'
    ];

    if (preg_match('/tell me about|who is harmain|bio/i', $q)) {
        return $kb['bio'];
    }
    if (preg_match('/laravel project/i', $q)) {
        return 'Laravel-built systems: ' . implode(', ', $kb['projects']) . '.';
    }
    if (preg_match('/union enterprises/i', $q)) {
        return 'Union Enterprises: a two-sided logistics platform replacing spreadsheet tracking.';
    }
    if (preg_match('/movie|booking|cinema/i', $q)) {
        return 'Online Movie Booking System: a full-stack PHP and MySQL platform for movie discovery, showtimes, seat selection, and ticket booking.';
    }
    if (preg_match('/jewelry/i', $q)) {
        return 'Jewelry Website: a product-focused business site currently in production.';
    }
    if (preg_match('/resume|cv|curriculum vitae|download/i', $q)) {
        return 'Resume available: download Harmain_Resume.pdf from the portfolio.';
    }
    if (preg_match('/aniwear|wardrobe|stylist|outfit/i', $q)) {
        return 'Aniwear: a live digital wardrobe and AI stylist application for organizing clothing and generating personalized outfit recommendations.';
    }
    if (preg_match('/skill|stack|technolog/i', $q)) {
        return 'Core stack: ' . implode(', ', $kb['skills']) . '.';
    }
    if (preg_match('/erp/i', $q)) {
        return 'Yes – Union Enterprises is effectively an ERP for logistics, and the same approach extends to other domains.';
    }
    if (preg_match('/contact|hire|email|reach/i', $q)) {
        return $kb['contact'];
    }
    if (preg_match('/service/i', $q)) {
        return 'Services offered: ' . implode(', ', $kb['services']) . '.';
    }

    // Check FAQ from database
    $faqs = getFaqs();
    foreach ($faqs as $faq) {
        if (strpos($q, strtolower(substr($faq['question'], 0, 30))) !== false) {
            return $faq['answer'];
        }
    }
    return "I can speak to Harmain's skills, projects, and how to get in touch – try one of the suggested questions above.";
}

$reply = getLocalReply($query);
echo json_encode(['reply' => $reply]);
