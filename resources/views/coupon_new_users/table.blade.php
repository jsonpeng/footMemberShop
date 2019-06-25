<table class="table table-responsive" id="couponNewUsers-table">
    <thead>
        <tr>
            <th>New Open</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($couponNewUsers as $couponNewUser)
        <tr>
            <td>{!! $couponNewUser->new_open !!}</td>
            <td>
                {!! Form::open(['route' => ['couponNewUsers.destroy', $couponNewUser->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('couponNewUsers.show', [$couponNewUser->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('couponNewUsers.edit', [$couponNewUser->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>