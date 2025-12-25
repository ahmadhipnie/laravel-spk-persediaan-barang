@extends('layouts.app')
@section('title', 'Profile User')
@section('content')

    <div class="w-full p-6 mx-auto">
        <div class="flex flex-wrap -mx-3">

            <div class="flex-none w-full max-w-full ">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 bg-white rounded-t-2xl">
                        <h6 class="mb-1">Edit Profile</h6>
                        <p class="leading-normal text-sm">Edit Your Profile Information</p>
                    </div>
                    <div class="flex-auto p-4">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="flex flex-wrap -mx-3">
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12">
                                    <div class="mb-4">
                                        <label for="name" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                            placeholder="Enter your name" />
                                        @error('name')
                                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12">
                                    <div class="mb-4">
                                        <label for="email" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Email</label>
                                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                            placeholder="Enter your email" />
                                        @error('email')
                                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102">
                                    Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Change Password Section -->
            <div class="flex-none w-full max-w-full mt-6">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 bg-white rounded-t-2xl">
                        <h6 class="mb-1">Change Password</h6>
                        <p class="leading-normal text-sm">Update your password</p>
                    </div>
                    <div class="flex-auto p-4">
                        <form action="{{ route('profile.updatePassword') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="flex flex-wrap -mx-3">
                                <div class="w-full max-w-full px-3 shrink-0 md:w-12/12">
                                    <div class="mb-4">
                                        <label for="password_lama" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Current Password</label>
                                        <input type="password" name="password_lama" id="password_lama"
                                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid {{ $errors->has('password_lama') ? 'border-red-500' : 'border-gray-300' }} bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                            placeholder="Enter current password" />
                                        @error('password_lama')
                                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12">
                                    <div class="mb-4">
                                        <label for="password" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">New Password</label>
                                        <input type="password" name="password" id="password"
                                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                            placeholder="Enter new password" />
                                        @error('password')
                                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12">
                                    <div class="mb-4">
                                        <label for="password_confirmation" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Confirm New Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                                            placeholder="Confirm new password" />
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-purple-700 to-pink-500 hover:shadow-soft-xs active:opacity-85 hover:scale-102">
                                    Change Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <footer class="pt-4">
                <div class="w-full px-6 mx-auto">
                    <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
                        <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
                            <div class="leading-normal text-center text-sm text-slate-500 lg:text-left">
                                ©
                                <script>
                                    document.write(new Date().getFullYear() + ",");
                                </script>
                                made with <i class="fa fa-heart"></i> by
                                <a href="" class="font-semibold text-slate-700"
                                    target="_blank">Creative Tim</a>
                                for a better web.
                                <span class="w-full"> Distributed by ❤️ ThemeWagon </span>
                            </div>
                        </div>
                        <div class="w-full max-w-full px-3 mt-0 shrink-0 lg:w-1/2 lg:flex-none">
                            <ul class="flex flex-wrap justify-center pl-0 mb-0 list-none lg:justify-end">
                                <li class="nav-item">
                                    <a href="#!"
                                        class="block px-4 pt-0 pb-1 font-normal transition-colors ease-soft-in-out text-sm text-slate-500">Creative
                                        Tim</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#!"
                                        class="block px-4 pt-0 pb-1 font-normal transition-colors ease-soft-in-out text-sm text-slate-500">About
                                        Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#!"
                                        class="block px-4 pt-0 pb-1 font-normal transition-colors ease-soft-in-out text-sm text-slate-500">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#!"
                                        class="block px-4 pt-0 pb-1 pr-0 font-normal transition-colors ease-soft-in-out text-sm text-slate-500">License</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    </div>
@endsection
