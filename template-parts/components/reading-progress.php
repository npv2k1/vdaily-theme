<?php
/**
 * Template part for reading progress indicator
 *
 * @package VDaily_Theme
 * @since 1.0.0
 */

if (!is_single()) {
    return;
}
?>

<div class="reading-progress-container" aria-hidden="true">
    <div class="reading-progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
</div>
