<div class="flex flex-col gap-6">
    <?php foreach ($data['tweets'] as $tweet): ?>
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 hover:shadow-md transition">
            
            <div class="text-gray-800 text-base leading-relaxed mb-3">
                <?= $this->h($tweet['content']) ?>
            </div>

            <div class="text-sm text-gray-400 mb-2">
                <?= $this->h($tweet['created_at']) ?>
            </div>

            <div class="text-sm text-gray-600">
                <span class="font-semibold text-gray-800">
                    <?= $this->h($tweet['user']['name']) ?>
                </span>
                <span class="text-gray-400 ml-1">が投稿</span>
            </div>

        </div>
    <?php endforeach; ?>
</div>