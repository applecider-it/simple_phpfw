<?php if (!empty($errors)): ?>
    <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 my-4 rounded-lg">
        <strong class="block font-semibold mb-2">
            ⚠ エラー発生
        </strong>

        <ul class="list-disc pl-5 text-sm space-y-1">
            <?php foreach ($errors as $arr): ?>
                <?php foreach ($arr as $val): ?>
                    <li><?= $this->h($val) ?></li>
                    <?php break; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>