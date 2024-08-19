<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HolidayResource\Pages;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Components\DatePicker;
use App\Extended\Forms\Fields\NameInput;
use Filament\Tables\Columns\TextColumn;
use App\Models\Settings\Holiday;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Tables;

class HolidayResource extends Resource
{
	protected static ?string $model             = Holiday::class;
	protected static ?string $navigationIcon    = 'heroicon-o-calendar-days';
	protected static ?string $navigationGroup	= 'Settings';

	public static function form( Form $form ): Form
	{
		return $form
			->schema( [
				TextInput::make( 'name' )
					->maxLength( 100 )
					->minLength( 2 )
					->required(),
				DatePicker::make( 'date' )
					->native( false )
					->required(),
			] );
	}

	public static function table( Table $table ): Table
	{
		return $table
			->columns( [
				TextColumn::make( 'name' )
					->searchable(),
				TextColumn::make( 'date' )
					->date(),
			] )
			->filters( [
			] )
			->actions( [
				Tables\Actions\ViewAction::make(),
				Tables\Actions\ActionGroup::make( [
					Tables\Actions\EditAction::make(),
					Tables\Actions\DeleteAction::make(),
				] )
			] )
			->bulkActions( [
				Tables\Actions\DeleteBulkAction::make()
			] )
			->defaultSort( 'date' )
			->paginated( false );
	}

	public static function getPages(): array
	{
		return [
			'index' => Pages\ManageHolidays::route('/'),
		];
	}

}
