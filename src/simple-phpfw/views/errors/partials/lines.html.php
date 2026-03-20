<?php

use SFW\Data\File;

$lines = File::getLinesAround($srcPath, $srcLine);

$html = '';
foreach ($lines as $idx => $line) {
    $num = $idx + 1;
    $lineStyle = $srcLine === $num ? 'background: #fdd;' : '';
    $html .= "<div style='$lineStyle'>";
    $html .= "<span style='display: inline-block; width: 2.5rem;'>$num:</span>" . $this->h($line) . "\n";
    $html .= "</div>";
}
?>
<pre class="lines"><?= $html ?></pre>