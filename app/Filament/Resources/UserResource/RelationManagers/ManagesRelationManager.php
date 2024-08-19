<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource;
use Filament\Infolists\Infolist;
use Filament\Tables\Table;
use Filament\Tables;

class ManagesRelationManager extends RelationManager
{
	protected static string $relationship = 'manages';

	public function table( Table $table ): Table
	{
		return UserResource::table( $table )
			->recordTitleAttribute( 'name' )
			->headerActions( [
				Tables\Actions\AttachAction::make()
					->recordSelectOptionsQuery( function ( Builder $query ) {
						$userManages = $this->ownerRecord->manages->pluck( 'id' )->toArray();
						$userManages ? $query->whereNotIn( 'users.id', $userManages ) : null ;
					} )
					->preloadRecordSelect(),
			] )
			->filters( [
			] )
			->actions( [
				Tables\Actions\DetachAction::make(),
			] )
			->bulkActions( [
				Tables\Actions\BulkActionGroup::make( [
					Tables\Actions\DetachBulkAction::make(),
				] ),
			] );
	}

	public function infolist( Infolist $infolist ): Infolist
	{
		return UserResource::infolist( $infolist );
	}
}
