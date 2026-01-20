@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>{{ __('Add New Contact Method') }}</h2>
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

            <form action="{{ route('admin.contact.store') }}" method="POST">
                @csrf

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
                    <label for="content_en">{{ __('Content (English)') }}</label>
                    <textarea name="content[en]" id="content_en" class="form-control" rows="3"
                        required>{{ old('content.en') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="content_ar">{{ __('Content (Arabic)') }}</label>
                    <textarea name="content[ar]" id="content_ar" class="form-control" rows="3" required
                        dir="rtl">{{ old('content.ar') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="order">{{ __('Order') }}</label>
                    <input type="number" name="order" id="order" class="form-control" value="{{ old('order', 0) }}">
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="is_active" value="1" checked> {{ __('Active') }}
                    </label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection