<div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>削除日時</th>
                <th>更新</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr style="<?= $user['deleted_at'] ? 'background: #ddd;' : '' ?>">
                    <td><?= $this->h($user['id'] ?? '') ?></td>
                    <td><?= $this->h($user['name'] ?? '') ?></td>
                    <td><?= $this->h($user['email'] ?? '') ?></td>
                    <td><?= $this->h($user['deleted_at'] ?? '') ?></td>
                    <td>
                        <a href="<?= $this->h($this->route('admin.user.edit', ['id' => $user['id']])) ?>">
                            更新
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>