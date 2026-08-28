<?php

declare(strict_types=1);

require_once __DIR__ . '/PortfolioAssistantProvider.php';

final class LocalKnowledgeProvider implements PortfolioAssistantProvider
{
    /** Public portfolio facts that are not represented by the existing tables. */
    private array $profile = [
        'about' => "Harmain is a software engineering student and full-stack web developer from Pakistan. He builds modern websites, custom web applications, business management systems, and practical digital solutions.",
        'skills' => "Harmain works with HTML, CSS, JavaScript, PHP, SQL, Laravel, MySQL, Bootstrap, jQuery, REST APIs, JSON, XML, Git, GitHub, and AI integration.",
        'experience' => "Harmain is pursuing Software Engineering studies while building practical experience through websites, web applications, business systems, dashboards, booking platforms, and digital products.",
        'contact' => "You can contact Harmain at mharmainfarooq@gmail.com. You can also use the Start a Project button to contact NovExa Tech through WhatsApp.",
        'resume' => "Harmain's resume is available to download as a PDF.",
        'availability' => "Harmain is open to freelance, internship, full-time, and remote opportunities, including full-stack projects, dashboard builds, and business management systems.",
    ];

    public function answer(string $message, array $context = []): array
    {
        $query = $this->normalize($message);
        $intent = $this->intent($query);
        $entity = $this->resolveEntity($query, $context);

        $curated = $this->curatedAnswer($query);
        if ($curated !== null) {
            return $this->response($curated['message'], $curated['intent'], [], $curated['entity'] ?? $entity);
        }

        $terms = $this->terms($query, $entity);
        $items = array_merge($this->staticItems(), $this->projects(), $this->services(), $this->faqs());
        $ranked = $this->rank($items, $terms, $intent, $entity);

        if (!$ranked) {
            return $this->response("I don't have that information in the portfolio knowledge base, so I can't answer it accurately. I can help with Harmain's work, skills, projects, services, availability, or contact details.", $intent, [], $entity);
        }

        $selected = array_slice($ranked, 0, $intent === 'projects' ? 3 : 2);
        $sentences = array_values(array_unique(array_map(static fn (array $item): string => $item['content'], $selected)));
        $messageText = implode(' ', $sentences);

        if ($intent === 'services' && str_contains($query, 'erp') && !str_contains(mb_strtolower($messageText), 'erp')) {
            $messageText = "Harmain can build business management platforms and dashboards. " . $messageText;
        }
        return $this->response($messageText, $intent, $selected, $entity ?: ($selected[0]['entity'] ?? ''));
    }

    private function staticItems(): array
    {
        $items = [];
        foreach ($this->profile as $category => $content) {
            $items[] = ['type' => 'portfolio', 'title' => ucfirst($category), 'content' => $content, 'category' => $category, 'keywords' => $category . ' harmain muhammad ' . $content, 'entity' => ''];
        }
        return $items;
    }

