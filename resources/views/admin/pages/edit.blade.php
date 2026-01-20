@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>{{ __('Edit Page') }}</h2>
        </div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger"
                    style="padding: 10px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; margin-bottom: 20px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.pages.update', $page->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title_en">{{ __('Title (English)') }}</label>
                    <input type="text" name="title[en]" id="title_en" class="form-control"
                        value="{{ old('title.en', $page->getTranslation('title', 'en')) }}" required>
                </div>

                <div class="form-group">
                    <label for="title_ar">{{ __('Title (Arabic)') }}</label>
                    <input type="text" name="title[ar]" id="title_ar" class="form-control"
                        value="{{ old('title.ar', $page->getTranslation('title', 'ar')) }}" required dir="rtl">
                </div>

                <div class="form-group"
                    style="background: #f8f9fa; padding: 15px; border-radius: 5px; border: 1px solid #dee2e6; margin-bottom: 20px;">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="slug_en">{{ __('Slug (English)') }}</label>
                            <input type="text" name="slug[en]" id="slug_en" class="form-control"
                                value="{{ old('slug.en', $page->getTranslation('slug', 'en')) }}"
                                placeholder="e.g., about-us">
                        </div>
                        <div class="col-md-6">
                            <label for="slug_ar">{{ __('Slug (Arabic)') }}</label>
                            <input type="text" name="slug[ar]" id="slug_ar" class="form-control"
                                value="{{ old('slug.ar', $page->getTranslation('slug', 'ar')) }}" dir="rtl"
                                placeholder="مثلاً: من-نحن">
                        </div>
                    </div>
                    <small class="text-muted">{{ __('Leave empty to generate from title') }}</small>
                </div>

                <div class="form-group">
                    <label for="order">{{ __('Order') }}</label>
                    <input type="number" name="order" id="order" class="form-control"
                        value="{{ old('order', $page->order) }}">
                </div>

                <div class="form-group">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ $page->is_active ? 'checked' : '' }}>
                    <label for="is_active">{{ __('Active') }}</label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection