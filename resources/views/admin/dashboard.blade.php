@extends('admin.layout')

@section('content')
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">{{ __('admin.total_links') }}</div>
            <div class="stat-value">{{ $stats['total_links'] }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">{{ __('admin.total_pages') }}</div>
            <div class="stat-value">{{ $stats['total_pages'] }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">{{ __('admin.total_services') }}</div>
            <div class="stat-value">{{ $stats['total_services'] }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">{{ __('admin.logo_status') }}</div>
            <div class="stat-value">{{ $stats['logo_status'] }}</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>{{ __('admin.quick_actions') }}</h2>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.logo') }}" class="btn btn-primary">{{ __('admin.manage_logo') }}</a>
            <a href="{{ route('admin.links') }}" class="btn btn-primary">{{ __('admin.manage_links') }}</a>
        </div>
    </div>
@endsection