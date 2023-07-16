<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserProfileResource\Pages;
use App\Filament\Resources\UserProfileResource\RelationManagers;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\UserProfile;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserProfileResource extends Resource
{
    protected static ?string $model = UserProfile::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                card::make()
                    ->schema([
                Forms\Components\TextInput::make('contact'),
//                Select::make('user_id')->label('User Name')->placeholder('Select a User')
//                    ->preload()
//                    ->autofocus()
//                    ->relationship('userprofiles', 'name')
//                    ->required(),
                Select::make('campus_id')->label('Campus Name')->placeholder('Select a Campus')
                    ->preload()
                    ->autofocus()
                    ->relationship('campprofiles', 'campus_name')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set) => $set('faculty_id', null)),

                Select::make('faculty_id')->label('Faculty Name')->placeholder('Select a Faculty')
                    ->preload()
                    ->required()
                    ->reactive()
                    ->options(function (callable $get)
                    {
                        $campus = ($get('campus_id'));
                        if ($campus) {
                            return Faculty::where('campus_id', $campus)->pluck('faculty_name', 'id')->toArray();
                        }

                    })
                    ->afterStateUpdated(fn(callable $set) => $set('department_id', null)),
                Select::make('department_id')->label('Department Name')
                    ->preload()
                    ->required()
                    ->reactive()
                    ->options(function (callable $get)
                    {
                        $faculty = ($get('faculty_id'));
                        if ($faculty) {
                            return Department::where('faculty_id', $faculty)->pluck('department_name', 'id');
                        }

                    }),
                    ])->inlineLabel('Campus, Faculty and Department'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('contact')->label('User Contact'),
                // TextColumn::make('userprofiles.name')->label('User Name'),
                TextColumn::make('campprofiles.campus_name')->label('Campus Name'),
                TextColumn::make('facprofiles.faculty_name')->label('Faculty Name'),
                TextColumn::make('departprofiles.department_name')->label('Department Name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserProfiles::route('/'),
            'create' => Pages\CreateUserProfile::route('/create'),
            'edit' => Pages\EditUserProfile::route('/{record}/edit'),
        ];
    }


}
