@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>{{ __('Add New Service') }}</h2>
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

            <form action="{{ route('admin.services.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="page_id">{{ __('Assign to Page') }}</label>
                    <select name="page_id" id="page_id" class="form-control">
                        <option value="">{{ __('Home Page (Default)') }}</option>
                        @foreach($pages as $page)
                            <option value="{{ $page->id }}" {{ old('page_id') == $page->id ? 'selected' : '' }}>
                                {{ $page->getTranslation('title', app()->getLocale()) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="icon_class">{{ __('Icon Class') }} (e.g., how_share, how_win, how_adv)</label>
                    <select name="icon_class" id="icon_class" class="form-control">
                        <option value="how_share">how_share</option>
                        <option value="how_win">how_win</option>
                        <option value="how_adv">how_adv</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="title_en">{{ __('Title (English)') }}</label>
                    <input type="text" name="title[en]" id="title_en" class="form-control" value="{{ old('title.en') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="title_ar">{{ __('Title (Arabic)') }}</label>
                    <input type="text" name="title[ar]" id="title_ar" class="form-control" value="{{ old('title.ar') }}"
                        required dir="rtl">
                </div>

                <div class="form-group">
                    <label for="description_en">{{ __('Description (English)') }}</label>
                    <textarea name="description[en]" id="description_en" class="form-control"
                        required>{{ old('description.en') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="description_ar">{{ __('Description (Arabic)') }}</label>
                    <textarea name="description[ar]" id="description_ar" class="form-control" required
                        dir="rtl">{{ old('description.ar') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="order">{{ __('Order') }}</label>
                    <input type="number" name="order" id="order" class="form-control" value="{{ old('order', 0) }}">
                </div>

                <div class="form-group">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked>
                    <label for="is_active">{{ __('Active') }}</label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection