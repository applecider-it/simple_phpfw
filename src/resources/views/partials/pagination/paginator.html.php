<?php

/** @var SFW\Pagination\Paginator */
$paginator = $data['paginator'];

$totalCount = $paginator->totalCount();
$currentPage = $paginator->currentPage();
$totalPages = $paginator->totalPages();

?>
<div style="margin: 1rem 0;">
    <span>
        <span><?= $totalCount ?> 件</span>
        <?php if ($totalPages > 1): ?>
            <span style="margin-left: 0.5rem;">ページ( <?= $currentPage ?> / <?= $totalPages ?> )</span>
        <?php endif; ?>
    </span>

    <?php if ($totalPages > 1): ?>
        <span style="margin-left: 2rem;">
            <span>
                <?php if ($currentPage > 1): ?>
                    <a href="<?= $paginator->pageUrl($currentPage - 1) ?>" class="app-link-normal">前のページへ</a>
                <?php else: ?>
                    前のページへ
                <?php endif; ?>
            </span>

            <span style="margin-left: 1rem;">
                <?php if ($currentPage < $totalPages): ?>
                    <a href="<?= $paginator->pageUrl($currentPage + 1) ?>" class="app-link-normal">次のページへ</a>
                <?php else: ?>
                    次のページへ
                <?php endif; ?>
            </span>
        </span>
    <?php endif; ?>
</div>