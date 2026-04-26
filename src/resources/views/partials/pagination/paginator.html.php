<?php
$totalCount = $paginator->totalCount();
$currentPage = $paginator->currentPage();
$totalPages = $paginator->totalPages();

?>
<div class="my-5">
    <span>
        <span><?= $this->h($totalCount) ?> 件</span>
        <?php if ($totalPages > 1): ?>
            <span class="ml-3">ページ( <?= $this->h($currentPage) ?> / <?= $this->h($totalPages) ?> )</span>
        <?php endif; ?>
    </span>

    <?php if ($totalPages > 1): ?>
        <span class="ml-5">
            <span>
                <?php if ($currentPage > 1): ?>
                    <a href="<?= $this->h($paginator->pageUrl($currentPage - 1)) ?>" class="app-link-normal">前のページへ</a>
                <?php else: ?>
                    前のページへ
                <?php endif; ?>
            </span>

            <span class="ml-5">
                <?php if ($currentPage < $totalPages): ?>
                    <a href="<?= $this->h($paginator->pageUrl($currentPage + 1)) ?>" class="app-link-normal">次のページへ</a>
                <?php else: ?>
                    次のページへ
                <?php endif; ?>
            </span>
        </span>
    <?php endif; ?>
</div>