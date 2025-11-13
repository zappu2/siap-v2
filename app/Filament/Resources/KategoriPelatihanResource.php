<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriPelatihanResource\Pages;
use App\Filament\Resources\KategoriPelatihanResource\RelationManagers;
use App\Models\KategoriPelatihan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KategoriPelatihanResource extends Resource
{
    protected static ?string $model = KategoriPelatihan::class;

    protected static ?string $slug = 'course-categories';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $navigationGroup = 'Kelola Pelatihan';
    
    protected static ?string $navigationLabel = 'Kategori Pelatihan';
    
    protected static ?int $navigationSort = 20;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Textarea::make('nama')
                                    ->label('Nama')
                                    ->required()
                                    ->rows(3)
                                    ->placeholder('Balai Diklat Keagamaan Denpasar'),
                                    
                                Forms\Components\TextInput::make('id_number')
                                    ->label('ID Number')
                                    ->placeholder('bdl-11'),
                            ]),
                            
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('kode_satker')
                                    ->label('Kode Satker'),
                                    
                                Forms\Components\TextInput::make('kota')
                                    ->label('Kota'),
                            ]),
                            
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\RichEditor::make('deskripsi')
                                    ->label('Description')
                                    ->required()
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                        'strike',
                                        'link',
                                        'heading',
                                        'subheading',
                                        'bulletList',
                                        'orderedList',
                                        'redo',
                                        'undo',
                                    ])
                                    ->placeholder('Balai Diklat Keagamaan Denpasar'),
                                    
                                Forms\Components\Select::make('description_format')
                                    ->label('Description Format')
                                    ->options([
                                        '1' => '1',
                                        '2' => '2',
                                        '3' => '3',
                                    ])
                                    ->default('1'),
                            ]),
                            
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('parent')
                                    ->label('Parent')
                                    ->required()
                                    ->numeric()
                                    ->default(0),
                                    
                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Sort Order')
                                    ->numeric()
                                    ->default(780000),
                            ]),
                            
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('course_count')
                                    ->label('Course Count')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled(),
                                    
                                Forms\Components\Radio::make('visible')
                                    ->label('Visible')
                                    ->required()
                                    ->options([
                                        true => 'Active',
                                        false => 'Non Active',
                                    ])
                                    ->default(true)
                                    ->inline()
                                    ->inlineLabel(false),
                            ]),
                            
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('path')
                                    ->label('Path')
                                    ->default('/1'),
                                    
                                Forms\Components\TextInput::make('theme')
                                    ->label('Theme'),
                            ]),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                    
                Tables\Columns\IconColumn::make('visible')
                    ->label('Visible')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('visible')
                    ->label('Status Visible')
                    ->boolean()
                    ->trueLabel('Visible')
                    ->falseLabel('Hidden')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->icon('heroicon-o-eye'),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->icon('heroicon-o-pencil'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus'),
                ]),
            ])
            ->emptyStateHeading('Belum ada kategori pelatihan')
            ->emptyStateDescription('Mulai dengan membuat kategori pelatihan pertama.')
            ->emptyStateIcon('heroicon-o-rectangle-stack')
            ->striped()
            ->paginated([5, 10, 25, 50])
            ->defaultPaginationPageOption(5)
            ->paginationPageOptions([5, 10, 25, 50])
            ->defaultSort('id');
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
            'index' => Pages\ListKategoriPelatihans::route('/'),
            'create' => Pages\CreateKategoriPelatihan::route('/create'),
            'edit' => Pages\EditKategoriPelatihan::route('/{record}/edit'),
        ];
    }
}
