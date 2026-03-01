@extends('layout.admin')
@section('content')
    <a href="{{ route('create_category') }}">Create Category</a>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>ParentId</th>
                <th>Active</th>
                <th>Delete</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorys as $category)
                <tr>
                    <td>{{ $category['id'] }}</td>
                    <td>{{ $category['name'] }}</td>
                    <td>{{ $category['description'] }}</td>
                    <td>{{ $category['image'] }}</td>
                    <td>{{ $category['parent_id'] }}</td>
                    <td class="text-center">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input toggle-active" id="active_{{ $category['id'] }}"
                                data-id="{{ $category['id'] }}" {{ $category['is_active'] == 1 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="active_{{ $category['id'] }}"></label>
                        </div>
                    </td>

                    <td>{{ $category['is_delete'] == 1 ? 'Deleted' : 'Not Deleted' }}</td>
                    <td><a href="{{ route('edit_category', $category['id']) }}">Edit</a>
                        <a href="{{ route('delete_category', $category['id']) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.toggle-active').on('change', function () {
                var categoryId = $(this).data('id');
                var url = "{{ url('category/active') }}/" + categoryId;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT'
                    },
                    success: function (response) {
                        if (response.success) {
                            console.log('Category active status updated successfully');
                        }
                    },
                    error: function (xhr) {
                        console.error('Error updating category status', xhr.responseText);
                        var checkbox = $('#active_' + categoryId);
                        checkbox.prop('checked', !checkbox.prop('checked'));
                        alert('Có lỗi xảy ra, vui lòng thử lại!');
                    }
                });
            });
        });
    </script>
@endpush