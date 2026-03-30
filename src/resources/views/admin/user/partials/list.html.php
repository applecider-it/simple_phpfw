<div class="app-table-wrap">
    <table style="margin-top: 1rem;" class="app-table">
        <thead>
            <tr class="app-table-row-header">
                <th class="app-table-cell" style="text-align: left;">ID</th>
                <th class="app-table-cell" style="text-align: left;">Name</th>
                <th class="app-table-cell" style="text-align: left;">Email</th>
                <th class="app-table-cell" style="text-align: left;">削除日時</th>
                <th class="app-table-cell">更新</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr class="app-table-row-data" style="<?= $user['deleted_at'] ? 'background: #ddd;' : '' ?>">
                    <td class="app-table-cell"><?= $this->h($user['id'] ?? '') ?></td>
                    <td class="app-table-cell"><?= $this->h($user['name'] ?? '') ?></td>
                    <td class="app-table-cell"><?= $this->h($user['email'] ?? '') ?></td>
                    <td class="app-table-cell"><?= $this->h($user['deleted_at'] ?? '') ?></td>
                    <td class="app-table-cell" style="text-align:center;">
                        <a href="<?= $this->h($this->route('admin.user.edit', ['id' => $user['id']])) ?>" class="app-btn-primary">
                            更新
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>