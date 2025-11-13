<?php

namespace App\Filament\Resources\KurikulumPelatihanResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DetailCurriculaRelationManager extends RelationManager
{
    protected static string $relationship = 'detailCurricula';

    protected static ?string $title = 'Detail Curriculum';

    protected static ?string $modelLabel = 'Detail Curriculum';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kelompok_pelatihan')
                    ->label('Kelompok Mata Pelatihan')
                    ->required()
                    ->options([
                        'Kelompok' => 'Kelompok',
                        'Dasar' => 'Dasar',
                        'Inti' => 'Inti',
                        'Penunjang' => 'Penunjang',
                    ])
                    ->placeholder('Kelompok')
                    ->columnSpanFull(),
                    
                Forms\Components\Section::make('Detail')
                    ->schema([
                        Forms\Components\Repeater::make('detail_items')
                            ->label('')
                            ->schema([
                                Forms\Components\RichEditor::make('nama_detail')
                                    ->label('')
                                    ->placeholder('Pembangunan Bidang Agama')
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                        'strike',
                                        'bulletList',
                                    ])
                                    ->columnSpan(3),
                                    
                                Forms\Components\TextInput::make('urutan')
                                    ->label('')
                                    ->placeholder('0')
                                    ->numeric()
                                    ->columnSpan(1),
                            ])
                            ->columns(4)
                            ->defaultItems(3)
                            ->addActionLabel('Tambahkan detail')
                            ->deleteAction(
                                fn ($action) => $action->icon('heroicon-o-trash')->color('danger')
                            )
                            ->reorderableWithButtons()
                            ->cloneable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['nama_detail'] ?? null),
                    ])
                    ->columnSpanFull(),
            ])
            ->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('kelompok_pelatihan')
            ->columns([
                Tables\Columns\TextColumn::make('kelompok_pelatihan')
                    ->label('Kelompok Pelatihan'),
                    
                Tables\Columns\TextColumn::make('detail_mata_pelatihan')
                    ->label('Detail Mata Pelatihan')
                    ->wrap()
                    ->limit(200)
                    ->formatStateUsing(function ($state, $record) {
                        if ($record->detail_items && is_array($record->detail_items)) {
                            return collect($record->detail_items)
                                ->pluck('nama_detail')
                                ->filter()
                                ->implode("\n");
                        }
                        return $state;
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Buat')
                    ->color('warning')
                    ->modalHeading('Tambah Detail Kurikulum')
                    ->modalSubmitActionLabel('Simpan')
                    ->modalCancelActionLabel('Batal')
                    ->modalWidth('4xl'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Ubah')
                    ->color('warning')
                    ->modalHeading('Ubah Detail Kurikulum')
                    ->modalSubmitActionLabel('Simpan')
                    ->modalCancelActionLabel('Batal')
                    ->modalWidth('4xl'),
                    
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->color('danger'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultPaginationPageOption(10);
    }
}
