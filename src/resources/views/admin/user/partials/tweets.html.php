<h3>tweets</h3>

<div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Content</th>
                <th>作成日時</th>
                <th>削除日時</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tweets as $tweet): ?>
                <tr style="<?= $tweet['deleted_at'] ? 'background: #ddd;' : '' ?>">
                    <td><?= $this->h($tweet['id']) ?></td>
                    <td><?= $this->h($tweet['content']) ?></td>
                    <td><?= $this->h($tweet['created_at'] ?? '') ?></td>
                    <td><?= $this->h($tweet['deleted_at'] ?? '') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>