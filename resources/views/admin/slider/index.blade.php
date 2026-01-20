@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h2>{{ __('Slider Management') }}</h2>
            <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">{{ __('Add New Image') }}</a>
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
                        <th>{{ __('Image') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($images as $image)
                        <tr>
                            <td>{{ $image->order }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title }}"
                                    style="height: 50px; object-fit: cover;">
                            </td>
                            <td>{{ $image->title ?? '-' }}</td>
                            <td>
                                @if($image->is_active)
                                    <span class="badge badge-success" style="color: green;">{{ __('Active') }}</span>
                                @else
                                    <span class="badge badge-danger" style="color: red;">{{ __('Inactive') }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.slider.edit', $image->id) }}"
                                    class="btn btn-sm btn-info">{{ __('Edit') }}</a>
                                <form action="{{ route('admin.slider.destroy', $image->id) }}" method="POST"
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