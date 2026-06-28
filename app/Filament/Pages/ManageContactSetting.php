<?php

namespace App\Filament\Pages;

use App\Models\ContactSetting;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use BackedEnum;
use UnitEnum;

class ManageContactSetting extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-phone';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan';

    protected static ?string $navigationLabel = 'Kontak & Sosmed';

    protected static ?string $title = 'Pengaturan Kontak';

    protected string $view = 'filament.pages.manage-contact-setting';

    public ?array $data = [];

    public function mount(): void
    {
        $setting = ContactSetting::first();
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
                Section::make('Informasi Kontak & Sosial Media')
                    ->schema([
                        TextInput::make('email')
                            ->label('Email')
                            ->email(),
                        TextInput::make('instagram')
                            ->label('Instagram URL')
                            ->url(),
                        TextInput::make('tiktok')
                            ->label('TikTok URL')
                            ->url(),
                        TextInput::make('youtube')
                            ->label('YouTube Channel URL')
                            ->url(),
                        Textarea::make('address')
                            ->label('Alamat Sekretariat')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $setting = ContactSetting::first();

        if ($setting) {
            $setting->update($data);
        } else {
            ContactSetting::create($data);
        }

        Notification::make()
            ->success()
            ->title('Berhasil disimpan')
            ->body('Pengaturan Kontak berhasil diperbarui.')
            ->send();
    }

    public static function canAccess(): bool
    {
        return auth()->user()->role === 'admin';
    }
}
