<?php if ($breadcrumbs): ?>
    <?php
    $arr = $this->app('breadcrumbs')->get(...$breadcrumbs);
    ?>

    <div style="padding: 1rem;">
        <?php foreach ($arr as $idx => $row): ?>
            <?php if ($idx != 0): ?>
                <span style="padding: 0 0.5rem;"> > </span>
            <?php endif; ?>
            <?php if ($idx === count($arr) - 1): ?>
                {{ $row['name'] }}
            <?php else: ?>
                <a href="{{ $row['url'] }}" class="app-link-normal">
                    {{ $row['name'] }}
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>