<table class="table table-responsive" id="users-table">
    <thead>
        <th>Nome</th>
        <th>Data de nascimento</th>
        <th>Tempo ativo</th>
        <th>Email</th>
        <th>É professor</th>
        <th>Senha</th>
        <th>Pontos</th>
        <th>Criado em</th>
        <th>Atualizado em</th>
        <th>Id da aventura atual</th>
        <th>Id da atividade desbloqueada</th>
        <th colspan="3">Ação</th>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{!! $user->name !!}</td>
            <td>{!! $user->birth_date !!}</td>
            <td>{!! $user->active_time !!}</td>
            <td>{!! $user->email !!}</td>
            @if ($user->teacher)
            <td>Sim</td>
            @else
            <td>Não</td>
            @endif
            <td>{!! $user->password !!}</td>
            <td>{!! $user->points !!}</td>
            <td>{!! $user->created_at !!}</td>
            <td>{!! $user->updated_at !!}</td>
            <td>{!! $user->id_adventure !!}</td>
            <td>{!! $user->id_unlocked_activity !!}</td>
            <td>
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Tem certeza?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
