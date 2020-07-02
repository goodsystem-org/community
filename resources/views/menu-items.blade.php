
<a href="/about" class="ml-8 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition duration-150 ease-in-out">About Us</a>

@auth
<!--
        example: display user name and avitar
        <a href="/me" class="ml-8 text-gray-500 text-sm h-8 pb-2 pt-1 px-1 border rounded-full opacity-75 hover:opacity-100">
        {{-- @click="userInfoOpen = !userInfoOpen" --}}
        <img src="{ { auth()->user()->firstSocialAvatar() } }" class="inline-block w-6 h-6 rounded-full border mr-1"
             title="Signed in as user : { { auth()->user()->name } }"
        >
        <span>{{ auth()->user()->name }}</span>
    </a>
    <div class="flex justify-end hidden">
        <ul class="border rounded-lg mt-1 px-2 absolute bg-white text-sm font-medium text-gray-500 focus:outline-none focus:text-gray-900 transition duration-150 ease-in-out">
            <li class="my-2">
                <button @click="openNotifSignup()" class="hover:text-gray-900 underlin">Communication Preference</button>
            </li>
            <li>
                <hr>
            </li>
            <li class="my-2 hover:text-gray-900">
                <a href="/auth/logout" class="">Log Out</a>
            </li>
        </ul>
    </div>
-->
@endauth
