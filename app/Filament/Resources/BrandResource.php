<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Brand;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\BrandResource\Pages;
use App\Filament\Resources\BrandResource\Pages\CreateBrand;
use App\Filament\Resources\BrandResource\RelationManagers\ProductsRelationManager;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark-alt';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        Card::make()
                            ->schema([
                                TextInput::make('name_b')
                                    ->required()
                                    ->reactive()
                                    ->label('Name')
                                    ->afterStateUpdated(function (\Closure $set, $state) {
                                        $set('slug_b', Str::slug($state));
                                    }),

                                TextInput::make('slug_b')
                                    ->required()
                                    ->label('Slug'),

                                TextInput::make('web_b')
                                    ->required()
                                    ->label('Website')
                                    ->columnSpan('full'),

                                Toggle::make('visible_b')
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->label('Visible to customers.'),

                                MarkdownEditor::make('description_b')
                                    ->columnSpan('full'),

                            ])->columns(2)
                            ->columnSpan([
                                'lg' => function (?Brand $record) {
                                    return $record === null ? 3 : 2;
                                },
                            ]),

                        Card::make()
                            ->schema([
                                Placeholder::make('created_at')
                                    ->content(function (Model $record) {
                                        return $record->created_at->diffForHumans();
                                    }),

                                Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(function (Model $record) {
                                        return $record->updated_at->diffForHumans();
                                    }),

                            ])
                            ->hiddenOn(CreateBrand::class)
                            ->columnSpan(1),
                    ]),

            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_b')
                    ->searchable()
                    ->label('Name'),

                TextColumn::make('web_b')
                    ->label('Website'),

                IconColumn::make('visible_b')
                    ->boolean()
                    ->label('Visibility'),

                TextColumn::make('updated_at')
                    ->dateTime('M j, Y')
                    ->label('Updated Date'),
            ])
            ->filters([

            ])
            ->actions([

                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
        ;
    }

    public static function getRelations(): array
    {
        return [
            ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
            'view' => Pages\EditBrand::route('/{record}'),
        ];
    }
}
