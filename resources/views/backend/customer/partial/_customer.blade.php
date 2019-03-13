<table class="table table-striped table-bordered table-hover table-checkable order-column"
       id="datatable-customer">
    <thead>
    <tr>
        <th>
            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                <input type="checkbox" class="group-checkable" v-on:click="selectAllCustomer" />
                <span></span>
            </label>
        </th>
        <th> ID</th>
        <th> Email</th>
        <th> Name</th>
        <th> Mobile</th>
        <th> Actions</th>
    </tr>
    </thead>
    <tbody>

    @if(!empty($customers))
        @foreach($customers as $i)

            <tr class="odd gradeX">
                <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" v-model="idsCustomer" value="{{ $i->id }}" />
                        <span></span>
                    </label>
                </td>
                <td> {{ $i->id }}</td>
                <td>{{ $i->email }}</td>
                <td>{{ $i->name }}</td>
                <td>{{ $i->mobile }}</td>
                <td>
                    <form action="{{ route('customer.destroy', $i->id) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="button" class="btn red btn-sm"
                                v-on:click="confirmBeforeDelete">Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>