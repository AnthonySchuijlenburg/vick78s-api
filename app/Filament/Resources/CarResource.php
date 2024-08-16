<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarResource\Pages\CreateCar;
use App\Filament\Resources\CarResource\Pages\EditCar;
use App\Filament\Resources\CarResource\Pages\ListCars;
use App\Filament\Resources\CarResource\RelationManagers\EventsRelationManager;
use App\Models\Car;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Support\Str;

class CarResource extends Resource
{
    protected static ?string $model = Car::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->live()
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                        if (($get('slug') ?? '') !== Str::slug($old)) {
                            return;
                        }

                        $set('slug', Str::slug($state));
                    })
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                TextInput::make('model_year')
                    ->required()
                    ->numeric(),
                TextInput::make('weight')
                    ->required()
                    ->numeric(),
                TextInput::make('engine')
                    ->required()
                    ->maxLength(255),
                TextInput::make('transmission')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image_url')
                    ->image()
                    ->directory('cars')
                    ->columnSpan('full')
                    ->visibility('public')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1920')
                    ->imageResizeTargetHeight('1080')
                    ->downloadable()
                    ->required(),
                TiptapEditor::make('content')
                    ->directory('cars/content')
                    ->columnSpan('full')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url'),
                TextColumn::make('title')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }

                        // Only render the tooltip if the column content exceeds the length limit.
                        return $state;
                    })
                    ->sortable()
                    ->searchable(),
                TextColumn::make('model_year')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('engine')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('transmission')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('weight')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->reorderable('weight')
            ->defaultSort('weight')
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            EventsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCars::route('/'),
            'create' => CreateCar::route('/create'),
            'edit' => EditCar::route('/{record}/edit'),
        ];
    }
}
