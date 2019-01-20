<table class="table table-striped table-bordered table-hover table-checkable order-column"
       id="datatable-comment">
    <thead>
    <tr>
        <th> ID</th>
        <th> Name</th>
        <th style="width: 60%;"> Content</th>
        <th> Actions</th>
    </tr>
    </thead>
    <tbody>

    @if(!empty($comments))
        @foreach($comments as $i)

            <tr class="odd gradeX">
                <td> {{ $i->id }}</td>
                <td>{{ $i->name }}</td>
                <td>{{ $i->content }}</td>
                <td>
                    <form action="{{ route('comment.destroy', $i->id) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <a href="{{ route('comment.edit', ['user' => $i->id]) }}"
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