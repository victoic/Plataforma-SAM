<table class="table table-responsive" id="students-table">
    <thead>
        <th>Id User</th>
        <th>Id Current Adventure</th>
        <th>Id Current Module</th>
        <th>Id Current Activity</th>
        <th>Adventure Ended</th>
        <th>Id Weakest Module</th>
        <th>Id Weakest Activity</th>
        <th>Id Teacher</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($students as $student)
        <tr>
            <td>{!! $student->id_user !!}</td>
            <td>{!! $student->id_current_adventure !!}</td>
            <td>{!! $student->id_current_module !!}</td>
            <td>{!! $student->id_current_activity !!}</td>
            <td>{!! $student->adventure_ended !!}</td>
            <td>{!! $student->id_weakest_module !!}</td>
            <td>{!! $student->id_weakest_activity !!}</td>
            <td>{!! $student->id_teacher !!}</td>
            <td>{!! $student->created_at !!}</td>
            <td>{!! $student->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['students.destroy', $student->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('students.show', [$student->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('students.edit', [$student->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
