<?php if ($data['errors']) { ?>
    <div style="border: 0.5rem red solid; padding: 2rem;">
        エラー発生

        <?php foreach ($data['errors'] as $arr) { ?>
            <?php foreach ($arr as $val) { ?>
                <div><?= $val ?></div>
            <?php } ?>
        <?php } ?>
    </div>
<?php } ?>