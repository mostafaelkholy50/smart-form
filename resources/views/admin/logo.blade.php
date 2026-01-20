@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>{{ __('admin.logo_settings') }}</h2>
        </div>

        <div class="form-group">
            <label>{{ __('admin.current_logo') }}</label>
            @if($currentLogo)
                <div style="background: #f0f0f0; padding: 20px; display: inline-block; border-radius: 4px;">
                    <img src="{{ asset('storage/' . $currentLogo) }}" alt="Site Logo" style="max-height: 100px;">
                </div>
            @else
                <p class="text-muted">{{ __('admin.no_logo') }}</p>
            @endif
        </div>

        <form action="{{ route('admin.logo.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="logo">{{ __('admin.upload_logo') }}</label>
                <input type="file" name="logo" id="logo" class="form-control" require accept="image/*">
                @error('logo')
                    <span style="color: red; font-size: 14px;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ __('admin.save') }}</button>
        </form>
    </div>
@endsection