<?php

namespace App\Filament\Pages;

use App\Models\CompanyProfile;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use BackedEnum;
use UnitEnum;
use Illuminate\Support\Facades\Storage;

class ManageCompanyProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan';

    protected static ?string $navigationLabel = 'Tentang USB';

    protected static ?string $title = 'Pengaturan Tentang USB';

    protected string $view = 'filament.pages.manage-company-profile';

    public ?array $data = [];

    public function mount(): void
    {
        $profile = CompanyProfile::first();
        if ($profile) {
            $this->form->fill($profile->attributesToArray());
        } else {
            $this->form->fill();
        }
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Section::make('Sejarah & Visi Misi')
                    ->schema([
                        RichEditor::make('history')
                            ->label('Sejarah USB')
                            ->columnSpanFull(),
                        RichEditor::make('vision_mission')
                            ->label('Visi & Misi')
                            ->columnSpanFull(),
                    ]),
                Section::make('Identitas Organisasi')
                    ->schema([
                        RichEditor::make('logo_philosophy')
                            ->label('Filosofi Logo')
                            ->columnSpanFull(),
                        FileUpload::make('organization_structure_image')
                            ->label('Gambar Struktur Organisasi')
                            ->image()
                            ->directory('company-profile')
                            ->columnSpanFull(),
                        RichEditor::make('departments')
                            ->label('Penjelasan Departemen')
                            ->columnSpanFull(),
                    ])
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $profile = CompanyProfile::first();

        if ($profile) {
            $profile->update($data);
        } else {
            CompanyProfile::create($data);
        }

        Notification::make()
            ->success()
            ->title('Berhasil disimpan')
            ->body('Pengaturan Tentang USB berhasil diperbarui.')
            ->send();
    }

    public static function canAccess(): bool
    {
        return auth()->user()->role === 'admin';
    }
}
