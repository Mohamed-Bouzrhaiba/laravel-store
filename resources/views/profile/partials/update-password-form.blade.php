<section class="mb-4">
    <header class="mb-4">
        <h2 class="h5 font-weight-bold text-dark">
            {{ __('Update Password') }}
        </h2>
        <p class="text-muted">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-3">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="update_password_current_password">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
            <div class="text-danger">{{ $errors->updatePassword->first('current_password') }}</div>
        </div>

        <div class="form-group">
            <label for="update_password_password">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
            <div class="text-danger">{{ $errors->updatePassword->first('password') }}</div>
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
            <div class="text-danger">{{ $errors->updatePassword->first('password_confirmation') }}</div>
        </div>

        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary me-2">{{ __('Save') }}</button>

            @if (session('status') === 'password-updated')
                <p class="text-muted" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
