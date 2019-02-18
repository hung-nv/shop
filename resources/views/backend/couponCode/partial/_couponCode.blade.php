<table class="table table-striped table-bordered table-hover table-checkable order-column" id="datatable-coupon-code">
    <thead>
    <tr>
        <th> ID</th>
        <th> Code</th>
        <th> % sale off</th>
        <th> Available Time</th>
        <th> Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($couponCodes as $couponCode)
        <tr>
            <td>{{ $couponCode->id }}</td>
            <td>{{ $couponCode->code }}</td>
            <td>{{ $couponCode->value }} %</td>
            <td>{{ $couponCode->start_date.' to '.$couponCode->end_date }}</td>
            <td>
                <form action="{{ route('couponCode.destroy', $couponCode->id) }}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <a href="{{ route('couponCode.edit', ['couponCode' => $couponCode->id]) }}"
                       class="btn red btn-sm">Update</a>
                    <button type="button" class="btn red btn-sm"
                            v-on:click="confirmBeforeDelete">Delete
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>