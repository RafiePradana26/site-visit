{{-- @yield('scripts') --}}
{{-- <head>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head> --}}


@foreach ($ticket as $t)
    @if ($t->status == 'Open')
        <tr class="{{ $t->user && $t->user->is_premium ? 'premium-row' : '' }}">
            <td>
                {{ $t->user ? ($t->user->is_premium ? 'Yes' : 'No') : 'N/A' }}
            </td>
            <td>
                {{ $t->user ? $t->user->name : 'N/A' }}
            </td>
            <td>{{ $t->subject }}</td>
            <td>
                <label class="badge badge-gradient-info">{{ $t->status }}</label>
            </td>
            <td>{{ $t->created_at->format('Y-m-d') }}</td>
            <td>{{ $t->ticket_id }}</td>
            <td>
                <button class="btn btn-primary btn-sm mdi-24px text-white"
                    onclick="window.location.href='{{ route('admin_ticket_detail.edit', ['id' => $t->id]) }}'">
                    Info
                </button>
            </td>
        </tr>
    @endif
@endforeach



{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    setInterval(function() {
        location.href = "{{ route('refresh.table') }}";
    }, 1000);

    setInterval(function() {
        location.href = "{{ route('refresh.table_progress') }}";
    }, 1000);

    setInterval(function() {
        location.href = "{{ route('refresh.table_pending') }}";
    }, 1000);

    setInterval(function() {
        location.href = "{{ route('refresh.table_solved') }}";
    }, 1000);
</script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#openTable').DataTable();
    });
</script> --}}
