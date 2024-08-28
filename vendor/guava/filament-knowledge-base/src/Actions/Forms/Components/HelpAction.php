<?php

namespace Guava\FilamentKnowledgeBase\Actions\Forms\Components;

use Filament\Facades\Filament;
use Filament\Forms\Components\Actions\Action;
use Guava\FilamentKnowledgeBase\Contracts\Documentable;
use Guava\FilamentKnowledgeBase\Facades\KnowledgeBase;
use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;

class HelpAction extends Action
{
    protected static function getContentView(Documentable $documentable): HtmlString
    {
        $html = $documentable->getSimpleHtml();
        $articleClass = KnowledgeBase::panel()->getArticleClass();

        $classes = Arr::toCssClasses([
            'gu-kb-article-modal',
            $articleClass => ! empty($articleClass),
        ]);

        $replacementStringId = \Str::random();

        $parsed = \Blade::render(<<<blade
<x-filament-knowledge-base::content class="$classes">
$replacementStringId
</x-filament-knowledge-base::content>
blade);

        return new HtmlString(\Str::replace($replacementStringId, $html, $parsed));
    }

    public static function forDocumentable(Documentable | string $documentable): static
    {
        $documentable = KnowledgeBase::documentable($documentable);

        return static::make("help.{$documentable->getId()}")
            ->label($documentable->getTitle())
//            ->icon($documentable->getIcon())
            ->icon('heroicon-o-question-mark-circle')
            ->when(
                Filament::getPlugin('guava::filament-knowledge-base')->hasModalPreviews(),
                fn (HelpAction $action) => $action
                    ->modalContent(fn () => static::getContentView($documentable))
                    ->modalHeading($documentable->getTitle())
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel(__('filament-knowledge-base::translations.close'))
                    ->when(
                        Filament::getPlugin('guava::filament-knowledge-base')->hasSlideOverPreviews(),
                        fn (HelpAction $action) => $action->slideOver()
                    ),
                fn (HelpAction $action) => $action->url($documentable->getUrl())
            )
        ;
    }
}
