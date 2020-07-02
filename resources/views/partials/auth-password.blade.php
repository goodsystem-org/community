
<div class="mt-6">
    <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
        {{ __('Password') }}
    </label>
    <div class="mt-1 rounded-md shadow-sm">
        <input id="password" type="password" name="password" required autocomplete="current-password" class="@error('password') text-red-500 @enderror appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
        @error('password')
        <span class="text-red-500" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
