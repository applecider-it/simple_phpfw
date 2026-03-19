<?php

use App\Services\User\AuthService as Auth;

$user = Auth::get();
?>
<meta charset="UTF-8">

<?= $this->render('partials.form.csrf_meta') ?>

<title>{{ $data['title'] ?? $this->config('applicationName') }}</title>

<link rel="icon" type="image/svg+xml" href="/favicon.svg">

<link rel="stylesheet" href="{{ $this->file('/css/app.css') }}">

<?php if ($user): ?>
    <meta name="user" data-json="{{ json_encode($user) }}">
<?php endif; ?>

<?= $this->render('partials.app.meta') ?>

<script type="importmap"><?= json_encode($this->config('app.importmap.app')) ?></script>
<script type="module">
    import "@/services/app/setup-app";
</script>