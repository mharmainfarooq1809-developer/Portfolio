<?php

require_once __DIR__ . '/portfolio_data.php';

function getProjects($activeOnly = true)
{
    $projects = portfolioData()['projects'];
    return array_values(array_filter($projects, static fn (array $project): bool => !$activeOnly || !empty($project['is_active'])));
}

function getServices($activeOnly = true)
{
    $services = portfolioData()['services'];
    return array_values(array_filter($services, static fn (array $service): bool => !$activeOnly || !empty($service['is_active'])));
}

function getFaqs($activeOnly = true)
{
    $faqs = portfolioData()['faqs'];
    return array_values(array_filter($faqs, static fn (array $faq): bool => !$activeOnly || !empty($faq['is_active'])));
}

function saveMessage($name, $email, $subject, $message)
{
    return $name !== '' && $email !== '' && $message !== '';
}

function getSetting($key)
{
    $settings = portfolioData()['settings'];
    return $settings[$key] ?? null;
}
