<?php
require dirname(__DIR__) . '/boot/start.php';

(new SFW\Boot\Common)->init();
(new SFW\Boot\Web)->dispatch();
