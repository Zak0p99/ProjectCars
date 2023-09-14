@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Profile') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update', $profile->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Name Input -->
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ $profile->name }}" required>
                            </div>

                            <!-- Email Input -->
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ $profile->email }}" required>
                            </div>

                            <!-- Phone Number Input -->
                            <div class="form-group">
                                <label for="phone_number">{{ __('Phone Number') }}</label>
                                <input id="phone_number" type="text" class="form-control" name="phone_number"
                                    value="{{ $profile->phone_number }}" required>
                            </div>

                            <!-- Add more fields as needed -->

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Profile') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
