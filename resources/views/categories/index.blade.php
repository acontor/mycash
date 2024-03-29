@extends('layouts.app')

@section('content')
    <div id="content">
        <div class="m-3 mt-4 mb-5">
            @php
                $beforeType = '';
            @endphp
            <div class="row">
                @foreach ($categories as $category)
                    @if ($category->type !== $beforeType)
                        @if ($beforeType !== '')
                            <div class="col-3 mb-4 text-center text-white">
                                <a
                                    href="{{ route('categories.create', $category->type) }}"
                                    class="text-white text-decoration-none"
                                >
                                    <i class="bi bi-plus-circle-fill fs-1"></i>
                                    <p class="mt-1">
                                        Nueva
                                        <br>categoría
                                    </p>
                                </a>
                            </div>
                        @endif
                        <div class="col-12 mb-4">
                            <h3 class="text-white">{{ $category->type }}</h3>
                        </div>
                    @endif
                        <div class="col-3 mb-4 text-center">
                            <a
                                href="{{ route('categories.edit', $category->id) }}"
                                class="text-white text-decoration-none"
                            >
                                <i
                                    class="{{ $category->icon }} fs-1 px-2 py-1 rounded-2"
                                    style="background-color: {{ $category->color }};"
                                ></i>
                                <p class="mt-1">{{ $category->name }}</p>
                            </a>
                        </div>
                    @php
                        $beforeType = $category->type;
                    @endphp
                @endforeach
                <div class="col-3 mb-4 text-center text-white">
                    <a
                        href="{{ route('categories.create', $category->type) }}"
                        class="text-white text-decoration-none"
                    >
                        <i class="bi bi-plus-circle-fill fs-1"></i>
                        <p class="mt-1">
                            Nueva
                            <br>categoría
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
