<?php

/** @var SFW\Pagination\Paginator */
$paginator = $data['paginator'];

?>
<div style="margin: 1rem 0;">
    <span>
        <span><?= $paginator->totalCount ?> 件</span>
        <?php if ($paginator->totalPages > 1): ?>
            <span style="margin-left: 0.5rem;">ページ( <?= $paginator->currentPage ?> / <?= $paginator->totalPages ?> )</span>
        <?php endif; ?>
    </span>

    <?php if ($paginator->totalPages > 1): ?>
        <span style="margin-left: 2rem;">
            <span>
                <?php if ($paginator->currentPage > 1): ?>
                    <a href="<?= $paginator->pageUrl($paginator->currentPage - 1) ?>" class="app-link-normal">前のページへ</a>
                <?php else: ?>
                    前のページへ
                <?php endif; ?>
            </span>

            <span style="margin-left: 1rem;">
                <?php if ($paginator->currentPage < $paginator->totalPages): ?>
                    <a href="<?= $paginator->pageUrl($paginator->currentPage + 1) ?>" class="app-link-normal">次のページへ</a>
                <?php else: ?>
                    次のページへ
                <?php endif; ?>
            </span>
        </span>
    <?php endif; ?>
</div>