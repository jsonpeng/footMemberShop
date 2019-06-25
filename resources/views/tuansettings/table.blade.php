<table class="table table-responsive" id="tuansettings-table">
    <thead>
        <tr>
            <th>Tuan Num</th>
        <th>Man Num</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tuansettings as $tuansetting)
        <tr>
            <td>{!! $tuansetting->tuan_num !!}</td>
            <td>{!! $tuansetting->man_num !!}</td>
            <td>
                {!! Form::open(['route' => ['tuansettings.destroy', $tuansetting->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('tuansettings.show', [$tuansetting->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('tuansettings.edit', [$tuansetting->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>