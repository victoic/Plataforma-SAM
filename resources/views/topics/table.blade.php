<table class="table table-responsive" id="topics-table">
    <thead>
        <th>Name</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($topics as $topic)
        <tr>
            <td>{!! $topic->name !!}</td>
            <td>{!! $topic->created_at !!}</td>
            <td>{!! $topic->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['topics.destroy', $topic->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('topics.show', [$topic->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('topics.edit', [$topic->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
