<?php

$files = [
    'resources/views/dashboard/owner.blade.php',
    'resources/views/livestock/index.blade.php',
    'resources/views/livestock/show.blade.php',
    'resources/views/owners/index.blade.php',
];

$replacements = [
    "match (\$animal->health_status) {
                                        'Sick' => 'bg-red-100 text-red-700',
                                        'Under Treatment' => 'bg-yellow-100 text-yellow-800',
                                        'Hospitalized' => 'bg-slate-200 text-slate-800',
                                        'Injured' => 'bg-amber-100 text-amber-800',
                                        default => 'bg-slate-100 text-slate-600',
                                    };" => "[
                                        'Sick' => 'bg-red-100 text-red-700',
                                        'Under Treatment' => 'bg-yellow-100 text-yellow-800',
                                        'Hospitalized' => 'bg-slate-200 text-slate-800',
                                        'Injured' => 'bg-amber-100 text-amber-800',
                                    ][\$animal->health_status] ?? 'bg-slate-100 text-slate-600';",
                                    
    "match(strtolower(\$animal->type)) {
                                        'cow', 'cattle' => '🐄', 'goat' => '🐐', 'sheep' => '🐑',
                                        'pig' => '🐖', 'horse' => '🐴', 'chicken', 'poultry' => '🐔',
                                        'duck' => '🦆', default => '🐾',
                                    };" => "(function(\$t) { \$m = ['cow'=>'🐄', 'cattle'=>'🐄', 'goat'=>'🐐', 'sheep'=>'🐑', 'pig'=>'🐖', 'horse'=>'🐴', 'chicken'=>'🐔', 'poultry'=>'🐔', 'duck'=>'🦆']; return \$m[\$t] ?? '🐾'; })(strtolower(\$animal->type));",

    "match (\$history->event_type) {
                                        'Vaccination' => ['text-blue-500', 'bg-blue-100', '💉'],
                                        'Treatment' => ['text-purple-500', 'bg-purple-100', '💊'],
                                        'Checkup' => ['text-green-500', 'bg-green-100', '🩺'],
                                        'Illness' => ['text-red-500', 'bg-red-100', '🤒'],
                                        'Deworming' => ['text-teal-500', 'bg-teal-100', '🧪'],
                                        'Surgery' => ['text-orange-500', 'bg-orange-100', '🔬'],
                                        default => ['text-slate-500', 'bg-slate-100', '📝'],
                                    };" => "[
                                        'Vaccination' => ['text-blue-500', 'bg-blue-100', '💉'],
                                        'Treatment' => ['text-purple-500', 'bg-purple-100', '💊'],
                                        'Checkup' => ['text-green-500', 'bg-green-100', '🩺'],
                                        'Illness' => ['text-red-500', 'bg-red-100', '🤒'],
                                        'Deworming' => ['text-teal-500', 'bg-teal-100', '🧪'],
                                        'Surgery' => ['text-orange-500', 'bg-orange-100', '🔬'],
                                    ][\$history->event_type] ?? ['text-slate-500', 'bg-slate-100', '📝'];",
                                    
    "match(strtolower(\$livestock->type)) {
                                'cow', 'cattle' => '🐄', 'goat' => '🐐', 'sheep' => '🐑',
                                'pig' => '🐖', 'horse' => '🐴', 'chicken', 'poultry' => '🐔',
                                'duck' => '🦆', default => '🐾',
                            };" => "(function(\$t) { \$m = ['cow'=>'🐄', 'cattle'=>'🐄', 'goat'=>'🐐', 'sheep'=>'🐑', 'pig'=>'🐖', 'horse'=>'🐴', 'chicken'=>'🐔', 'poultry'=>'🐔', 'duck'=>'🦆']; return \$m[\$t] ?? '🐾'; })(strtolower(\$livestock->type));",

    "match (\$livestock->health_status) {
                                'Sick' => 'bg-red-100 text-red-700 border-red-200',
                                'Under Treatment' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                'Hospitalized' => 'bg-slate-200 text-slate-800 border-slate-300',
                                'Injured' => 'bg-amber-100 text-amber-800 border-amber-200',
                                default => 'bg-green-100 text-green-700 border-green-200',
                            };" => "[
                                'Sick' => 'bg-red-100 text-red-700 border-red-200',
                                'Under Treatment' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                'Hospitalized' => 'bg-slate-200 text-slate-800 border-slate-300',
                                'Injured' => 'bg-amber-100 text-amber-800 border-amber-200',
                            ][\$livestock->health_status] ?? 'bg-green-100 text-green-700 border-green-200';",

    "match (\$livestock->health_status) {
                                'Sick' => 'bg-red-500',
                                'Under Treatment' => 'bg-yellow-500',
                                'Hospitalized' => 'bg-slate-500',
                                'Injured' => 'bg-amber-500',
                                default => 'bg-green-500',
                            };" => "[
                                'Sick' => 'bg-red-500',
                                'Under Treatment' => 'bg-yellow-500',
                                'Hospitalized' => 'bg-slate-500',
                                'Injured' => 'bg-amber-500',
                            ][\$livestock->health_status] ?? 'bg-green-500';",

    "match(strtolower(\$animal->type)) {
                            'cow', 'cattle' => '🐄', 'goat' => '🐐', 'sheep' => '🐑',
                            'pig' => '🐖', 'horse' => '🐴', 'chicken', 'poultry' => '🐔',
                            'duck' => '🦆', default => '🐾',
                        };" => "(function(\$t) { \$m = ['cow'=>'🐄', 'cattle'=>'🐄', 'goat'=>'🐐', 'sheep'=>'🐑', 'pig'=>'🐖', 'horse'=>'🐴', 'chicken'=>'🐔', 'poultry'=>'🐔', 'duck'=>'🦆']; return \$m[\$t] ?? '🐾'; })(strtolower(\$animal->type));",

    "match (\$animal->health_status) {
                            'Sick' => 'bg-red-100 text-red-700 border-red-200',
                            'Under Treatment' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                            'Hospitalized' => 'bg-slate-200 text-slate-800 border-slate-300',
                            'Injured' => 'bg-amber-100 text-amber-800 border-amber-200',
                            default => 'bg-green-100 text-green-700 border-green-200',
                        };" => "[
                            'Sick' => 'bg-red-100 text-red-700 border-red-200',
                            'Under Treatment' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                            'Hospitalized' => 'bg-slate-200 text-slate-800 border-slate-300',
                            'Injured' => 'bg-amber-100 text-amber-800 border-amber-200',
                        ][\$animal->health_status] ?? 'bg-green-100 text-green-700 border-green-200';",

    "match (\$animal->health_status) {
                            'Sick' => 'bg-red-500',
                            'Under Treatment' => 'bg-yellow-500',
                            'Hospitalized' => 'bg-slate-500',
                            'Injured' => 'bg-amber-500',
                            default => 'bg-green-500',
                        };" => "[
                            'Sick' => 'bg-red-500',
                            'Under Treatment' => 'bg-yellow-500',
                            'Hospitalized' => 'bg-slate-500',
                            'Injured' => 'bg-amber-500',
                        ][\$animal->health_status] ?? 'bg-green-500';",

    "match(strtolower(\$animal->type)) {
                                'cow', 'cattle' => '🐄', 'goat' => '🐐', 'sheep' => '🐑',
                                'pig' => '🐖', 'horse' => '🐴', 'chicken', 'poultry' => '🐔',
                                'duck' => '🦆', default => '🐾',
                            };" => "(function(\$t) { \$m = ['cow'=>'🐄', 'cattle'=>'🐄', 'goat'=>'🐐', 'sheep'=>'🐑', 'pig'=>'🐖', 'horse'=>'🐴', 'chicken'=>'🐔', 'poultry'=>'🐔', 'duck'=>'🦆']; return \$m[\$t] ?? '🐾'; })(strtolower(\$animal->type));",

    "match (\$animal->health_status) {
                                'Sick' => 'bg-red-100 text-red-700',
                                'Under Treatment' => 'bg-yellow-100 text-yellow-800',
                                'Hospitalized' => 'bg-slate-200 text-slate-800',
                                'Injured' => 'bg-amber-100 text-amber-800',
                                default => 'bg-green-100 text-green-700',
                            };" => "[
                                'Sick' => 'bg-red-100 text-red-700',
                                'Under Treatment' => 'bg-yellow-100 text-yellow-800',
                                'Hospitalized' => 'bg-slate-200 text-slate-800',
                                'Injured' => 'bg-amber-100 text-amber-800',
                            ][\$animal->health_status] ?? 'bg-green-100 text-green-700';"
];

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    $original = file_get_contents($file);
    $content = $original;
    foreach ($replacements as $search => $replace) {
        $content = str_replace(str_replace("\r\n", "\n", $search), $replace, $content);
        $content = str_replace(str_replace("\n", "\r\n", $search), $replace, $content);
    }
    
    // Also a regex fallback for anything that resembles `match` assignment in blade views:
    $content = preg_replace_callback(
        '/match\s*\(\$([a-zA-Z0-9_\->]+)\)\s*\{\s*([^}]+)default\s*=>\s*([^,]+),?\s*\}/s',
        function ($matches) {
            $cases = $matches[2];
            $default = $matches[3];
            return "[\n{$cases}][\${$matches[1]}] ?? {$default}";
        },
        $content
    );
    
    // specifically for strtolower type match:
    $content = preg_replace_callback(
        '/match\s*\(strtolower\(\$([a-zA-Z0-9_\->]+)\)\)\s*\{\s*(.*?)\s*default\s*=>\s*([^,]+),?\s*\}/s',
        function ($matches) {
            $default = $matches[3];
            return "(function(\$t) { \$m = ['cow'=>'🐄', 'cattle'=>'🐄', 'goat'=>'🐐', 'sheep'=>'🐑', 'pig'=>'🐖', 'horse'=>'🐴', 'chicken'=>'🐔', 'poultry'=>'🐔', 'duck'=>'🦆']; return \$m[\$t] ?? {$default}; })(strtolower(\${$matches[1]}))";
        },
        $content
    );

    if ($content !== $original) {
        file_put_contents($file, $content);
        echo "Fixed matches in $file\n";
    }
}
