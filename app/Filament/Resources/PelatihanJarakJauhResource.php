<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelatihanJarakJauhResource\Pages;
use App\Filament\Resources\PelatihanJarakJauhResource\RelationManagers;
use App\Models\PelatihanJarakJauh;
use App\Models\CourseCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PelatihanJarakJauhResource extends Resource
{
    protected static ?string $model = PelatihanJarakJauh::class;

    protected static ?string $slug = 'courses';

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Pelatihan Jarak Jauh';

    protected static ?string $modelLabel = 'Pelatihan Jarak Jauh';

    protected static ?string $pluralModelLabel = 'Pelatihan Jarak Jauh';

    protected static ?string $navigationGroup = 'Kelola Pelatihan';
    
    protected static ?int $navigationSort = 21;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('nama')
                    ->label('Nama')
                    ->required()
                    ->rows(3),
                    
                Forms\Components\Textarea::make('display_name')
                    ->label('Display name')
                    ->required()
                    ->rows(3),
                    
                Forms\Components\TextInput::make('short_name')
                    ->label('Short name')
                    ->maxLength(255),
                    
                Forms\Components\Select::make('course_category')
                    ->label('Course category')
                    ->required()
                    ->placeholder('Pilih salah satu opsi')
                    ->options(CourseCategory::where('is_active', true)->pluck('name', 'slug'))
                    ->searchable(),
                    
                Forms\Components\Textarea::make('kategori_order')
                    ->label('Kategori Order')
                    ->rows(3),
                    
                Forms\Components\TextInput::make('id_number')
                    ->label('ID number')
                    ->required()
                    ->maxLength(255),
                    
                Forms\Components\RichEditor::make('summary')
                    ->label('Summary')
                    ->required()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'link',
                        'bulletList',
                        'orderedList',
                        'h2',
                        'h3',
                        'blockquote',
                        'codeBlock',
                    ])
                    ->columnSpanFull(),
                    
                Forms\Components\TextInput::make('summary_format')
                    ->label('Summary Format')
                    ->numeric()
                    ->default(1),
                    
                Forms\Components\TextInput::make('news_items')
                    ->label('News Items')
                    ->required()
                    ->numeric()
                    ->default(3),
                    
                Forms\Components\DatePicker::make('tanggal_mulai')
                    ->label('Tanggal Mulai'),
                    
                Forms\Components\DatePicker::make('tanggal_akhir')
                    ->label('Tanggal Akhir')
                    ->required(),
                    
                Forms\Components\TextInput::make('group_mode')
                    ->label('Group Mode')
                    ->numeric()
                    ->default(0),
                    
                Forms\Components\Radio::make('visible')
                    ->label('Visible')
                    ->required()
                    ->options([
                        1 => 'Active',
                        0 => 'Non Active',
                    ])
                    ->default(1)
                    ->inline(),
                    
                // Peserta Pelatihan Section
                Forms\Components\Section::make('Peserta Pelatihan')
                    ->schema([
                        Forms\Components\Placeholder::make('peserta_info')
                            ->label('')
                            ->content('Tidak ada data yang ditemukan')
                            ->extraAttributes([
                                'class' => 'text-center py-8 text-gray-500'
                            ]),
                            
                        Forms\Components\Actions::make([
                            Forms\Components\Actions\Action::make('lampirkan')
                                ->label('Lampirkan')
                                ->color('gray')
                                ->button(),
                        ])
                        ->alignRight(),
                    ])
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('nama_pelatihan')
                    ->label('Nama Pelatihan')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->weight('medium')
                    ->width('35%'),
                    
                Tables\Columns\BadgeColumn::make('penyelenggara')
                    ->label('Penyelenggara')
                    ->colors([
                        'warning' => 'Balai Diklat Keagamaan Bandung',
                        'primary' => 'Balai Diklat Keagamaan Semarang',
                        'success' => 'Balai Diklat Keagamaan Denpasar',
                        'info' => 'Pusbangkom MKMB',
                    ])
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('tanggal_pelaksanaan')
                    ->label('Tanggal Pelaksanaan')
                    ->getStateUsing(function ($record) {
                        if ($record->tanggal_mulai && $record->tanggal_selesai) {
                            return $record->tanggal_mulai->format('d M') . ' - ' . $record->tanggal_selesai->format('d M Y');
                        }
                        return '-';
                    })
                    ->sortable(['tanggal_mulai']),
                    
                Tables\Columns\IconColumn::make('terlihat')
                    ->label('Terlihat')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('penyelenggara')
                    ->label('Penyelenggara')
                    ->options([
                        'Balai Diklat Keagamaan Bandung' => 'Balai Diklat Keagamaan Bandung',
                        'Balai Diklat Keagamaan Semarang' => 'Balai Diklat Keagamaan Semarang',
                        'Balai Diklat Keagamaan Denpasar' => 'Balai Diklat Keagamaan Denpasar',
                        'Pusbangkom MKMB' => 'Pusbangkom MKMB',
                    ]),
                Tables\Filters\TernaryFilter::make('terlihat')
                    ->label('Status Terlihat')
                    ->boolean()
                    ->trueLabel('Terlihat')
                    ->falseLabel('Disembunyikan')
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
            ->emptyStateHeading('Belum ada pelatihan jarak jauh')
            ->emptyStateDescription('Mulai dengan membuat pelatihan jarak jauh pertama.')
            ->emptyStateIcon('heroicon-o-computer-desktop')
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
            'index' => Pages\ListPelatihanJarakJauhs::route('/'),
            'create' => Pages\CreatePelatihanJarakJauh::route('/create'),
            'edit' => Pages\EditPelatihanJarakJauh::route('/{record}/edit'),
        ];
    }
}
