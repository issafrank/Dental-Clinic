<?php
/**
 * @var int $page
 * @var int $totalPages
 * @var string $baseUrl
 */
$page = $page ?? 1;
$totalPages = $totalPages ?? 1;
$baseUrl = $baseUrl ?? '?';
?>
<?php if ($totalPages > 1): ?>
<nav class="mt-4 flex items-center justify-center gap-1 text-sm">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="<?= e($baseUrl . 'page=' . $i) ?>"
           class="rounded-md px-3 py-1.5 <?= $i === $page ? 'bg-brand-600 text-white' : 'text-slate-600 hover:bg-slate-100' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>
</nav>
<?php endif; ?>
