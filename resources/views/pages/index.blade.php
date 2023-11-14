@extends('layout.app')

@section('content')




<main
      class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">

      <form
        method="POST"
        enctype="multipart/form-data"
        action="{{ route('post_register') }}"
        class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 space-y-3">
        <!-- Create Post Card Top -->
        @csrf
        <div>
            @error('description')
                <div class=" text-sm font-medium leading-6 text-red-900">Please Create a Post</div>
            @enderror
          <div class="flex items-start /space-x-3/">

            <!-- Content -->
            <div class="text-gray-700 font-normal w-full">
              <textarea
                class="block w-full p-2 pt-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"

                name="description"
                rows="2"
                placeholder="What's going on, {{ Auth::user()->name }}?"></textarea>
            </div>
          </div>
        </div>

        <!-- Create Post Card Bottom -->
        <div>

          <!-- Card Bottom Action Buttons -->
          <div class="flex items-center justify-end">
            <div>
              <!-- Post Button -->
              <button
                class="-m-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                Post
              </button>
              <!-- /Post Button -->
            </div>
          </div>
          <!-- /Card Bottom Action Buttons -->
        </div>
        <!-- /Create Post Card Bottom -->
      </form>
      <!-- /Barta Create Post Card -->

      <!-- Newsfeed -->
      <section
        id="newsfeed"
        class="space-y-6">
        <!-- Barta Card -->

       {{-- @foreach ($details as $detail)
 {{ $detail->name }}
       @endforeach --}}

        @foreach ($details as $detail)

            <article
            class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
            <!-- Barta Card Top -->
            <header>
                <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">

                    <!-- User Info -->
                    <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                    <a
                        href="profile.html"
                        class="hover:underline font-semibold line-clamp-1">
                        {{ $detail->name }}
                    </a>

                    <a
                        href="profile.html"
                        class="hover:underline text-sm text-gray-500 line-clamp-1">
                        {{ '@'.  $detail->name }}
                    </a>
                    </div>
                    <!-- /User Info -->
                </div>

                <!-- Card Action Dropdown -->
                @if (Auth::user()->id === $detail->id)
                    <div class="flex flex-shrink-0 self-center" x-data="{ open: false }">
                        <div class="relative inline-block text-left">
                        <div>
                            <button
                            @click="open = !open"
                            type="button"
                            class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                            id="menu-0-button">
                            <span class="sr-only">Open options</span>
                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                aria-hidden="true">
                                <path
                                d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"></path>
                            </svg>
                            </button>
                        </div>

                        <!-- Dropdown menu -->
                        <div
                                x-show="open"
                                @click.away="open = false"
                                class="absolute right-0 z-10 mt-2 w-30 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu"
                                aria-orientation="vertical"
                                aria-labelledby="user-menu-button"
                                tabindex="-1">
                            <a
                                    href="{{ route('showPost', $detail->uuid) }} "
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem"
                                    tabindex="-1"
                                    id="user-menu-item-0"
                            >Edit</a
                            >
                            <a
                                    href="{{ route('deletePost',$detail->uuid) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem"
                                    tabindex="-1"
                                    id="user-menu-item-1"
                            >Delete</a
                            >
                        </div>
                        </div>

                    </div>
                @endif

                <!-- /Card Action Dropdown -->
                </div>
            </header>
            <!-- Content -->
                        {{ $detail->description }}
            <!-- Date Created & View Stat -->
            <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
                <span class="">Created at: {{ \Carbon\Carbon::parse($detail->created_at)->format('H:i:s') }}</span>
                <p>Time: {{ \Carbon\Carbon::parse($detail->created_at) }}</p>
                <span class="">•</span>
                <span>450 views</span>
            </div>

            </article>
        @endforeach
      </section>
      <!-- /Newsfeed -->
    </main>



@endsection
