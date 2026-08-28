<?php

/**
 * Portfolio content stored locally so the site runs without MySQL.
 * Edit these arrays to update the public site.
 */
function portfolioData(): array
{
    return [
        'settings' => [
            'site_title' => 'Muhammad Harmain — Full Stack Developer',
            'site_description' => 'Full stack developer building business management systems, dashboards, portals, and practical web applications with PHP, Laravel, MySQL, and JavaScript.',
            'contact_email' => 'mharmainfarooq1809@gmail.com',
        ],

        /*
        |--------------------------------------------------------------------------
        | Services
        |--------------------------------------------------------------------------
        */
        'services' => [
            [
                'id' => 1,
                'title' => 'Business Management Systems',
                'description' => 'Practical systems that bring daily operations, records, and workflows into one clear workspace.',
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'id' => 2,
                'title' => 'Dashboard Development',
                'description' => 'Focused dashboards that turn operational data into useful reporting and decisions.',
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'id' => 3,
                'title' => 'Client Portals',
                'description' => 'Secure client-facing portals that make information and collaboration easier to manage.',
                'sort_order' => 3,
                'is_active' => true
            ],
            [
                'id' => 4,
                'title' => 'API Development',
                'description' => 'Reliable REST APIs for connecting products, services, and internal workflows.',
                'sort_order' => 4,
                'is_active' => true
            ],
            [
                'id' => 5,
                'title' => 'Database Architecture',
                'description' => 'Well-structured data models designed for performance, clarity, and sustainable growth.',
                'sort_order' => 5,
                'is_active' => true
            ],
            [
                'id' => 6,
                'title' => 'AI-Assisted Features',
                'description' => 'Useful AI-assisted workflows that support teams without getting in the way of core work.',
                'sort_order' => 6,
                'is_active' => true
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Projects
        |--------------------------------------------------------------------------
        */
        'projects' => [

            /*
            |------------------------------------------------------------------
            | Union Enterprises
            |------------------------------------------------------------------
            */
            [
                'id' => 1,
                'title' => 'Union Enterprises',
                'status' => 'In production',
                'description' => 'A logistics-focused business platform built to replace disconnected spreadsheet tracking with a clearer operational workflow.',
                'short_description' => 'A logistics platform for more organized daily operations.',
                'image' => '',
                // Example: 'assets/images/union-enterprises.jpg'

                'tags' => [
                    'Laravel',
                    'PHP',
                    'REST APIs'
                ],

                'tech_stack' => 'Laravel, PHP, REST APIs',
                'sort_order' => 1,
                'is_active' => true,

                'content' => [
                    'overview' => 'A two-sided logistics platform designed to centralize shipment tracking, business operations, documents, invoices, and day-to-day workflows in one structured system.'
                ]
            ],

            /*
            |------------------------------------------------------------------
            | Online Movie Booking System
            |------------------------------------------------------------------
            */
            [
                'id' => 2,
                'title' => 'Online Movie Booking System',
                'status' => 'Completed',

                'description' => 'A complete online movie booking platform that allows users to explore movies, select showtimes, choose seats, and book tickets through a streamlined digital experience.',

                'short_description' => 'Online movie discovery, seat selection, and ticket booking system.',

                'image' => 'mbs2.PNG',

                'tags' => [
                    'PHP',
                    'MySQL',
                    'JavaScript',
                    'Booking System'
                ],

                'tech_stack' => 'PHP, MySQL, JavaScript, HTML, CSS',
                'sort_order' => 2,
                'is_active' => true,

                'content' => [
                    'overview' => 'A complete movie ticket booking platform designed to simplify the cinema booking experience. Users can browse available movies, view movie details and showtimes, select their preferred seats, and manage ticket bookings through one centralized system.'
                ]
            ],

            /*
            |------------------------------------------------------------------
            | Jewelry Website
            |------------------------------------------------------------------
            */
            [
                'id' => 3,
                'title' => 'Jewelry Website',
                'status' => 'In production',

                'description' => 'A polished product-focused website built to present a jewelry business online with clear product browsing and a responsive user experience.',

                'short_description' => 'A product-led digital presence for a jewelry business.',

                'image' => '',

                'tags' => [
                    'PHP',
                    'JavaScript',
                    'Responsive'
                ],

                'tech_stack' => 'PHP, JavaScript, CSS',
                'sort_order' => 3,
                'is_active' => true,

                'content' => [
                    'overview' => 'A responsive business website focused on clear product presentation, organized browsing, and an approachable digital experience for customers.'
                ]
            ],

            /*
            |------------------------------------------------------------------
            | Aniwear — Digital Wardrobe + AI Stylist
            |------------------------------------------------------------------
            */
            [
                'id' => 4,
                'title' => 'Aniwear — Digital Wardrobe + AI Stylist',
                'status' => 'Live',

                'description' => 'A fashion-tech web application combining digital wardrobe management with an AI-powered personal styling assistant.',

                'short_description' => 'Digital wardrobe management with personalized AI styling recommendations.',

                'image' => '',

                'tags' => [
                    'HTML5',
                    'Bootstrap',
                    'Laravel',
                    'AI Integration'
                ],

                'tech_stack' => 'HTML5, CSS3, JavaScript, Bootstrap, jQuery, PHP, Laravel, MySQL, AI API integration',
                'sort_order' => 4,
                'is_active' => true,

                'content' => [
                    'overview' => 'Aniwear lets users organize clothing items, create and save outfits, and receive personalized styling recommendations based on wardrobe contents, colors, styles, occasions, seasons, and preferences.',
                    'problem' => 'People needed a more useful way to organize their wardrobe and decide what to wear from the clothing they already own.',
                    'approach' => 'Built a Laravel and MySQL application with authenticated user dashboards, structured wardrobe data, outfit management, and an AI stylist supported by a structured knowledge base.',
                    'features' => 'Digital wardrobe management, clothing categorization, outfit creation, saved outfits, personalized AI styling, occasion-based suggestions, color and style recommendations, and database-driven wardrobe management.'
                ]
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Frequently Asked Questions
        |--------------------------------------------------------------------------
        */
        'faqs' => [
            [
                'id' => 1,
                'question' => 'What kinds of projects do you build?',
                'answer' => 'I build business management systems, dashboards, client portals, booking systems, APIs, and practical web applications.',
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'id' => 2,
                'question' => 'What is your main technology stack?',
                'answer' => 'My core stack includes PHP, Laravel, MySQL, JavaScript, HTML, CSS, REST APIs, and dashboard development.',
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'id' => 3,
                'question' => 'How can I get in touch?',
                'answer' => 'Email mharmainfarooq1809@gmail.com and I will get back to you as soon as possible.',
                'sort_order' => 3,
                'is_active' => true
            ],
        ],
    ];
}