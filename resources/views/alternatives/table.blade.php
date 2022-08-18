<table class="table table-responsive" id="alternatives-table">
    <thead>
        <th>Enunciado</th>
        <th>Correta</th>
        <th>Criado em</th>
        <th>Atualizado em</th>
        <th>Id do exercício</th>
        <th colspan="3">Ação</th>
    </thead>
    <tbody>
    @foreach($alternatives as $alternative)
        <tr>
            <td>{!! $alternative->text !!}</td>
            <td>{!! $alternative->right !!}</td>
            <td>{!! $alternative->created_at !!}</td>
            <td>{!! $alternative->updated_at !!}</td>
            <td>{!! $alternative->id_exercise !!}</td>
            <td>
                {!! Form::open(['route' => ['alternatives.destroy', $alternative->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('alternatives.show', [$alternative->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('alternatives.edit', [$alternative->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Tem certeza?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
