@extends('layout.app')

@section('content')
<main
class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
<!-- Profile Edit Form -->

<form action="{{ route('update-profile') }}" method="POST">
@csrf
  <div class="space-y-12">
    <div class="border-b border-gray-900/10 pb-12">
      <h2 class="text-xl font-semibold leading-7 text-gray-900">
        Edit Profile
      </h2>
      <p class="mt-1 text-sm leading-6 text-gray-600">
        This information will be displayed publicly so be careful what you
        share.
      </p>

    <div class="mt-10 border-b border-gray-900/10 pb-12">

        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-3">
            <label
              for="first-name"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Full name</label>
            <div class="mt-2">
              <input
                type="text"
                name="name"
                id="first-name"
                autocomplete="given-name"
                value="{{ Auth::user()->name }}"
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
            </div>
          </div>

          <div class="sm:col-span-3">
            <label
              for="last-name"
              class="block text-sm font-medium leading-6 text-gray-900"
              >User name</label
            >
            <div class="mt-2">
              <input
                type="text"
                name="username"
                id="last-name"
                value="{{ Auth::user()->username }}"
                autocomplete="family-name"
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
            </div>
          </div>

          <div class="col-span-full">
            <label
              for="email"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Email address</label
            >
            <div class="mt-2">
              <input
                id="email"
                name="email"
                type="email"
                autocomplete="email"
                value="{{ Auth::user()->email }}"
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
            </div>
          </div>

          <div class="col-span-full">
            <label
              for="password"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Password</label
            >
            <div class="mt-2">
              <input
                type="password"
                name="password"
                value="{{ Auth::user()->password }}"
                id="password"
                autocomplete="password"
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
            </div>
          </div>
        </div>
      </div>

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="col-span-full">
          <label
            for="bio"
            class="block text-sm font-medium leading-6 text-gray-900"
            >Bio</label
          >
          <div class="mt-2">
            <textarea
              id="bio"
              name="bio"
              rows="3"
              class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
              {{ Auth::user()->bio }}</textarea
            >
          </div>
          <p class="mt-3 text-sm leading-6 text-gray-600">
            Write a few sentences about yourself.
          </p>
        </div>
      </div>

    </div>
  </div>

  <div class="mt-6 flex items-center justify-end gap-x-6">
    <a href="{{ route('profile') }}"><button
      type="button"
      class="text-sm font-semibold leading-6 text-gray-900">
      Cancel
    </button></a>
   <button
      class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
      Update
    </button>
  </div>
</form>
<!-- /Profile Edit Form -->
</main>
@endsection
