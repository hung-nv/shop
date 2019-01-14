<table class="table table-striped table-bordered table-hover table-checkable order-column"
       id="datatable-advertising">
    <thead>
    <tr>
        <th> ID</th>
        <th> Name</th>
        <th> Content</th>
        <th> Actions</th>
    </tr>
    </thead>
    <tbody>

    @if(!empty($data))
        @foreach($data as $i)

            <tr class="odd gradeX">
                <td>{{ $i->id }}</td>
                <td>{{ $i->name }}</td>
                <td>{{ $i->content }}</td>
                <td>
                    <form action="{{ route('advertising.destroy', $i->id) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <a href="{{ route('advertising.edit', ['advertising' => $i->id]) }}"
                           class="btn red btn-sm">Update</a>
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