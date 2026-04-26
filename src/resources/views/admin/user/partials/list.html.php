<div class="app-table-container">
    <table class="app-table">
        <thead class="app-table-thead">
            <tr>
                <th class="app-table-th">ID</th>
                <th class="app-table-th">Name</th>
                <th class="app-table-th">Email</th>
                <th class="app-table-th">削除日時</th>
                <th class="app-table-th">更新</th>
            </tr>
        </thead>
        <tbody class="app-table-tbody">
            <?php foreach ($users as $user): ?>
                <tr style="<?= $user['deleted_at'] ? 'background: #ddd;' : '' ?>">
                    <td class="app-table-td"><?= $this->h($user['id'] ?? '') ?></td>
                    <td class="app-table-td"><?= $this->h($user['name'] ?? '') ?></td>
                    <td class="app-table-td"><?= $this->h($user['email'] ?? '') ?></td>
                    <td class="app-table-td"><?= $this->h($user['deleted_at'] ?? '') ?></td>
                    <td class="app-table-td">
                        <a href="<?= $this->h($this->route('admin.user.edit', ['id' => $user['id']])) ?>"
                            class="app-btn-secondary app-btn-sm">
                            更新
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>