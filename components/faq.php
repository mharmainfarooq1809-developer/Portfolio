<?php
require_once __DIR__ . '/../includes/functions.php';
$faqs = getFaqs();
?>
<section class="section" id="faq">
    <div class="container">
        <div class="section-head">
            <div class="eyebrow">FAQ</div>
            <h2>Common questions.</h2>
        </div>
        <div class="faq-list">
            <?php foreach ($faqs as $faq): ?>
            <article class="faq-item">
                <?php $faqId = 'faq-' . (int) ($faq['id'] ?? 0); ?>
                <button class="faq-q" type="button" aria-expanded="false" aria-controls="<?= htmlspecialchars($faqId, ENT_QUOTES, 'UTF-8') ?>">
                    <?= htmlspecialchars($faq['question']) ?>
                    <span class="plus">+</span>
                </button>
                <div class="faq-a" id="<?= htmlspecialchars($faqId, ENT_QUOTES, 'UTF-8') ?>" hidden>
                    <p><?= htmlspecialchars($faq['answer']) ?></p>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<style>
/* PASTE YOUR ORIGINAL FAQ CSS HERE */
</style>
<script>
/* PASTE YOUR ORIGINAL FAQ ACCORDION JAVASCRIPT HERE */
</script>