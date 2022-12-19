<a class="text-decoration-none text-dark" href="{{ url()->current() }}?tab={{ request('tab') }}&cari={{ request('cari') }}&order={{ $order }}&urutan={{ request('urutan') == 'desc' ? 'asc' : 'desc' }}">
    <span>{{ $nama }}</span>
    @if (request('order') == $order)
        <i class="fas fa-sort-{{ request('urutan') == 'asc' ? 'down' : 'up' }}"></i>
    @endif
    @if (request('order') == '')
        <i class="fas fa-sort-down"></i>
    @endif
</a>
