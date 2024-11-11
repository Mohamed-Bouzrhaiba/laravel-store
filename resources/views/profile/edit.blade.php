<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-dark leading-tight">{{ __('Profile') }}</h2>
    </x-slot>

   @section('content')
    <div class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-body">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
</x-app-layout>