    private function curatedAnswer(string $query): ?array
    {
        if (preg_match('/income|salary|private (phone|number|information|client)|home address|address|confidential/i', $query)) {
            return ['message' => "I can only answer questions using Harmain's public portfolio information. I can't provide private, confidential, income, address, or private-client details.", 'intent' => 'general'];
        }
        if (preg_match('/are you chatgpt|what are you|browse the internet|internet access/i', $query)) {
            return ['message' => "I'm Harmain's AI Portfolio Assistant. My answers are grounded in Harmain's public portfolio knowledge base, and I don't browse the internet.", 'intent' => 'general'];
        }
        if (preg_match('/resume|cv|curriculum vitae|download/i', $query)) {
            return ['message' => "Yes. Harmain's resume is available as a downloadable PDF. Use the Download resume PDF link below.", 'intent' => 'resume'];
        }
        if (preg_match('/novexa|new idea powered|company founded|founder.*novexa|hire novexa/i', $query)) {
            return ['message' => "NovExa Tech is a technology-focused company founded by Harmain. It builds websites, web applications, business systems, e-commerce solutions, custom software, and digital solutions. Harmain is the Founder and CEO.", 'intent' => 'services'];
        }
        if (preg_match('/what is harmain studying|educational background|is harmain a student|software engineering student/i', $query)) {
            return ['message' => "Harmain is a software engineering student from Pakistan, pursuing a Diploma in Software Engineering at Aptech while building practical web-development experience.", 'intent' => 'experience'];
        }
        if (preg_match('/who is harmain|tell me about harmain|what does harmain do|type of developer|web developer|main areas of expertise|why should i choose|what makes harmain different/i', $query)) {
            return ['message' => $this->profile['about'] . ' He focuses on complete, responsive, business-oriented solutions across frontend and backend development.', 'intent' => 'about'];
        }
        if (preg_match('/programming languages|technical skills|frontend technologies|backend technologies|development tools|main technology stack|skills/i', $query)) {
            return ['message' => $this->profile['skills'], 'intent' => 'skills'];
        }
        if (preg_match('/hire harmain|start a project|project quotation|what information.*project|custom project|work with businesses|contact novexa|contact harmain|how can i contact|how can i hire/i', $query)) {
            return ['message' => "Yes. Harmain and NovExa Tech accept suitable website, web application, business-system, e-commerce, booking, and custom software projects. Share the project type, features, examples, target platform, timeline, and business requirements through the contact options or Start a Project button.", 'intent' => 'services'];
        }
        if (preg_match('/union enterprises|closest.*erp|most similar.*erp|has harmain built an erp|explain.*union|features.*union/i', $query)) {
            return ['message' => "Union Enterprises is an import, export, clearing, and logistics management platform covering shipments, invoices, documents, clients, notifications, payment verification, customs and tax workflows, and client portal access. It is the portfolio's closest ERP-style example.", 'intent' => 'projects', 'entity' => 'union enterprises'];
        }
        if (preg_match('/movie booking|online booking system|booking system/i', $query)) {
            return ['message' => "The Online Movie Booking System is a PHP and MySQL application for movie discovery, showtimes, interactive seat selection, seat availability, ticket bookings, booking history, and administrative management.", 'intent' => 'projects', 'entity' => 'online movie booking system'];
        }
        if (preg_match('/aniwear|digital wardrobe|ai stylist|outfit recommendation/i', $query)) {
            return ['message' => "Aniwear is a live digital wardrobe and AI stylist application. It supports clothing categorization, wardrobe management, outfit creation, saved outfits, and recommendations based on colors, styles, occasions, seasons, and preferences.", 'intent' => 'projects', 'entity' => 'aniwear — digital wardrobe + ai stylist'];
        }
        if (preg_match('/jewelry/i', $query)) {
            return ['message' => "The Jewelry Website is a product-focused PHP website built around clear product presentation, organized browsing, and straightforward navigation. It is currently in production.", 'intent' => 'projects', 'entity' => 'jewelry website'];
        }
        if (preg_match('/what services|services.*offer|build business websites|build ecommerce|build custom web|php development|laravel development|frontend development|backend development|responsive website|fix website/i', $query)) {
            return ['message' => "Harmain offers web development, custom web applications, business systems, dashboards, e-commerce, booking systems, PHP and Laravel development, frontend and backend development, API integration, and custom digital solutions.", 'intent' => 'services'];
        }
        return null;
    }

    private function projects(): array
    {
        $items = [];
        foreach (getProjects() as $project) {
            $details = is_array($project['content'] ?? null) ? $project['content'] : [];
            $title = (string) $project['title'];
            $content = trim($title . ': ' . ($project['description'] ?: $project['tagline'] ?: 'Project details are available in the portfolio.'));
            if (!empty($project['tech_stack'])) {
                $content .= ' Technologies: ' . $project['tech_stack'] . '.';
            }
            if (!empty($details['results'])) {
                $content .= ' ' . $details['results'];
            }
            $items[] = ['type' => 'project', 'title' => $title, 'content' => $content, 'category' => 'projects', 'keywords' => $title . ' ' . ($project['tagline'] ?? '') . ' ' . ($project['description'] ?? '') . ' ' . ($project['tech_stack'] ?? '') . ' ' . implode(' ', array_filter($details, 'is_string')), 'entity' => mb_strtolower($title)];
        }
        return $items;
    }

