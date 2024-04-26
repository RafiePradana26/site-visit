
    @foreach ($users as $user)
        @if ($user->role === 'tech_person')
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->case_total }}</td>
                <td>
                    @switch($user->status)
                        @case(0)
                            <label class="badge badge-success">Free</label>
                        @break

                        @case(1)
                            <label class="badge badge-info">Working</label>
                        @break

                        @case(2)
                            <label class="badge badge-warning">Busy</label>
                        @break

                        @case(3)
                            <label class="badge badge-danger">Overload</label>
                        @break

                        @default
                            <label class="badge badge-secondary">Unknown</label>
                    @endswitch
                </td>
                <td>
                    <form action="{{ route('assign.ticket', ['ticket' => $ticket->id]) }}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-sm btn-primary">
                            Assign
                        </button>
                    </form>
                </td>
            </tr>
        @endif
    @endforeach
