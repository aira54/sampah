<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <!-- Komponen ini menampilkan pesan error validasi umum -->
        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Input untuk email -->
            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-text-input id="email" name="email" type="email" :value="old('email', $email)" required autofocus />

                @error('email')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input untuk password baru -->
            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-text-input id="password" name="password" type="password" required autocomplete="new-password" />

                @error('password')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input untuk konfirmasi password -->
            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" required />

                @error('password_confirmation')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>


            <!-- Tombol untuk submit form reset password -->
            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
