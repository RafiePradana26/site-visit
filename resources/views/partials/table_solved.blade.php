@foreach ($ticketSolved as $t)
    @if ($t->status == 'Solved')
        <tr>
            <td>
                {{ $t->user ? ($t->user->is_premium ? 'Yes' : 'No') : 'N/A' }}
            </td>
            <td>{{ $t->name_user }}</td>
            <td>{{ $t->name_tech }}</td>
            <td>{{ $t->subject }}</td>
            <td>
                <label class="badge badge-gradient-success">{{ $t->status }}</label>
            </td>
            <td>{{ $t->created_at->format('Y-m-d') }}</td>
            <td>{{ $t->ticket_id }}</td>
        </tr>
    @endif
@endforeach
