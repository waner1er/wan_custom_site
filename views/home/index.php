<?php
ob_start();

echo 'GHomepage efgzef lqdflqfih';

$content = ob_get_contents();
ob_end_clean();
include BASE_URL . '/views/components/layout.php';