<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountResource\Pages;
use App\Filament\Resources\AccountResource\RelationManagers\DebitsRelationManager;
use App\Filament\Resources\AccountResource\RelationManagers\DepositsRelationManager;
use App\Filament\Resources\AccountResource\Widgets\AccountBalanceWidget;
use App\Models\Account;
use App\Models\User;
use App\Models\UserType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AccountResource extends Resource
{
    protected static ?string $model = Account::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('user_id')
                    ->relationship(
                        name: 'user',
                        modifyQueryUsing: function (Builder $query) {
                            $query->orderBy('last_name')->orderBy('first_name');
                        })
                    ->getOptionLabelFromRecordUsing(function (User $user) {
                        return "{$user->last_name}, {$user->first_name}";
                    })
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.last_name')
                    ->label('Owner Last Name')
                    ->sortable(),
                TextColumn::make('user.first_name')
                    ->label('Owner First Name')
                    ->sortable(),
                TextColumn::make('name')
                    ->sortable(),
                TextColumn::make('balance')
                    ->money('USD'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            DepositsRelationManager::class,
            DebitsRelationManager::class,
        ];
    }

    public static function getWidgets(): array
    {
        return [
            AccountBalanceWidget::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'edit' => Pages\EditAccount::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();
        if (auth()->user()->user_type_id === UserType::where('name', 'user')->first()->id) {
            return $query->where('user_id', '=', auth()->id());
        }

        return $query;
    }
}
