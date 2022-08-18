<table class="table table-responsive" id="exercises-table">
    <thead>
        <th>Enunciado</th>
        <th>Tópico</th>
        <th>Tipo</th>
        <th>Criado em</th>
        <th>Atualizado em</th>
        <th>Id da atividade</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($exercises as $exercise)
        <tr>
            <td>{!! $exercise->stem !!}</td>
            <td>{!! $exercise->topic !!}</td>
            <td>{!! $exercise->type !!}</td>
            <td>{!! $exercise->created_at !!}</td>
            <td>{!! $exercise->updated_at !!}</td>
            <td>{!! $exercise->id_activity !!}</td>
            <td>
                {!! Form::open(['route' => ['exercises.destroy', $exercise->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('exercises.show', [$exercise->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('exercises.edit', [$exercise->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Tem certeza?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
