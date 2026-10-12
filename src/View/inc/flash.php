<?php

use Aslam\Test\public\Session;

$flashMessages = [
    'success' => Session::getFlash('success'),
    'error' => Session::getFlash('error'),
];

foreach ($flashMessages as $type => $message) {
    if ($message !== null) {
        $alertClass = $type === 'success' ? 'alert-success' : 'alert-danger';
        ?>
        <div class="alert <?= $alertClass ?>" role="alert">
            <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
        </div>
        <?php
    }
}
