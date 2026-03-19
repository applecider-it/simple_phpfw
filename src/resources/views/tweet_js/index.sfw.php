<h2 class="app-h2">tweet_js.index</h2>

<script type="module">
    import "@/services/tweet/setup-tweet";
</script>

<div id="tweet"
    data-all="{{
        json_encode([
            'token' => $token,
            'host' => $this->config('app.ws_server_host'),
        ])
    }}">
    <?= $this->render('partials.message.loading') ?>
</div>