<?php if (!empty($errors)): ?>
    <div style="
        background-color: #fdecea;
        color: #c0392b;
        padding: 1rem 1.5rem;
        margin: 1rem 0;
        margin-bottom: 1rem;
    ">
        <strong>
            ⚠ エラー発生
        </strong>
        <ul style="margin-top:0.5rem; padding-left: 1.2rem; font-size: 0.8rem;">
            <?php foreach ($errors as $arr): ?>
                <?php foreach ($arr as $val): ?>
                    <li><?= $this->h($val) ?></li>
                    <?php break; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>