@if($paginator->hasPages())
<nav class="pagination" aria-label="Pagination">
    <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" @disabled($paginator->onFirstPage())><x-grei.icon name="arrow-left" /><span>Previous</span></button>
    <span aria-live="polite">Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}</span>
    <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" @disabled(!$paginator->hasMorePages())><span>Next</span><x-grei.icon name="arrow-right" /></button>
</nav>
@endif
