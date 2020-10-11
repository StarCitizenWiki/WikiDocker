<?php

$actions = [
    'edit',
    'watch',
    'unwatch',
    'delete',
    'revert',
    'rollback',
    'protect',
    'unprotect',
    'markpatrolled',
    'render',
    'submit',
    'history',
    'purge',
    'info',
];

foreach ($actions as $action) {
    $wgActionPaths[$action] = "/$1/$action";
}
$wgActionPaths['view'] = "/$1";
$wgArticlePath = $wgActionPaths['view'];
