<!-- resources/views/vendor/pagination/custom.blade.php -->
@if ($paginator->hasPages())
    <nav class="pagination-container">
        <ul class="pagination">
            {{-- Botão Anterior --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&laquo; Anterior</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; Anterior</a>
                </li>
            @endif

            {{-- Links de Páginas --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array de Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Botão Próximo --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Próximo &raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Próximo &raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif