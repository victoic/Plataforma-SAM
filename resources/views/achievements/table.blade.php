<table class="table table-responsive" id="achievements-table">
    <thead>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Pontos</th>
        <th>Criado em</th>
        <th>Atualizado em</th>
        <th>Ícone</th>
        <th colspan="3">Ação</th>
    </thead>
    <tbody>
    @foreach($achievements as $achievement)
        <tr>
            <td>{!! $achievement->name !!}</td>
            <td>{!! $achievement->description !!}</td>
            <td>{!! $achievement->points !!}</td>
            <td>{!! $achievement->created_at !!}</td>
            <td>{!! $achievement->updated_at !!}</td>
            <td>{!! $achievement->icon !!}</td>
            <td>
                {!! Form::open(['route' => ['achievements.destroy', $achievement->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('achievements.show', [$achievement->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('achievements.edit', [$achievement->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Tem certeza?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
