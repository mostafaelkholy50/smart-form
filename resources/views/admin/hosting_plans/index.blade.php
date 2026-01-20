@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>{{ __('Hosting Plans Management') }}</h2>
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
                        <th>{{ __('Key') }}</th>
                        <th>{{ __('Name (EN)') }}</th>
                        <th>{{ __('Name (AR)') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plans as $plan)
                        <tr>
                            <td>{{ $plan->key }}</td>
                            <td>{{ $plan->getTranslation('name', 'en') }}</td>
                            <td>{{ $plan->getTranslation('name', 'ar') }}</td>
                            <td>{{ $plan->price }}</td>
                            <td>
                                <a href="{{ route('admin.hosting_plans.edit', $plan->id) }}"
                                    class="btn btn-sm btn-info">{{ __('Edit') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection