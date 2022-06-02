<x-app-layout>
    @section('title')
        Setting
    @endsection
    @push('css')
        <style>
            .image-upload > input {
                display: none;
            }
        </style>

    @endpush
    @php
        $array = [
            'dashboard' => 'Dasboard',
            'user' => 'User'
            ];
        $lastItem = "Setting";
    @endphp
    <x-breadcrumb :array="$array" :lastItem="$lastItem">

    </x-breadcrumb>

    <div class="w-full mx-auto">
        <div class="bg-white overflow-hidden shadow-sm">
            <div class="px-6 py-2 bg-white border-b border-gray-200">
                <span style="font-size: 17px; font-weight: bold;">Account info</span>
                <form class="flex flex-wra mb-6 image-upload relative" id="frm-avatar" enctype="multipart/form-data">
                    @csrf
                    <img src="{{ empty('/storage/uploads/'.Auth::user()->avatar) ? '/storage/uploads/'.Auth::user()->avatar : '/images/logo.png' }}" style="height: 92px;border-radius: 9999px; margin: 20px 0;">
                    <label for="avatar">
                        <img src="/images/camera.png" class="absolute" style="left: 100px; bottom: 20px"/>
                    </label>
                    <input id="avatar" name="avatar" type="file" onchange="updateAvatar()"/>
                </form>
                <form class="w-full" action="" method="POST">
                    @csrf
                    <div class="flex flex-wrap mb-6 pt-1">
                        <div class="w-full md:w-1/4" style="padding-right: 10px;">
                            <label class="block tracking-wide text-gray-700 font-bold"
                                   for="name" style="height: 32px; font-size: 16px; font-weight: 400;">
                                Name
                            </label>
                            <input
                                class="appearance-none block w-full text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:border-gray-500"
                                id="name" name="name" type="text" placeholder="Name"
                                value="{{ old('name') ?? Auth::user()->name }}">
                            @error('name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/4" style="padding-right: 10px;">
                            <label class="block tracking-wide text-gray-700 font-bold"
                                   for="email" style="height: 32px; font-size: 16px; font-weight: 400;">
                                Email
                            </label>
                            <input
                                class="appearance-none block w-full text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight bg-gray-200 "
                                id="email" name="email" type="text" placeholder="Email"
                                value="{{ Auth::user()->email }}"
                                readonly>
                        </div>
                    </div>
                    <div class="flex flex-wrap mb-6">
                        <div class="w-full md:w-1/4" style="padding-right: 10px;">
                            <label class="block tracking-wide text-gray-700 font-bold"
                                   for="old_password" style="height: 32px; font-size: 16px; font-weight: 400;">
                                Old password
                            </label>
                            <input
                                class="appearance-none block w-full text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:border-gray-500"
                                id="old_password" name="old_password" type="password" placeholder="Old password"
                                value="{{  old('old_password') }}">
                            @error('old_password')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/4" style="padding-right: 10px;">
                            <label class="block tracking-wide text-gray-700 font-bold"
                                   for="new_password" style="height: 32px; font-size: 16px; font-weight: 400;">
                                Password
                            </label>
                            <input
                                class="appearance-none block w-full text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:border-gray-500"
                                id="new_password" name="new_password" type="password" placeholder="Password"
                                value="{{  old('new_password') }}">
                            @error('new_password')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/4" style="padding-right: 10px;">
                            <label class="block tracking-wide text-gray-700 font-bold"
                                   for="confirm_password" style="height: 32px; font-size: 16px; font-weight: 400;">
                                Confirm password
                            </label>
                            <input
                                class="appearance-none block w-full text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:border-gray-500"
                                id="confirm_password" name="confirm_password" type="password"
                                placeholder="Confirm password" value="{{  old('confirm_password') }}">
                            @error('confirm_password')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap mb-2">
                        <div class="w-full md:w-1/4" style="padding-right: 10px;">
                            <div class="relative">
                                <label class="block tracking-wide text-gray-700 font-bold"
                                       for="dob" style="height: 32px; font-size: 16px; font-weight: 400;">
                                    Dob
                                </label>
                                <input datepicker type="text" id="dob" name="dob"
                                       class="appearance-none block w-full text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:border-gray-500"
                                       placeholder="Dob" datepicker-format="dd/mm/yyyy"
                                       value="{{ old('dob') ?? date('d-m-Y', strtotime(Auth::user()->dob)) }}">
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap mb-2">
                        <div class="w-full md:w-1/4" style="padding-right: 10px;">
                            <button type="submit"
                                    class="w-full items-center mt-4 px-4 py-2 border border-transparent rounded-md text-white content-center hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                    style="background-color: #3CA3DD; height: 40px;">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://unpkg.com/flowbite@1.4.7/dist/datepicker.js"></script>
        <script>
            function updateAvatar() {
                // var frm_avatar = new FormData($('frm-avatar')[0]);
                data = new FormData();
                data.append( 'avatar', $( '#avatar' )[0].files[0] );
                $.ajax({
                    url: "/user/updateAvatar",
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function (result) {
                        $("#div1").html(result);
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
