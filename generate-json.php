<?php

$skeletons = [
    'day' => 'dd',
    'day-month' => 'dd MMMM',
    'month-year' =>'MMMM YYYY',
    'day-month-year' => 'dd MMMM YYYY',
];

$patterns = [];
foreach (['ru', 'en', 'fr', 'he', 'es'] as $locale) {
    $dtpg = new IntlDateTimePatternGenerator($locale);
    $patterns[$locale] = [];
    foreach ($skeletons as $name => $skeleton) {
        $pattern = $dtpg->findBestPattern($skeleton);
        $patterns[$locale][$name]['pattern'] = $pattern;
        $patterns[$locale][$name]['example'] = (new IntlDateFormatter($locale, 0, 0, null, null, $pattern))->format(strtotime('2018-06-21'));
    }
}
echo json_encode($patterns, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
