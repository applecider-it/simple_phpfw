<script type="module">
    const btn = document.querySelector('#trace-all-exceptions-btn');
    const box = document.querySelector('#trace-all-exceptions-box');

    btn.addEventListener('click', (e) => {
        e.preventDefault();
        box.classList.toggle('active');

        btn.scrollIntoView({
            behavior: 'smooth' // なめらかスクロール
        });
    });
</script>

<h3 style="margin-top: 4rem;"><a href="#" id="trace-all-exceptions-btn">All Exceptions</a></h3>
<div id="trace-all-exceptions-box">
    <div style="display:flex; flex-direction:column; gap:1rem;">
        <?php foreach ($exceptions as $exception): ?>
            <?= $this->render('errors.partials.exception', [
                'exception' => $exception,
            ]) ?>
        <?php endforeach; ?>
    </div>
</div>