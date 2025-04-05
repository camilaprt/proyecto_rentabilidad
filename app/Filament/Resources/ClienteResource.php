<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClienteResource\Pages;
use App\Filament\Resources\ClienteResource\RelationManagers;
use App\Models\Cliente;

use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Datos del cliente')
                ->relationship('persona')
                ->schema([
                    TextInput::make('nombre')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(45),
                TextInput::make('direccion')
                    ->label('Direccion')
                    ->minLength(2)
                    ->maxLength(255)//frontend validation
                    ->rules(['max:255']),
                    
                TextInput::make('id_fiscal')
                    ->label('ID Fiscal')
                    ->required()
                    ->maxLength(10)
                    ->unique(ignoreRecord:true) //parámetro ignora el ID si se edita el mismo cliente.
                    ->validationAttribute('ID fiscal'),
                ])->columnSpan(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('persona.nombre')
                ->label('Nombre'),
                TextColumn::make('persona.direccion')
                ->label('Dirección')
                ->limit(50),
                TextColumn::make('persona.id_fiscal')
                ->label('ID fiscal'),           
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                /*
                Valida si cliente tiene asociado un proyecto antes de ser
                eliminado
                */
                Tables\Actions\DeleteAction::make()
                ->before(function ($record){
                    if(! $record->puedeSerEliminado()){
                        Notification::make()
                        ->title('No se puede eliminar el cliente')
                        ->body('Este cliente tiene proyectos asociados')
                        ->danger()
                        ->send();
                         // Cancela la eliminación
                        return false; 
                    }
                    //Borra cliente
                    $record->delete();
                     // Borra persona asociada 
                    $record->persona()->delete();
                    Notification::make()
                    ->title('Cliente eliminado')
                    ->success()
                    ->send();
                })
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateCliente::route('/create'),
            'edit' => Pages\EditCliente::route('/{record}/edit'),
        ];
    }
}
