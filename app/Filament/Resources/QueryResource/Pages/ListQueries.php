<?php

namespace App\Filament\Resources\QueryResource\Pages;

use App\Models\Query;
use Filament\Pages\Actions;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\QueryResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListQueries extends ListRecords
{
    protected static string $resource = QueryResource::class;

    protected function getTableQuery(): Builder
    {
       /* return Query::query()->latest();*/
        $role = Auth::user()->roles()->first();

        if(Auth::check() && $role->name === 'user')
        {
            return parent::getTableQuery()->where('user_id', auth()->id())->latest();
        }

        else
        {
            return parent::getTableQuery()->latest();
        }

    }
     //OR
    //  public static function getEloquentQuery(): Builder
    //  {
    //      return parent::getEloquentQuery()->withoutGlobalScopes([ActiveScope::class]);
    //  }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }


}
