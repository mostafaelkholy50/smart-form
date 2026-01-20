@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>{{ __('admin.add_link') }}</h2>
        </div>

        <form action="{{ route('admin.links.store') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="label_ar">{{ __('admin.link_label_ar') }}</label>
                    <input type="text" name="label_ar" id="label_ar" class="form-control" required
                        value="{{ old('label_ar') }}">
                </div>

                <div class="form-group">
                    <label for="label_en">{{ __('admin.link_label_en') }}</label>
                    <input type="text" name="label_en" id="label_en" class="form-control" required
                        value="{{ old('label_en') }}">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="url">{{ __('admin.link_url') }}</label>
                    <input type="text" name="url" id="url" class="form-control" required value="{{ old('url') }}">
                </div>

                <div class="form-group">
                    <label for="order">{{ __('admin.link_order') }}</label>
                    <input type="number" name="order" id="order" class="form-control" value="{{ old('order', 0) }}">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('admin.save') }}</button>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>{{ __('admin.link_settings') }}</h2>
        </div>

        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('admin.link_order') }}</th>
                        <th>{{ __('admin.link_label_ar') }}</th>
                        <th>{{ __('admin.link_label_en') }}</th>
                        <th>{{ __('admin.link_url') }}</th>
                        <th>{{ __('admin.link_active') }}</th>
                        <th>{{ __('admin.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($links as $link)
                        <tr>
                            <td>{{ $link->order }}</td>
                            <td>{{ $link->label_ar }}</td>
                            <td>{{ $link->label_en }}</td>
                            <td style="direction: ltr">{{ $link->url }}</td>
                            <td>
                                @if($link->is_active)
                                    <span style="color: green;">✔</span>
                                @else
                                    <span style="color: red;">✘</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 10px;">
                                    <!-- Edit Logic -->
                                    <button
                                        onclick="editLink({{ $link->id }}, '{{ $link->label_ar }}', '{{ $link->label_en }}', '{{ $link->url }}', {{ $link->order }}, {{ $link->is_active }})"
                                        class="btn btn-sm btn-primary">{{ __('admin.edit') }}</button>

                                    <form action="{{ route('admin.links.delete', $link) }}" method="POST"
                                        onsubmit="return confirm('{{ __('admin.confirm_delete') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">{{ __('admin.delete') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Modal (Simple implementation) -->
    <div id="editModal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000;">
        <div class="card" style="width: 500px; margin: 50px auto; max-width: 90%;">
            <div class="card-header">
                <h2>{{ __('admin.edit_link') }}</h2>
                <button onclick="closeEditModal()"
                    style="background: none; border: none; font-size: 20px; cursor: pointer;">&times;</button>
            </div>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>{{ __('admin.link_label_ar') }}</label>
                    <input type="text" name="label_ar" id="edit_label_ar" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>{{ __('admin.link_label_en') }}</label>
                    <input type="text" name="label_en" id="edit_label_en" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>{{ __('admin.link_url') }}</label>
                    <input type="text" name="url" id="edit_url" class="form-control" required>
                </div>

                <div style="display: flex; gap: 20px;">
                    <div class="form-group" style="flex: 1;">
                        <label>{{ __('admin.link_order') }}</label>
                        <input type="number" name="order" id="edit_order" class="form-control">
                    </div>

                    <div class="form-group" style="flex: 1; display: flex; align-items: center; padding-top: 25px;">
                        <input type="checkbox" name="is_active" id="edit_is_active" value="1">
                        <label for="edit_is_active" style="margin: 0 10px;">{{ __('admin.link_active') }}</label>
                    </div>
                </div>

                <div style="text-align: right; margin-top: 20px;">
                    <button type="button" onclick="closeEditModal()" class="btn"
                        style="background: #ccc;">{{ __('admin.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('admin.save') }}</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editLink(id, labelAr, labelEn, url, order, isActive) {
            document.getElementById('edit_label_ar').value = labelAr;
            document.getElementById('edit_label_en').value = labelEn;
            document.getElementById('edit_url').value = url;
            document.getElementById('edit_order').value = order;
            document.getElementById('edit_is_active').checked = isActive;

            document.getElementById('editForm').action = "{{ url('admin/links') }}/" + id;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
@endsection