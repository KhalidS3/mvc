<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\url;

$header = $header ?? null;
$message = $message ?? null;

//var_dump($_SESSION)


?><h1><?= $header ?></h1>

<p><?= $message ?></p>
