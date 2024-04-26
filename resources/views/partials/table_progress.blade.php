@foreach ($ticketProgress as $ticket)
    @if ($ticket->status == 'Progress')
        <tr>
            <td>
                {{ $ticket->user ? ($ticket->user->is_premium ? 'Yes' : 'No') : 'N/A' }}
            </td>
            <td>{{ $ticket->name_user }}</td>
            <td>{{ $ticket->name_tech }}</td>
            <td>{{ $ticket->subject }}</td>
            <td>
                <label class="badge badge-gradient-warning">{{ $ticket->status }}</label>
            </td>
            <td>{{ $ticket->created_at->format('Y-m-d') }}</td>
            <td>{{ $ticket->ticket_id }}</td>
        </tr>
    @endif
@endforeach
