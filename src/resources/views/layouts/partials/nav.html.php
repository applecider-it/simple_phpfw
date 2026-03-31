<div class="app-layout-nav">
    <?= $this->render('layouts.partials.nav.primary') ?>
    <?= $this->render('layouts.partials.nav.responsive') ?>
</div>

<script type="module">
    const btn = document.getElementById("app-nav-mobile-menu-button");
    const area = document.getElementById("app-nav-mobile-menu-area");

    if (btn && area) {
        btn.addEventListener("click", () => {
            area.classList.toggle("app-layout-nav-responsive-links__open");
        });
    }
</script>