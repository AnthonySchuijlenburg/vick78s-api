<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImageCollectionResource\Pages\CreateImageCollection;
use App\Filament\Resources\ImageCollectionResource\Pages\EditImageCollection;
use App\Filament\Resources\ImageCollectionResource\Pages\ListImageCollections;
use App\Models\ImageCollection;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ImageCollectionResource extends Resource
{
    protected static ?string $model = ImageCollection::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('weight')
                    ->required()
                    ->numeric(),
                TextInput::make('made_by')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('image_urls')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->imageEditor()
                    ->panelLayout('grid')
                    ->appendFiles()
                    ->directory('image-collections')
                    ->columnSpan(2)
                    ->visibility('public')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1920')
                    ->imageResizeTargetHeight('1080')
                    ->downloadable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }

                        // Only render the tooltip if the column content exceeds the length limit.
                        return $state;
                    }),
                TextColumn::make('weight')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('made_by')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('weight')
            ->reorderable('weight')
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => ListImageCollections::route('/'),
            'create' => CreateImageCollection::route('/create'),
            'edit' => EditImageCollection::route('/{record}/edit'),
        ];
    }
}
