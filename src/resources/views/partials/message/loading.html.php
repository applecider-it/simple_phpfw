<?php
$style = "display: flex;
            justify-content: center;
            align-items: center;
            height: 30vh;
            font-family: sans-serif;
            font-size: 1.2rem;
            color: #555;";

$styleSpinner = "width: 2rem;
                height: 2rem;
                border: 3px solid #ccc;
                border-top-color: #333;
                border-radius: 50%;
                animation: app-view-loading-spin 1s linear infinite;
                margin-right: 0.5rem;";
?>
<div style="<?= $style ?>">
    <div style="<?= $styleSpinner ?>"></div>
    <div>読み込み中…</div>
</div>