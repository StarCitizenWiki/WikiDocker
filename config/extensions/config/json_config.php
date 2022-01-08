<?php

$wgJsonConfigEnableLuaSupport = true;

$wgJsonConfigModels['Tabular.JsonConfig'] = 'JsonConfig\JCTabularContent';
$wgJsonConfigs['Tabular.JsonConfig'] = [
    'namespace' => 486,
    'nsName' => 'Data',
    // page name must end in ".tab", and contain at least one symbol
    'pattern' => '/.\.tab$/',
    'license' => 'CC0-1.0',
    'store' => true,
];

$wgJsonConfigModels['Map.JsonConfig'] = 'JsonConfig\JCMapDataContent';
$wgJsonConfigs['Map.JsonConfig'] = [
    'namespace' => 486,
    'nsName' => 'Data',
    // page name must end in ".map", and contain at least one symbol
    'pattern' => '/.\.map$/',
    'license' => 'CC0-1.0',
    'store' => true,
];
