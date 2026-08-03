<?php

namespace App\Filament\Pages;

use App\Models\OprecSetting;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use BackedEnum;
use UnitEnum;

class ManageOprecSetting extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static string|UnitEnum|null $navigationGroup = 'Pendaftaran & Interaksi';

    protected static ?string $navigationLabel = 'Pengaturan Oprec';

    protected static ?string $title = 'Pengaturan Open Recruitment';

    protected string $view = 'filament.pages.manage-oprec-setting';

    public ?array $data = [];

    public function mount(): void
    {
        $setting = OprecSetting::first();
        if ($setting) {
            $this->form->fill($setting->attributesToArray());
        } else {
            $this->form->fill();
        }
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Section::make('Status & Periode Oprec')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Buka Pendaftaran (Oprec Aktif)')
                            ->helperText('Jika aktif, form pendaftaran akan muncul di halaman web.')
                            ->inline(false)
                            ->default(false),
                        TextInput::make('title')
                            ->label('Judul Oprec')
                            ->default('Open Recruitment Member USB'),
                        DatePicker::make('start_date')
                            ->label('Tanggal Mulai'),
                        DatePicker::make('end_date')
                            ->label('Tanggal Berakhir'),
                    ])->columns(2),
                Section::make('Media & Deskripsi')
                    ->schema([
                        FileUpload::make('brochure_image')
                            ->label('Poster / Brosur Oprec')
                            ->image()
                            ->directory('oprec_settings')
                            ->columnSpanFull(),
                        RichEditor::make('description')
                            ->label('Deskripsi / Pesan Tambahan')
                            ->columnSpanFull(),
                    ])
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $setting = OprecSetting::first();

        if ($setting) {
            $setting->update($data);
        } else {
            OprecSetting::create($data);
        }

        Notification::make()
            ->success()
            ->title('Berhasil disimpan')
            ->body('Pengaturan Oprec berhasil diperbarui.')
            ->send();
    }

    public static function canAccess(): bool
    {
        return auth()->user()->role === 'admin';
    }
}
