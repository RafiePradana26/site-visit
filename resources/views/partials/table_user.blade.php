    @foreach ($tickets as $ticket)
        <tr>
            <td>
                {{ $ticket->name_tech }}
            </td>
            <td>{{ $ticket->subject }}</td>
            <td>
                <label class="card-description badge badge- text-black">
                    @switch($ticket->status)
                        @case('Open')
                            <label class="badge badge-info">Open</label>
                        @break

                        @case('Progress')
                            <label class="badge badge-warning">Progress</label>
                        @break

                        @case('Pending')
                            <label class="badge badge-danger">Pending</label>
                        @break

                        @case('Solved')
                            <label class="badge badge-success">Solved</label>
                        @break
                        @case('onhold')
                            <label class="badge badge-danger">On Hold</label>
                        @break
                        @default
                            <label class="badge badge-secondary">Unknown</label>
                    @endswitch
                </label>
            </td>
            <td>{{ $ticket->created_at }}</td>
            <td>{{ $ticket->ticket_id }}</td>
            <td>
                <a href="{{ route('detail_ticket_user.edit', ['id' => $ticket->id]) }}"
                    class="btn btn-info bg-gradient-info">
                    <span class="mdi mdi-details"></span>
                </a>
            </td>
        </tr>
    @endforeach
