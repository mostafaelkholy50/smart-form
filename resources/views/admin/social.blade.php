@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>{{ __('admin.social_add_link') ?? 'Add Social Link' }}</h2>
        </div>

        <form action="{{ route('admin.social.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="platform">{{ __('admin.social_platform') ?? 'Platform' }}</label>
                <select name="platform" id="platform" class="form-control" required>
                    <option value="" disabled selected>{{ __('admin.social_select_platform') ?? 'Select Platform' }}
                    </option>
                    <option value="facebook">Facebook</option>
                    <option value="twitter">Twitter</option>
                    <option value="youtube">YouTube</option>
                    <option value="rss">RSS</option>
                    <option value="instagram">Instagram</option>
                    <option value="linkedin">LinkedIn</option>
                    <option value="tiktok">TikTok</option>
                </select>
            </div>

            <div class="form-group">
                <label for="url">{{ __('admin.link_url') }}</label>
                <input type="text" name="url" id="url" class="form-control" required placeholder="https://..."
                    value="{{ old('url') }}">
            </div>

            <button type="submit" class="btn btn-primary">{{ __('admin.save') }}</button>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>{{ __('admin.social_links') ?? 'Social Media Links' }}</h2>
        </div>

        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('admin.social_platform') ?? 'Platform' }}</th>
                        <th>{{ __('admin.link_url') }}</th>
                        <th>{{ __('admin.link_active') }}</th>
                        <th>{{ __('admin.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($links as $link)
                        <tr>
                            <td>
                                <span style="text-transform: capitalize;">{{ $link->platform }}</span>
                            </td>
                            <td style="direction: ltr"><a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a></td>
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
                                        onclick="editSocialLink({{ $link->id }}, '{{ $link->url }}', {{ $link->is_active }})"
                                        class="btn btn-sm btn-primary">{{ __('admin.edit') }}</button>

                                    <form action="{{ route('admin.social.delete', $link) }}" method="POST"
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

    <!-- Edit Modal -->
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
                    <label>{{ __('admin.link_url') }}</label>
                    <input type="text" name="url" id="edit_url" class="form-control" required>
                </div>

                <div class="form-group" style="display: flex; align-items: center;">
                    <input type="checkbox" name="is_active" id="edit_is_active" value="1">
                    <label for="edit_is_active" style="margin: 0 10px;">{{ __('admin.link_active') }}</label>
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
        function editSocialLink(id, url, isActive) {
            document.getElementById('edit_url').value = url;
            document.getElementById('edit_is_active').checked = isActive;

            document.getElementById('editForm').action = "{{ url('admin/social') }}/" + id;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
@endsection