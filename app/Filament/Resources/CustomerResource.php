<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Customer;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\Pages\CreateCustomer;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 1;
    protected static ?string $recordTitleAttribute = 'name_c';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Grid::make(3)
                    ->schema([
                        Card::make()
                            ->schema([

                                TextInput::make('name_c')
                                    ->required()
                                    ->reactive()
                                    ->label('Name'),

                                TextInput::make('email_c')
                                    ->label('Email')
                                    ->required(),

                                TextInput::make('phone_c')
                                    ->label('Phone'),

                                DateTimePicker::make('born_c')
                                    ->label('Birthday'),

                            ])->columns(2)
                            ->columnSpan(['lg' => fn (?Customer $record) => $record === null ? 3 : 2]),

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
                            ->hiddenOn(CreateCustomer::class)
                            ->columnSpan(1),
                    ]),

            ])
        ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_c')
                    ->label('Name')
                    ->searchable(isIndividual: true),
                TextColumn::make('email_c')
                    ->label('Email')
                    ->searchable(isIndividual: true, isGlobal: false),
                TextColumn::make('country_c')
                    ->label('Country'),
                TextColumn::make('phone_c')
                    ->label('Phone'),

            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name_c', 'email_c'];
    }
}
