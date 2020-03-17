<?php

function yieldTitle($title = null) {
    return $title ? $title . ' - ' . \Config::get('constants.project.title'): \Config::get('constants.project.title');
}