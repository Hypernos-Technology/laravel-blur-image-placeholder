<div class="blur-image-placeholder"
     style="{{ "background-image: url('" . asset('storage/caches/' . $model->imagePath) . "')" }}">
    <img data-src="{{ asset('storage/' . $model->imagePath) }}"
         @if(isset($extraAttributes['alt'])) alt="{{ $extraAttributes['alt'] }}" @endif
         @if(isset($extraAttributes['class'])) class="{{ $extraAttributes['class'] }}" @endif
    >
</div>