@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h2>{{ __('Contact Methods Management') }}</h2>
            <!-- <a href="{{ route('admin.contact.create') }}" class="btn btn-primary">{{ __('Add New Contact Method') }}</a> -->
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
                        <th>{{ __('Icon') }}</th>
                        <th>{{ __('Title (EN)') }}</th>
                        <th>{{ __('Title (AR)') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contactMethods as $method)
                        <tr>
                            <td>{{ $method->order }}</td>
                            <td><i class="{{ $method->icon_class }}"></i> ({{ $method->icon_class }})</td>
                            <td>{{ $method->getTranslation('title', 'en') }}</td>
                            <td>{{ $method->getTranslation('title', 'ar') }}</td>
                            <td>
                                @if($method->is_active)
                                    <span class="badge badge-success"
                                        style="background-color: green; color: white; padding: 5px; border-radius: 5px;">{{ __('Active') }}</span>
                                @else
                                    <span class="badge badge-secondary"
                                        style="background-color: gray; color: white; padding: 5px; border-radius: 5px;">{{ __('Inactive') }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.contact.edit', $method->id) }}"
                                    class="btn btn-sm btn-info">{{ __('Edit') }}</a>
                                <form action="{{ route('admin.contact.destroy', $method->id) }}" method="POST"
                                    style="display: inline-block;" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection