<h3 class="app-h3">tweets</h3>

<div class="app-table-container">
    <table class="app-table">
        <thead class="app-table-thead">
            <tr>
                <th class="app-table-th">ID</th>
                <th class="app-table-th">Content</th>
                <th class="app-table-th">作成日時</th>
                <th class="app-table-th">削除日時</th>
            </tr>
        </thead>
        <tbody class="app-table-tbody">
            <?php foreach ($tweets as $tweet): ?>
                <tr style="<?= $tweet['deleted_at'] ? 'background: #ddd;' : '' ?>">
                    <td class="app-table-td"><?= $this->h($tweet['id']) ?></td>
                    <td class="app-table-td"><?= $this->h($tweet['content']) ?></td>
                    <td class="app-table-td"><?= $this->h($tweet['created_at'] ?? '') ?></td>
                    <td class="app-table-td"><?= $this->h($tweet['deleted_at'] ?? '') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>