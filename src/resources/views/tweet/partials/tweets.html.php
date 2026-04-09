<div style="display:flex; flex-direction:column; gap:3rem;">
    <?php foreach ($data['tweets'] as $tweet): ?>
        <div style="border: 1px solid #dcdcdc; padding: 1rem;">
            <div>
                <?= $this->h($tweet['content']) ?>
            </div>
            <div>
                <?= $this->h($tweet['created_at']) ?>
            </div>
            <div>
                send by <?= $this->h($tweet['user']['name']) ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>