<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelatihanWebinarResource\Pages;
use App\Filament\Resources\PelatihanWebinarResource\RelationManagers;
use App\Models\PelatihanWebinar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PelatihanWebinarResource extends Resource
{
    protected static ?string $model = PelatihanWebinar::class;

    protected static ?string $slug = 'webinars';

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    
    protected static ?string $navigationGroup = 'Sertifikat';
    
    protected static ?string $navigationLabel = 'Pelatihan/Webinar';
    
    protected static ?int $navigationSort = 30;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Pelatihan')
                    ->searchable()
                    ->wrap()
                    ->grow()
                    ->action(
                        Tables\Actions\Action::make('lihatDetail')
                            ->modalHeading('Lihat Pelatihan/Webinar')
                            ->modalContent(function (PelatihanWebinar $record) {
                                return view('filament.modals.pelatihan-webinar-detail', [
                                    'record' => $record
                                ]);
                            })
                            ->modalWidth('lg')
                            ->modalActions([
                                Tables\Actions\Action::make('tutup')
                                    ->label('Tutup')
                                    ->color('gray')
                                    ->close()
                            ])
                    ),
                    
                Tables\Columns\TextColumn::make('sertifikat')
                    ->label('Sertifikat')
                    ->alignCenter()
                    ->formatStateUsing(function (PelatihanWebinar $record): \Illuminate\Contracts\Support\Htmlable {
                        return new \Illuminate\Support\HtmlString('
                            <div class="flex gap-2 justify-center">
                                <a href="#" class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-sm font-medium inline-block">
                                    Download
                                </a>
                                <a href="#" class="bg-transparent hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 px-3 py-1 rounded text-sm font-medium inline-flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat
                                </a>
                            </div>
                        ');
                    }),
            ])
            ->actions([])
            ->bulkActions([])
            ->paginated([10, 25, 50])
            ->defaultPaginationPageOption(10)
            ->striped(false);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPelatihanWebinars::route('/'),
            'create' => Pages\CreatePelatihanWebinar::route('/create'),
            'edit' => Pages\EditPelatihanWebinar::route('/{record}/edit'),
        ];
    }
}
