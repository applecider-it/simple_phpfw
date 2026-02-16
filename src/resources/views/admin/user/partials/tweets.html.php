<?php

use function SFW\Helpers\html_esc as h;
?>
<h3 class="app-h3">tweets</h3>

<div>
    <div class="app-table-wrap">
        <table style="margin-top: 1rem;" class="app-table">
            <thead>
                <tr class="app-table-row-header">
                    <th class="app-table-cell" style="text-align: left;">Content</th>
                    <th class="app-table-cell" style="text-align: left;">作成日時</th>
                    <th class="app-table-cell" style="text-align: left;">削除日時</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['tweets'] as $tweet): ?>
                    <tr class="app-table-row-data">
                        <td class="app-table-cell"><?= h($tweet['content']) ?></td>
                        <td class="app-table-cell"><?= $tweet['created_at'] ?? '' ?></td>
                        <td class="app-table-cell"><?= $tweet['deleted_at'] ?? '' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>