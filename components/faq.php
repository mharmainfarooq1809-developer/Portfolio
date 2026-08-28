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
            <div class="faq-item">
                <button class="faq-q">
                    <?= htmlspecialchars($faq['question']) ?>
                    <span class="plus">+</span>
                </button>
                <div class="faq-a">
                    <p><?= htmlspecialchars($faq['answer']) ?></p>
                </div>
            </div>
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