<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">
                {{ session('status') }}
            </span>
        </div>
        @endif

        @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">
                {{ session('status') }}
            </span>
        </div>
        @endif
        <h2>Reset Password</h2>
        <form method="POST" action="{{ route('partner.updatePassword') }}">
            @csrf
            <x-jet-input class="block mt-1 w-full" type="hidden" name="token" value="{{$token}}" />
            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                @if(env('APP_ENV') === 'local')
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
                @else
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                :value="old('email')" required autofocus />
                @endif
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                @if(env('APP_ENV') === 'local')
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                @else
                <x-jet-input id="password" class="block mt-1 w-full" type="password" 
                name="password" required autocomplete="current-password" />
                @endif
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Password Confirmation') }}" />
                @if(env('APP_ENV') === 'local')
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="current-password" />
                @else
                <x-jet-input id="password" class="block mt-1 w-full" type="password" 
                name="password_confirmation" required autocomplete="current-password" />
                @endif
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Reset Password') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
