<x-guest-layout>


    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors"/>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <!--English Name -->
        <div>
            <x-label for="en_name" :value="__('En Name')"/>

            <x-input id="en_name" class="block mt-1 w-full" type="text" name="sr_name_en" :value="old('name')" required
                     autofocus/>
        </div>

        <!-- Arabic Name -->
        <div>
            <x-label for="ar_name" :value="__('Ar Name')"/>

            <x-input id="ar_name" class="block mt-1 w-full" type="text" name="sr_name_ar" :value="old('name')" required
                     autofocus/>
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-label for="email" :value="__('Email')"/>

            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-label for="password" :value="__('Password')"/>

            <x-input id="password" class="block mt-1 w-full"
                     type="password"
                     name="password"
                     required autocomplete="new-password"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-label for="password_confirmation" :value="__('Confirm Password')"/>

            <x-input id="password_confirmation" class="block mt-1 w-full"
                     type="password"
                     name="password_confirmation" required/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-button class="ml-4">
                {{ __('Register') }}
            </x-button>
        </div>
    </form>
</x-guest-layout>
