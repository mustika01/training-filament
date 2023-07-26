<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Category;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers\ProductsRelationManager;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    // protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Categories';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Grid::make(3)
                    ->schema([
                        Card::make()
                            ->schema([

                                TextInput::make('name')
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function (\Closure $set, $state) {
                                        $set('slug', Str::slug($state));
                                    }),

                                TextInput::make('slug')
                                    ->required(),
                                Select::make('parent_id')
                                    ->relationship('parent', 'name')
                                    ->columnSpan('full'),

                                Toggle::make('visibility')
                                    ->onColor('success')
                                    ->offColor('danger'),

                                MarkdownEditor::make('description')
                                    ->columnSpan('full'),

                            ])->columns(2)
                            ->columnSpan(['lg' => fn (?Category $record) => $record === null ? 3 : 2]),

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
                            ])->hiddenOn(CreateCategory::class)
                            ->columnSpan(1),
                    ]),

            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('parent.name'),

                IconColumn::make('visibility')
                    ->boolean(),

                TextColumn::make('updated_at')
                    ->dateTime('M j, Y')
                    ->label('Updated Date'),
            ])
            ->filters([
                TernaryFilter::make('visibility'),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
            'view' => Pages\EditCategory::route('/{record}'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::query()
            ->where('visibility', 'true')
            ->count()
        ;
    }

    protected static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 10 ? 'success' : 'warning';
    }
}
