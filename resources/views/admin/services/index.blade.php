@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h2>{{ __('Services Management') }}</h2>
            @if($services->count() < 3)
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary">{{ __('Add New Service') }}</a>
            @else
                <button class="btn btn-secondary" disabled
                    title="Maximum 3 services allowed">{{ __('Max Services Reached') }}</button>
            @endif
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
                        <th>{{ __('Page') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                        <tr>
                            <td>{{ $service->order }}</td>
                            <td>{{ $service->icon_class }}</td>
                            <td>{{ $service->getTranslation('title', 'en') }}</td>
                            <td>{{ $service->getTranslation('title', 'ar') }}</td>
                            <td>{{ $service->page ? $service->page->getTranslation('title', app()->getLocale()) : __('Global / Home') }}
                            </td>
                            <td>
                                @if($service->is_active)
                                    <span class="badge badge-success" style="color: green;">{{ __('Active') }}</span>
                                @else
                                    <span class="badge badge-danger" style="color: red;">{{ __('Inactive') }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.services.edit', $service->id) }}"
                                    class="btn btn-sm btn-info">{{ __('Edit') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection