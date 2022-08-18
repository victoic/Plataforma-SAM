<table class="table table-responsive" id="contacts-table">
    <thead>
        <th>Message</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Id User</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($contacts as $contact)
        <tr>
            <td>{!! $contact->message !!}</td>
            <td>{!! $contact->created_at !!}</td>
            <td>{!! $contact->updated_at !!}</td>
            <td>{!! $contact->id_user !!}</td>
            <td>
                {!! Form::open(['route' => ['contacts.destroy', $contact->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('contacts.show', [$contact->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('contacts.edit', [$contact->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
