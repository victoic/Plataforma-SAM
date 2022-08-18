<table class="table table-responsive" id="teachers-table">
    <thead>
        <th>Id User</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($teachers as $teacher)
        <tr>
            <td>{!! $teacher->id_user !!}</td>
            <td>{!! $teacher->created_at !!}</td>
            <td>{!! $teacher->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['teachers.destroy', $teacher->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('teachers.show', [$teacher->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('teachers.edit', [$teacher->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
