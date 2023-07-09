<div class="d-flex flex-column flex-md-row gap-4 align-items-center justify-content-center">
    <div class="list-group">
        @foreach($productSidebar as $key => $product)
        <a href="{{url(LaravelLocalization::getCurrentLocale() . '/product/'.$product->slug)}}"
            class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
            <img src="{{asset($product->productImages[0]->image)}}" alt="twbs" width="32" height="32"
                class="rounded-circle flex-shrink-0">
            <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                    <h4 class="mb-0">{{$product->productTranslations->first()->name}}</h4>
                    <p class="mb-0 opacity-75">
                        {{Str::limit(strip_tags($product->productTranslations->first()->description),50)}}</p>
                </div>
                {{-- <small class="opacity-50 text-nowrap">now</small> --}}
            </div>
        </a>
        @endforeach
    </div>
</div>