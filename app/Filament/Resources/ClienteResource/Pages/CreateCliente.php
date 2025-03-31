<?php

namespace App\Filament\Resources\ClienteResource\Pages;

use App\Filament\Resources\ClienteResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Persona;
use App\Models\Cliente;

class CreateCliente extends CreateRecord
{
    protected static string $resource = ClienteResource::class;
    
}
