<?php

declare(strict_types=1);

interface PortfolioAssistantProvider
{
    /**
     * @param array<int, array{role: string, content: string, entity?: string}> $context
     * @return array{message: string, intent: string, sources: array<int, array{type: string, title: string}>, entity: string}
     */
    public function answer(string $message, array $context = []): array;
}
