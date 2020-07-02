<a href="/about" class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition duration-150 ease-in-out">About Us</a>

@auth
    <!--
        example: display user name and avitar
    <div class="mt-1 mx-3 text-gray-500 text-sm pt-4 border-t opacity-75 hover:opacity-100">
        <img src="{{ auth()->user()->firstSocialAvatar() }}" class="inline-block w-6 h-6 rounded-full border mr-1"
             title="Signed in as user : {{ auth()->user()->name }}"
        >
        <span>{{ auth()->user()->name }}</span>
    </div>
-->

    <div class="mt-1 text-gray-500 text-sm pb-2 opacity-75 hover:opacity-100">
        <a href="/auth/logout" class="block px-3 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition duration-150 ease-in-out">Log Out</a>
    </div>
@endauth
