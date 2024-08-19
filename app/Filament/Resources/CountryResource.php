<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\RelationManagers;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CountryResource\Pages;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use App\Models\Country\Country;
use Illuminate\Support\Str;
use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Tables;

class CountryResource extends Resource
{
	protected static ?string $model				= Country::class;
	protected static ?string $navigationIcon	= 'heroicon-o-globe-americas';
	protected static ?string $navigationGroup	= 'Settings';


	public static function form( Form $form ): Form
	{
		return $form
			->schema( [
				Section::make()
					->schema( [
						TextInput::make( 'name' )
							->afterStateUpdated( fn ( Set $set, ?string $state ) => $set( 'slug', Str::slug( $state ) ) )
							->unique( ignoreRecord: true )
							->live( onBlur: true )
							->maxLength( 100 )
							->columnSpan( 3 )
							->minLength( 2 )
							->required(),
						TextInput::make( 'slug' )
							->afterStateUpdated( fn ( Set $set, ?string $state ) => $set( 'slug', Str::slug( $state ) ) )
							->unique( ignoreRecord: true )
							->maxLength( 100 )
							->columnSpan( 3 )
							->minLength( 2 )
							->required(),
						TextInput::make( 'code' )
							->unique( ignoreRecord: true )
							->label( 'Country Code' )
							->minLength( 2 )
							->maxLength( 5 ),
						TextInput::make( 'phone_code' )
							->unique( ignoreRecord: true )
							->minLength( 1 )
							->integer(),
					] )
					->columns( 8 ),
			] );
	}

	public static function table( Table $table ): Table
	{
		return $table
			->modifyQueryUsing( fn ( $query ) => $query->withCount( 'states' ) )
			->columns( [
				TextColumn::make( 'name' )
					->description( fn ( Country $record ): string => $record->slug )
					->searchable()
					->sortable(),
				TextColumn::make( 'code' ),
				TextColumn::make( 'phone_code' ),
				TextColumn::make( 'states_count' )
					->sortable(),
			] )
			->filters( [
				Tables\Filters\TrashedFilter::make(),
			] )
			->actions( [
				Tables\Actions\ActionGroup::make( [
					Tables\Actions\EditAction::make(),
					Tables\Actions\DeleteAction::make(),
					Tables\Actions\RestoreAction::make(),
					Tables\Actions\ForceDeleteAction::make(),
				] ),
			] )
			->bulkActions( [
				Tables\Actions\ForceDeleteBulkAction::make(),
				Tables\Actions\RestoreBulkAction::make(),
				Tables\Actions\DeleteBulkAction::make(),
			] )
			->defaultSort( 'name' )
			->paginated( false );
	}

	public static function getEloquentQuery(): Builder
	{
		return parent::getEloquentQuery()
			->withoutGlobalScopes( [
				SoftDeletingScope::class,
			] );
	}

	public static function getRelations(): array
	{
		return [
			RelationManagers\StatesRelationManager::class,
		];
	}

	public static function getPages(): array
	{
		return [
			'edit'		=> Pages\EditCountry::route('/{record}/edit'),
			'create'	=> Pages\CreateCountry::route('/create'),
			'index'		=> Pages\ListCountries::route('/'),
		];
	}
}
