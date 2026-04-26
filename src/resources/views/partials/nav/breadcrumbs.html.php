<?php if ($breadcrumbs): ?>
    <?php
    $arr = $this->app('breadcrumbs')->get(...$breadcrumbs);
    ?>

    <div class="p-4">
        <?php foreach ($arr as $idx => $row): ?>
            <?php if ($idx != 0): ?>
                <span class="px-2"> > </span>
            <?php endif; ?>
            <?php if ($idx === count($arr) - 1): ?>
                <?= $this->h($row['name']) ?>
            <?php else: ?>
                <a href="<?= $this->h($row['url']) ?>" class="app-link-normal">
                    <?= $this->h($row['name']) ?>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>