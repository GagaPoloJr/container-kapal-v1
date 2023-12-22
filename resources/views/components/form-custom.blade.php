@props(['submit', 'typeSubmit' => null, 'csrf'=>null])

<div {{ $attributes->merge(['class' => 'container mt-4']) }}>
    <div class="row">
        <div class="col-md-12">
            <div class="mt-4">
                <form {{ $attributes }} @if(isset($submit)) wire:submit="{{ $submit }}" @endif @if($typeSubmit==='file' ) enctype='multipart/form-data' @endif>
                    @if(isset($csrf))
                    @csrf
                    @endif
                    <div class="card">
                        <div class="card-header d-block">
                            <h4 class="card-title">{{ $title }}</h4>
                            <p class="card-subtitle">{{ $description }}</p>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                {{ $form }}
                            </div>
                        </div>
                        @if (isset($actions))
                        <div class="mt-3 d-flex justify-content-start card-footer">
                            {{ $actions }}
                        </div>
                        @endif
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
