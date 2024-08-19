<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource;
use Filament\Infolists\Infolist;
use Filament\Tables\Table;
use Filament\Tables;

class ManageByRelationManager extends RelationManager
{
	protected static string $relationship = 'manageBy';

	public function table( Table $table ): Table
	{
		return UserResource::table( $table )
			->heading( 'Who manage(s) ' . ( $this->ownerRecord->nickname ?? $this->ownerRecord->first_name ) )
			->recordTitleAttribute( 'name' )
			->headerActions( [
				Tables\Actions\AttachAction::make()
					->recordSelectOptionsQuery( function ( Builder $query ) {
						$userManagedBy = $this->ownerRecord->manageBy->pluck( 'id' )->toArray();
						$userManagedBy ? $query->whereNotIn( 'users.id', $userManagedBy ) : null ;
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
