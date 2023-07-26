<?php

namespace App\Filament\Resources\BrandResource\RelationManagers;

use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
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
                                MarkdownEditor::make('description')
                                    ->columnSpan('full'),
                            ])
                            ->columns(2),

                        Section::make('Images')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('media')
                                    ->collection('product-images')
                                    ->multiple()
                                    ->maxFiles(5)
                                    ->disableLabel(),
                            ])
                            ->collapsible(),

                        Section::make('Pricing')
                            ->schema([
                                TextInput::make('price')
                                    ->required()
                                    ->numeric(),
                                TextInput::make('old_price')
                                    ->label('Compare at price')
                                    ->required()
                                    ->numeric(),
                                TextInput::make('cost')
                                    ->label('Cost per item')
                                    ->helperText('Customers won\'t see this price.')
                                    ->required()
                                    ->numeric(),
                            ])
                            ->columns(2),
                        Section::make('Inventory')
                            ->schema([
                                TextInput::make('sku')
                                    ->label('SKU (Stock Keeping Unit)')
                                    ->required(),
                                TextInput::make('barcode')
                                    ->label('Barcode (ISBN,UPC, GTIN, etc.')
                                    ->required(),
                                TextInput::make('quantity')
                                    ->label('Quantity')
                                    ->required(),
                                TextInput::make('security')
                                    ->label('Security stock')
                                    ->helperText('The safety stock is the limit stock for your products which alerts you if the product stock will soon be out of stock.')
                                    ->required(),
                            ])->columns(2),

                        Section::make('Shipping')
                            ->schema([
                                Checkbox::make('backorder')
                                    ->label('This product can be returned'),
                                Checkbox::make('requires_shipping')
                                    ->label('This product will be shipped'),
                            ])
                            ->columns(2),
                    ])->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Status')
                            ->schema([
                                Toggle::make('is_visible')
                                    ->label('Visible')
                                    ->default(true)
                                    ->helperText('This product will be hidden from all sales channels.'),
                                DatePicker::make('published_at')
                                    ->label('Availability')
                                    ->required()
                                    ->default(now()),
                            ]),
                        Section::make('Associations')
                            ->schema([
                                Select::make('brand_id')
                                    ->Relationship('brand', 'name_b')
                                    ->searchable()
                                    ->label('Brand'),
                                Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->label('Categories')
                                    ->required(),
                            ]),
                    ])->columnSpan(['lg' => 1]),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('media')
                    ->label('Image')
                    ->collection('product-images'),
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Price')
                    ->sortable(),
                TextColumn::make('sku')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('quantity')
                    ->label('Qty')
                    ->toggleable()
                    ->sortable(),
                IconColumn::make('is_visible')
                    ->boolean()
                    ->label('Visibility')
                    ->toggleable()
                    ->sortable(),
            ])
            ->filters([

            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
        ;
    }
}
