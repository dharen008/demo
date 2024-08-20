<?php

namespace App\Providers;

use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DeleteAction::configureUsing( function ( DeleteAction $deleteAction ): void {
            $deleteAction
                ->successNotificationTitle( 'Custom Title' )
                ->successNotification( fn () => dump( 'Custom Notification' ) )
                ->modalHeading( 'Custom heading' )
                ->modalDescription( 'Custom description' );
        } );

        RestoreAction::configureUsing( function ( RestoreAction $restoreAction ): void {
            $restoreAction
                ->successNotificationTitle( 'Custom Title' )
                ->successNotification( fn () => dump( 'Custom Notification' ) )
                ->modalHeading( 'Custom heading' )
                ->modalDescription( 'Custom description' );
        } );

        ForceDeleteAction::configureUsing( function ( ForceDeleteAction $forceDeleteAction ): void {
            $forceDeleteAction
                ->successNotificationTitle( 'Custom Title' )
                ->successNotification( fn () => dump( 'Custom Notification' ) )
                ->modalHeading( 'Custom heading' )
                ->modalDescription( 'Custom description' );
        } );

        AttachAction::configureUsing( function ( AttachAction $attachAction ): void {
            $attachAction
                ->successNotificationTitle( 'Custom Title' )
                ->successNotification( fn () => dump( 'Custom Notification' ) )
                ->modalHeading( 'Custom heading' )
                ->modalDescription( 'Custom description' );
        } );

        DetachAction::configureUsing( function ( DetachAction $detachAction ): void {
            $detachAction
                ->successNotificationTitle( 'Custom Title' )
                ->successNotification( fn () => dump( 'Custom Notification' ) )
                ->modalHeading( 'Custom heading' )
                ->modalDescription( 'Custom description' );
        } );

        DeleteBulkAction::configureUsing( function ( DeleteBulkAction $deleteBulkAction ): void {
            $deleteBulkAction
                ->successNotificationTitle( 'Custom Title' )
                ->successNotification( fn () => dump( 'Custom Notification' ) )
                ->modalHeading( 'Custom heading' )
                ->modalDescription( 'Custom description' );
        } );

        RestoreBulkAction::configureUsing( function ( RestoreBulkAction $restoreBulkAction ): void {
            $restoreBulkAction
                ->successNotificationTitle( 'Custom Title' )
                ->successNotification( fn () => dump( 'Custom Notification' ) )
                ->modalHeading( 'Custom heading' )
                ->modalDescription( 'Custom description' );
        } );

        ForceDeleteBulkAction::configureUsing( function ( ForceDeleteBulkAction $forceDeleteBulkAction ): void {
            $forceDeleteBulkAction
                ->successNotificationTitle( 'Custom Title' )
                ->successNotification( fn () => dump( 'Custom Notification' ) )
                ->modalHeading( 'Custom heading' )
                ->modalDescription( 'Custom description' );
        } );
    }
}
