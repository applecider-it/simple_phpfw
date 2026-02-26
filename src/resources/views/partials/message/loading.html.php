<?php
$idPrefix = "app-local__views__partials__message__loading";

$styleContainer = implode(';', [
  'display: flex',
  'justify-content: center',
  'align-items: center',
  'height: 30vh',
  'font-family: sans-serif',
  'font-size: 1.2rem',
  'color: #555',
  'opacity: 0',
  'transition-property: opacity',
  'transition-duration: 500ms',
  'transition-timing-function: cubic-bezier(0.4, 0, 1, 1)',
]);

$styleSpinner = implode(';', [
  'width: 2rem',
  'height: 2rem',
  'border: 3px solid #ccc',
  'border-top-color: #333',
  'border-radius: 50%',
  'animation: ' . $idPrefix . '__loading-spin 1s linear infinite',
  'margin-right: 0.5rem',
]);

$styleAnimation = "
  /* viewのローディング用アニメーション */
  @keyframes {$idPrefix}__loading-spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }
";
?>
<style>
  <?= $styleAnimation ?>
</style>

<div class="<?= $idPrefix ?>" style="<?= $styleContainer ?>">
  <div style="<?= $styleSpinner ?>"></div>
  <div>読み込み中…</div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.<?= $idPrefix ?>').forEach((el) => {
      setTimeout(() => {
        el.style.opacity = '1';
      }, 1000);
    });
  });
</script>