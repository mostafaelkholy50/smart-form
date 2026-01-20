@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h2>{{ __('Pages Management') }}</h2>
            <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">{{ __('Add New Page') }}</a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success"
                    style="padding: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('Order') }}</th>
                        <th>{{ __('Title (EN)') }}</th>
                        <th>{{ __('Title (AR)') }}</th>
                        <th>{{ __('Slug') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td>{{ $page->order }}</td>
                            <td>{{ $page->getTranslation('title', 'en') }}</td>
                            <td>{{ $page->getTranslation('title', 'ar') }}</td>
                            <td>{{ $page->getTranslation('slug', app()->getLocale()) }}</td>
                            <td>
                                @if($page->is_active)
                                    <span class="badge badge-success" style="color: green;">{{ __('Active') }}</span>
                                @else
                                    <span class="badge badge-danger" style="color: red;">{{ __('Inactive') }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.pages.edit', $page->id) }}"
                                    class="btn btn-sm btn-info">{{ __('Edit') }}</a>
                                <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">{{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection