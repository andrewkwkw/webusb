<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class CuratorNoteWidget extends Widget
{
    protected string $view = 'filament.widgets.curator-note-widget';
    protected static ?int $sort = 1;
    
    protected int | string | array $columnSpan = 'full';
}
