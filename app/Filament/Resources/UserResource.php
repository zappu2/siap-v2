<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $slug = 'users';

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationGroup = 'Akun';
    
    protected static ?string $navigationLabel = 'Pengguna';
    
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Foto Profile Section
                Forms\Components\Section::make('Foto Profile')
                    ->schema([
                        Forms\Components\FileUpload::make('avatar')
                            ->label('')
                            ->image()
                            ->avatar()
                            ->disk('public')
                            ->directory('profile-photos')
                            ->visibility('public')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('300')
                            ->imageResizeTargetHeight('300')
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->columnSpan(['lg' => 1]),

                // Info Section (Dibuat pada, Terakhir diubah)
                Forms\Components\Section::make('Dibuat pada')
                    ->schema([
                        Forms\Components\Placeholder::make('created_info')
                            ->label('')
                            ->content(fn ($record): string => $record ? $record->created_at->diffForHumans() : 'Baru')
                            ->columnSpanFull(),
                        Forms\Components\Placeholder::make('updated_info')
                            ->label('Terakhir diubah')
                            ->content(fn ($record): string => $record ? $record->updated_at->diffForHumans() : '-')
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->columnSpan(['lg' => 1]),

                // Data Pribadi Section
                Forms\Components\Section::make('Data Pribadi')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('nip')
                                    ->label('NIP')
                                    ->required()
                                    ->maxLength(255)
                                    ->suffixIcon('heroicon-o-identification'),
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('nama_lengkap')
                                    ->label('Nama Lengkap')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('agama')
                                    ->label('Agama')
                                    ->options([
                                        'Islam' => 'Islam',
                                        'Kristen' => 'Kristen',
                                        'Katholik' => 'Katholik',
                                        'Hindu' => 'Hindu',
                                        'Buddha' => 'Buddha',
                                        'Konghucu' => 'Konghucu',
                                    ])
                                    ->searchable(),
                                Forms\Components\Select::make('pangkat_golongan')
                                    ->label('Pangkat/Gol. Ruang')
                                    ->options([
                                        'Penata Tk. I (III/d)' => 'Penata Tk. I (III/d)',
                                        'Penata (III/c)' => 'Penata (III/c)',
                                        'Penata Muda Tk. I (III/b)' => 'Penata Muda Tk. I (III/b)',
                                        'Penata Muda (III/a)' => 'Penata Muda (III/a)',
                                    ])
                                    ->searchable(),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('jabatan')
                                    ->label('Jabatan')
                                    ->maxLength(255),
                                Forms\Components\DatePicker::make('tmt_jabatan')
                                    ->label('TMT Jabatan'),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\DatePicker::make('tmt_cpns')
                                    ->label('TMT CPNS'),
                                Forms\Components\DatePicker::make('tmt_pangkat')
                                    ->label('TMT Pangkat'),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('tempat_lahir')
                                    ->label('Tempat Lahir')
                                    ->maxLength(255),
                                Forms\Components\DatePicker::make('tanggal_lahir')
                                    ->label('Tanggal Lahir'),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Radio::make('jenis_kelamin')
                                    ->label('Jenis Kelamin')
                                    ->options([
                                        'Laki-laki' => 'Laki-laki',
                                        'Perempuan' => 'Perempuan',
                                    ])
                                    ->inline()
                                    ->inlineLabel(false),
                                Forms\Components\TextInput::make('pendidikan')
                                    ->label('Pendidikan')
                                    ->maxLength(255)
                                    ->placeholder('S-2/Magister Computer Science Fakultas Teknik Informatika Tahun 2020'),
                            ]),
                        Forms\Components\TextInput::make('unit_kerja')
                            ->label('Unit Kerja')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->columnSpan(['lg' => 2]),

                // Alamat Section
                Forms\Components\Section::make('Alamat')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('alamat_rumah_1')
                                    ->label('Alamat Rumah 1')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('alamat_rumah_2')
                                    ->label('Alamat Rumah 2')
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('provinsi')
                                    ->label('Provinsi (tempat tinggal)')
                                    ->options([
                                        'BANTEN' => 'BANTEN',
                                        'DKI JAKARTA' => 'DKI JAKARTA',
                                        'JAWA BARAT' => 'JAWA BARAT',
                                        'JAWA TENGAH' => 'JAWA TENGAH',
                                        'JAWA TIMUR' => 'JAWA TIMUR',
                                    ])
                                    ->searchable(),
                                Forms\Components\Select::make('kab_kota')
                                    ->label('Kab/Kota (tempat tinggal)')
                                    ->options([
                                        'KOTA TANGERANG SELATAN' => 'KOTA TANGERANG SELATAN',
                                        'KOTA TANGERANG' => 'KOTA TANGERANG',
                                        'KABUPATEN TANGERANG' => 'KABUPATEN TANGERANG',
                                    ])
                                    ->searchable(),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('kode_pos')
                                    ->label('Kode Pos')
                                    ->maxLength(10),
                                Forms\Components\TextInput::make('nomor_handphone')
                                    ->label('Nomor Handphone')
                                    ->maxLength(20)
                                    ->tel()
                                    ->placeholder('Contoh: 081234567890'),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Textarea::make('alamat_kantor')
                                    ->label('Alamat Kantor')
                                    ->rows(3),
                                Forms\Components\TextInput::make('telepon_kantor')
                                    ->label('Telepon Kantor')
                                    ->maxLength(20)
                                    ->tel(),
                            ]),
                    ])
                    ->columns(1)
                    ->columnSpan(['lg' => 2]),

                // Data Keuangan Section
                Forms\Components\Section::make('Data Keuangan')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('nama_bank')
                                    ->label('Nama Bank')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('no_rekening')
                                    ->label('No. Rekening')
                                    ->maxLength(255),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('nama_di_bank')
                                    ->label('Nama di Bank')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('npwp')
                                    ->label('NPWP')
                                    ->maxLength(255),
                            ]),
                    ])
                    ->columns(1)
                    ->columnSpan(['lg' => 2]),

                // Roles Section
                Forms\Components\Section::make('Roles')
                    ->schema([
                        Forms\Components\Select::make('roles')
                            ->label('')
                            ->options([
                                'peserta' => 'peserta',
                                'admin' => 'admin',
                                'instructor' => 'instructor',
                            ])
                            ->multiple()
                            ->searchable()
                            ->placeholder('Pilih salah satu opsi'),
                    ])
                    ->columns(1)
                    ->columnSpan(['lg' => 2]),

                // Password Section (only for create)
                Forms\Components\Section::make('Password')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->required(fn (string $context): bool => $context === 'create')
                            ->hiddenOn('edit'),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->label('Konfirmasi Password')
                            ->password()
                            ->same('password')
                            ->required(fn (string $context): bool => $context === 'create')
                            ->hiddenOn('edit'),
                    ])
                    ->columns(1)
                    ->columnSpan(['lg' => 2])
                    ->hiddenOn('edit'),

                // Pelatihan yang diikuti Section
                Forms\Components\Section::make('Pelatihan yang diikuti')
                    ->schema([
                        Forms\Components\Placeholder::make('pelatihan_table')
                            ->label('')
                            ->content(function ($record) {
                                if (!$record) return 'Belum ada data pelatihan.';
                                
                                return view('filament.components.pelatihan-table', [
                                    'pelatihan' => [
                                        [
                                            'nama' => 'CONFERENCE AND EXPOSE ON TRAINING "IMPACTFUL AND JOYFUL LEARNING"',
                                            'penyelenggara' => 'Pusbangkom MKMB',
                                            'waktu' => '1 tahun yang lalu'
                                        ],
                                        [
                                            'nama' => 'Seminar Rutin Untuk ASN Inspiratif (SERASI) Seri 1',
                                            'penyelenggara' => 'Pusbangkom MKMB',
                                            'waktu' => '9 bulan yang lalu'
                                        ],
                                        [
                                            'nama' => 'Boost Your Skills : Open Class untuk Pengembangan Diri. "Evaluasi Penilaian Kinerja"',
                                            'penyelenggara' => 'Pusbangkom MKMB',
                                            'waktu' => '9 bulan yang lalu'
                                        ],
                                        [
                                            'nama' => 'Seminar Rutin Untuk ASN Inspiratif (SERASI) Seri 2',
                                            'penyelenggara' => 'Pusbangkom MKMB',
                                            'waktu' => '9 bulan yang lalu'
                                        ],
                                        [
                                            'nama' => 'Seminar Rutin Untuk ASN Inspiratif (SERASI) Seri 3',
                                            'penyelenggara' => 'Pusbangkom MKMB',
                                            'waktu' => '8 bulan yang lalu'
                                        ],
                                    ]
                                ]);
                            })
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->columnSpan(['lg' => 3])
                    ->hiddenOn('create'),
            ])
            ->columns([
                'sm' => 1,
                'lg' => 3,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('Foto')
                    ->circular()
                    ->size(40)
                    ->defaultImageUrl(function ($record) {
                        $initials = collect(explode(' ', $record->name))
                            ->map(fn($word) => strtoupper($word[0]))
                            ->take(2)
                            ->join('');
                        return 'https://ui-avatars.com/api/?name=' . urlencode($initials) . '&color=7F9CF5&background=EBF4FF';
                    }),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama / NIP')
                    ->description(fn ($record): ?string => $record->nip)
                    ->searchable(['name', 'nip'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit_kerja')
                    ->label('Unit Kerja / Jabatan')
                    ->description(fn ($record): ?string => $record->jabatan)
                    ->searchable(['unit_kerja', 'jabatan'])
                    ->sortable()
                    ->wrap(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->modalHeading('Detail Pengguna')
                    ->modalContent(function ($record) {
                        return view('filament.components.user-detail-modal', ['user' => $record]);
                    }),
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->striped()
            ->defaultSort('name')
            ->paginated([10, 25, 50]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
