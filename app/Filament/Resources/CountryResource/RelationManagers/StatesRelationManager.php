<?php

namespace App\Filament\Resources\CountryResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Str;
use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Tables;

class StatesRelationManager extends RelationManager
{
	protected static string $relationship = 'states';

	public function form( Form $form ): Form
	{
		return $form
			->schema( [
				TextInput::make( 'name' )
                    ->afterStateUpdated( fn ( Set $set, ?string $state ) => $set( 'slug', Str::slug( $state ) ) )
					->unique( modifyRuleUsing: function ( Unique $rule ) {
						return $rule->where( 'country_id', $this->getOwnerRecord()->id );
					}, ignoreRecord: true )
                    ->live( onBlur: true )
					->maxLength( 100 )
                    ->minLength( 2 )
					->required(),
				TextInput::make( 'slug' )
                    ->afterStateUpdated( fn ( Set $set, ?string $state ) => $set( 'slug', Str::slug( $state ) ) )
					->unique( modifyRuleUsing: function ( Unique $rule ) {
						return $rule->where( 'country_id', $this->getOwnerRecord()->id );
					}, ignoreRecord: true )
					->maxLength( 100 )
					->minLength( 2 )
					->required(),
			] );
	}

	public function table( Table $table ): Table
	{
		return $table
			->recordTitleAttribute( 'name' )
			->columns( [
				TextColumn::make( 'name' )
					->searchable()
					->sortable(),
				TextColumn::make( 'slug' ),
			] )
			->defaultSort( 'name' )
			->filters( [
				Tables\Filters\TrashedFilter::make(),
			] )
			->headerActions( [
				Tables\Actions\CreateAction::make(),
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
				Tables\Actions\BulkActionGroup::make( [
					Tables\Actions\DeleteBulkAction::make(),
				] ),
			] )
			->modifyQueryUsing( fn ( Builder $query ) => $query->withoutGlobalScopes( [
				SoftDeletingScope::class,
			] ) );
	}
}
