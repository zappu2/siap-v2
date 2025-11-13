<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KurikulumPelatihanResource\Pages;
use App\Filament\Resources\KurikulumPelatihanResource\RelationManagers;
use App\Models\KurikulumPelatihan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KurikulumPelatihanResource extends Resource
{
    protected static ?string $model = KurikulumPelatihan::class;

    protected static ?string $slug = 'curricula';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    
    protected static ?string $navigationGroup = 'Kelola Pelatihan';
    
    protected static ?string $navigationLabel = 'Kurikulum Pelatihan';
    
    protected static ?string $modelLabel = 'Kurikulum Pelatihan';
    
    protected static ?string $pluralModelLabel = 'Kurikulum Pelatihan';
    
    protected static ?int $navigationSort = 23;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Kurikulum')
                    ->schema([
                        Forms\Components\Textarea::make('nama_pelatihan')
                            ->label('Kurikulum Pelatihan')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                            
                        Forms\Components\Select::make('jenis_pelatihan')
                            ->label('Jenis Pelatihan')
                            ->required()
                            ->options([
                                'teknis' => 'Pelatihan Teknis',
                                'lainnya' => 'Lainnya',
                                'manajerial' => 'Manajerial',
                                'fungsional' => 'Fungsional',
                            ])
                            ->searchable(),
                            
                        Forms\Components\TextInput::make('jam_pelajaran')
                            ->label('Jam Pelatihan')
                            ->required()
                            ->placeholder('54 (lima puluh empat)')
                            ->hint('Jam Pelatihan')
                            ->helperText('Contoh: 54 (Lima Puluh Empat)'),
                            
                        Forms\Components\RichEditor::make('kompetensi')
                            ->label('Kompetensi (optional)')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'link',
                                'bulletList',
                                'orderedList',
                                'undo',
                                'redo',
                            ])
                            ->columnSpanFull(),
                            
                        Forms\Components\RichEditor::make('catatan')
                            ->label('Catatan (optional)')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'link',
                                'bulletList',
                                'orderedList',
                                'undo',
                                'redo',
                            ])
                            ->columnSpanFull(),
                            
                        Forms\Components\FileUpload::make('sertifikat_depan')
                            ->label('Sertifikat depan')
                            ->placeholder('Seret & Jatuhkan berkas Anda atau Jelajahi')
                            ->acceptedFileTypes(['image/*', 'application/pdf'])
                            ->directory('sertifikat'),
                            
                        Forms\Components\FileUpload::make('sertifikat_belakang')
                            ->label('Sertifikat belakang')
                            ->placeholder('Seret & Jatuhkan berkas Anda atau Jelajahi')
                            ->acceptedFileTypes(['image/*', 'application/pdf'])
                            ->directory('sertifikat'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_pelatihan')
                    ->label('Nama Pelatihan')
                    ->searchable()
                    ->wrap()
                    ->limit(80),
                    
                Tables\Columns\TextColumn::make('jenis_pelatihan')
                    ->label('Jenis Pelatihan')
                    ->sortable()
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('jam_pelajaran')
                    ->label('Jam Pelajaran')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('lihat')
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->action(function () {
                        // View action placeholder
                    }),
                    
                Tables\Actions\EditAction::make()
                    ->label('Ubah')
                    ->icon('heroicon-o-pencil')
                    ->color('warning'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([5, 10, 25, 50])
            ->defaultPaginationPageOption(5);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DetailCurriculaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKurikulumPelatihans::route('/'),
            'create' => Pages\CreateKurikulumPelatihan::route('/create'),
            'edit' => Pages\EditKurikulumPelatihan::route('/{record}/edit'),
        ];
    }
}