    private function services(): array
    {
        return array_map(static fn (array $service): array => ['type' => 'service', 'title' => (string) $service['title'], 'content' => $service['title'] . ': ' . $service['description'], 'category' => 'services', 'keywords' => $service['title'] . ' ' . $service['description'], 'entity' => ''], getServices());
    }

    private function faqs(): array
    {
        return array_map(static fn (array $faq): array => ['type' => 'faq', 'title' => (string) $faq['question'], 'content' => (string) $faq['answer'], 'category' => 'faq', 'keywords' => $faq['question'] . ' ' . $faq['answer'], 'entity' => ''], getFaqs());
    }

    private function rank(array $items, array $terms, string $intent, string $entity): array
    {
        $ranked = [];
        foreach ($items as $item) {
            $haystack = mb_strtolower($item['keywords']);
            $score = 0;
            foreach ($terms as $term) {
                if ($term !== '' && str_contains($haystack, $term)) {
                    $score += str_contains(mb_strtolower($item['title']), $term) ? 4 : 1;
                }
            }
            if ($item['category'] === $intent) {
                $score += 5;
            }
            if ($entity !== '' && $item['entity'] === $entity) {
                $score += 12;
            }
            if ($score > 0) {
                $item['score'] = $score;
                $ranked[] = $item;
            }
        }
        usort($ranked, static fn (array $a, array $b): int => $b['score'] <=> $a['score']);
        return $ranked;
    }

    private function intent(string $query): string
    {
        $map = ['availability' => ['available','availability','open to','hire'], 'contact' => ['contact','email','reach','get in touch'], 'resume' => ['resume','cv','curriculum vitae','download'], 'skills' => ['skills','skill','technology','technologies','tech','stack'], 'services' => ['services','service','offer','build','erp','dashboard','portal'], 'experience' => ['experience','journey','progress'], 'projects' => ['project','projects','union enterprises','movie booking','aniwear','technologies did it use']];
        foreach ($map as $intent => $phrases) {
            foreach ($phrases as $phrase) {
                if (str_contains($query, $phrase)) {
                    return $intent;
                }
            }
        }
        return str_contains($query, 'harmain') || str_contains($query, 'about') ? 'about' : 'general';
    }

    private function resolveEntity(string $query, array $context): string
    {
        foreach ($this->projects() as $project) {
            if (str_contains($query, $project['entity'])) {
                return $project['entity'];
            }
        }
        if (preg_match('/\b(it|that project|its)\b/u', $query)) {
            for ($i = count($context) - 1; $i >= 0; $i--) {
                if (!empty($context[$i]['entity'])) {
                    return (string) $context[$i]['entity'];
                }
            }
        }
        return '';
    }

    private function terms(string $query, string $entity): array
    {
        $terms = preg_split('/\s+/u', $query) ?: [];
        $terms = array_filter($terms, static fn (string $term): bool => mb_strlen($term) > 1 && !in_array($term, ['what','does','tell','about','harmain','with','were','that','this','the','and','are','can','you','his','its'], true));
        if ($entity !== '') {
            $terms[] = $entity;
        }
        if (in_array('erp', $terms, true)) {
            $terms = array_merge($terms, ['business', 'management', 'system']);
        }
        return array_values(array_unique($terms));
    }

    private function normalize(string $text): string
    {
        $text = mb_strtolower(trim($text));
        $text = preg_replace('/[^\p{L}\p{N}\s-]/u', ' ', $text) ?? '';
        return trim(preg_replace('/\s+/u', ' ', $text) ?? '');
    }
    private function response(string $message, string $intent, array $items, string $entity): array
    {
        return ['message' => $message, 'intent' => $intent, 'sources' => array_map(static fn (array $item): array => ['type' => $item['type'], 'title' => $item['title']], $items), 'entity' => $entity];
    }
}
