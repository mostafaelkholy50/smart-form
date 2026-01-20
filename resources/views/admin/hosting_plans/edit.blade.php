@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>{{ __('Edit Hosting Plan') }}: {{ $hostingPlan->name }}</h2>
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

            <form action="{{ route('admin.hosting_plans.update', $hostingPlan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name_en">{{ __('Name (English)') }}</label>
                    <input type="text" name="name[en]" id="name_en" class="form-control"
                        value="{{ old('name.en', $hostingPlan->getTranslation('name', 'en')) }}" required>
                </div>

                <div class="form-group">
                    <label for="name_ar">{{ __('Name (Arabic)') }}</label>
                    <input type="text" name="name[ar]" id="name_ar" class="form-control"
                        value="{{ old('name.ar', $hostingPlan->getTranslation('name', 'ar')) }}" required dir="rtl">
                </div>

                <div class="form-group">
                    <label for="price">{{ __('Price') }}</label>
                    <input type="text" name="price" id="price" class="form-control"
                        value="{{ old('price', $hostingPlan->price) }}" required>
                </div>

                <div class="form-group">
                    <label for="currency_en">{{ __('Currency (English)') }}</label>
                    <input type="text" name="currency[en]" id="currency_en" class="form-control"
                        value="{{ old('currency.en', $hostingPlan->getTranslation('currency', 'en')) }}" required>
                </div>

                <div class="form-group">
                    <label for="currency_ar">{{ __('Currency (Arabic)') }}</label>
                    <input type="text" name="currency[ar]" id="currency_ar" class="form-control"
                        value="{{ old('currency.ar', $hostingPlan->getTranslation('currency', 'ar')) }}" required dir="rtl">
                </div>

                <hr>
                <h3>{{ __('Features') }}</h3>

                <div class="form-group">
                    <label>{{ __('Space') }} (EN/AR)</label>
                    <div style="display: flex; gap: 10px;">
                        <input type="text" name="features[space][en]" class="form-control"
                            value="{{ old('features.space.en', $hostingPlan->features['space']['en'] ?? '') }}"
                            placeholder="EN" required>
                        <input type="text" name="features[space][ar]" class="form-control"
                            value="{{ old('features.space.ar', $hostingPlan->features['space']['ar'] ?? '') }}"
                            placeholder="AR" dir="rtl" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>{{ __('Traffic') }} (EN/AR)</label>
                    <div style="display: flex; gap: 10px;">
                        <input type="text" name="features[traffic][en]" class="form-control"
                            value="{{ old('features.traffic.en', $hostingPlan->features['traffic']['en'] ?? '') }}"
                            placeholder="EN" required>
                        <input type="text" name="features[traffic][ar]" class="form-control"
                            value="{{ old('features.traffic.ar', $hostingPlan->features['traffic']['ar'] ?? '') }}"
                            placeholder="AR" dir="rtl" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>{{ __('Support') }} (EN/AR)</label>
                    <div style="display: flex; gap: 10px;">
                        <input type="text" name="features[support][en]" class="form-control"
                            value="{{ old('features.support.en', $hostingPlan->features['support']['en'] ?? '') }}"
                            placeholder="EN" required>
                        <input type="text" name="features[support][ar]" class="form-control"
                            value="{{ old('features.support.ar', $hostingPlan->features['support']['ar'] ?? '') }}"
                            placeholder="AR" dir="rtl" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>{{ __('Databases') }} (EN/AR)</label>
                    <div style="display: flex; gap: 10px;">
                        <input type="text" name="features[databases][en]" class="form-control"
                            value="{{ old('features.databases.en', $hostingPlan->features['databases']['en'] ?? '') }}"
                            placeholder="EN">
                        <input type="text" name="features[databases][ar]" class="form-control"
                            value="{{ old('features.databases.ar', $hostingPlan->features['databases']['ar'] ?? '') }}"
                            placeholder="AR" dir="rtl">
                    </div>
                </div>

                <div class="form-group">
                    <label>{{ __('Subdomains') }} (EN/AR)</label>
                    <div style="display: flex; gap: 10px;">
                        <input type="text" name="features[subdomains][en]" class="form-control"
                            value="{{ old('features.subdomains.en', $hostingPlan->features['subdomains']['en'] ?? '') }}"
                            placeholder="EN">
                        <input type="text" name="features[subdomains][ar]" class="form-control"
                            value="{{ old('features.subdomains.ar', $hostingPlan->features['subdomains']['ar'] ?? '') }}"
                            placeholder="AR" dir="rtl">
                    </div>
                </div>

                <div class="form-group">
                    <label>{{ __('Emails') }} (EN/AR)</label>
                    <div style="display: flex; gap: 10px;">
                        <input type="text" name="features[emails][en]" class="form-control"
                            value="{{ old('features.emails.en', $hostingPlan->features['emails']['en'] ?? '') }}"
                            placeholder="EN">
                        <input type="text" name="features[emails][ar]" class="form-control"
                            value="{{ old('features.emails.ar', $hostingPlan->features['emails']['ar'] ?? '') }}"
                            placeholder="AR" dir="rtl">
                    </div>
                </div>

                <div class="form-group">
                    <label>{{ __('FTP') }} (EN/AR)</label>
                    <div style="display: flex; gap: 10px;">
                        <input type="text" name="features[ftp][en]" class="form-control"
                            value="{{ old('features.ftp.en', $hostingPlan->features['ftp']['en'] ?? '') }}"
                            placeholder="EN">
                        <input type="text" name="features[ftp][ar]" class="form-control"
                            value="{{ old('features.ftp.ar', $hostingPlan->features['ftp']['ar'] ?? '') }}" placeholder="AR"
                            dir="rtl">
                    </div>
                </div>

                @if(isset($hostingPlan->features['custom_design']) && is_array($hostingPlan->features['custom_design']))
                    <div class="form-group">
                        <label>{{ __('Custom Design') }} (EN/AR)</label>
                        <div style="display: flex; gap: 10px;">
                            <input type="text" name="features[custom_design][en]" class="form-control"
                                value="{{ old('features.custom_design.en', $hostingPlan->features['custom_design']['en'] ?? '') }}"
                                placeholder="EN">
                            <input type="text" name="features[custom_design][ar]" class="form-control"
                                value="{{ old('features.custom_design.ar', $hostingPlan->features['custom_design']['ar'] ?? '') }}"
                                placeholder="AR" dir="rtl">
                        </div>
                    </div>
                @endif

                @if(isset($hostingPlan->features['free_domain']))
                    <div class="form-group">
                        <label>{{ __('Free Domain') }} (EN/AR)</label>
                        <div style="display: flex; gap: 10px;">
                            <input type="text" name="features[free_domain][en]" class="form-control"
                                value="{{ old('features.free_domain.en', $hostingPlan->features['free_domain']['en'] ?? '') }}"
                                placeholder="EN">
                            <input type="text" name="features[free_domain][ar]" class="form-control"
                                value="{{ old('features.free_domain.ar', $hostingPlan->features['free_domain']['ar'] ?? '') }}"
                                placeholder="AR" dir="rtl">
                        </div>
                    </div>
                @endif


                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    <a href="{{ route('admin.hosting_plans.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection