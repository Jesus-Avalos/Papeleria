<div class="container-fluid">
    <div class="row px-3 justify-content-center">
        @foreach ($acciones as $item)
            <div class="col col-md-3 mb-3">
                <div class="card text-center">
                    <a href="/{{ strtolower($item) }}">
                        <img src="{{ asset('storage/iconos/icono-'.strtolower($item).'.png') }}" alt="Image 1" 
                        class="card-img-top rounded mx-auto d-block py-1" 
                        style="width: 200px; height: 200px;">
                    </a>
                    <div class="card-body bg-info py-2 text-white text-center">
                        {{ $item }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>