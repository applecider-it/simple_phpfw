<?php if (!empty($data['errors'])): ?>
    <div style="
        border-left: 6px solid #e74c3c;
        background-color: #fdecea;
        color: #c0392b;
        padding: 1rem 1.5rem;
        margin: 1rem 0;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        margin-bottom: 1rem;
        font-family: sans-serif;
    ">
        <strong style="display:flex; align-items:center; gap:0.5rem;">
            ⚠ エラー発生
        </strong>
        <ul style="margin-top:0.5rem; padding-left: 1.2rem;">
            <?php foreach ($data['errors'] as $arr): ?>
                <?php foreach ($arr as $val): ?>
                    <li><?= htmlspecialchars($val, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
