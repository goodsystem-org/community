<form method="POST" action="{{ route('password.update') }}">
    @csrf
{{--
    <input type="hidden" name="token" value="{{ $token }}">
--}}

    <div class="mt-6">
        <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
            {{ __('E-Mail Address') }}
        </label>
        <div class="mt-1 rounded-md shadow-sm">
            <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                   class="@error('email') text-red-500 @enderror appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
            />
            @error('email')
            <span class="text-red-500" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
            @enderror
        </div>

        @include('partials.auth-password')

        @include('partials.auth-password-confirmation')


        <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition duration-150 ease-in-out">
                                {{ __('Reset Password') }}
                            </button>
                        </span>
        </div>
    </div>
</form>
