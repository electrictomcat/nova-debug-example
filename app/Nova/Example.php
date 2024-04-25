<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Example extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Example>
     */
    public static $model = \App\Models\Example::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $baseFields = [
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->dependsOn(
                    attributes: ['category'],
                    mixin: function (
                        Text $field,
                        NovaRequest $request,
                        FormData $formData
                    ) {
                        ray($formData);
                    })
                ->rules('required', 'max:255'),

            Text::make('Category', 'category')
                ->sortable(),
        ];

        ray(data_get($request, 'category'));

        if(!is_null(data_get($request, 'category')))
        {
            return array_merge($baseFields, [
                Text::make('Option'),
            ]);
        }

        return $baseFields;
    }
}
