@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>{{ __('Edit Slider Image') }}</h2>
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

            <form action="{{ route('admin.slider.update', $sliderImage->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="image_path">{{ __('Image') }} (Leave empty to keep current)</label>
                    <input type="file" name="image_path" id="image_path" class="form-control">
                    @if($sliderImage->image_path)
                        <div style="margin-top: 10px;">
                            <img src="{{ asset('storage/' . $sliderImage->image_path) }}" alt="Current Image"
                                style="height: 100px;">
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="title">{{ __('Title') }}</label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ old('title', $sliderImage->title) }}">
                </div>

                <div class="form-group">
                    <label for="description">{{ __('Description') }}</label>
                    <textarea name="description" id="description"
                        class="form-control">{{ old('description', $sliderImage->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="order">{{ __('Order') }}</label>
                    <input type="number" name="order" id="order" class="form-control"
                        value="{{ old('order', $sliderImage->order) }}">
                </div>

                <div class="form-group">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ $sliderImage->is_active ? 'checked' : '' }}>
                    <label for="is_active">{{ __('Active') }}</label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    <a href="{{ route('admin.slider.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection