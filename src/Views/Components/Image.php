<?php

namespace HypernosTechnology\LaravelBlurImagePlaceholder\Views\Components;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class Image extends Component
{
    public Model $model;

    public array $extraAttributes = [];

    public function __construct(Model $model, $extraAttributes = [])
    {
        $this->model = $model;
        $this->extraAttributes = $extraAttributes;

        if (!($model instanceof HasBlurImagePlaceholder)) {
            throw new \Exception('Model does not implement HasBlurImagePlaceholder interface.');
        }
    }

    public function render()
    {
        return view('blurplaceholder::components.image-tag');
    }
}