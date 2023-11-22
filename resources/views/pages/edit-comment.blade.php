@extends('layout.app')

@section('content')
<main
      class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
      <h4>Please update here your Comment.</h4>
<form
method="POST"
enctype="multipart/form-data"
action="{{ route('updateComment',$comments->uuid) }}"
class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 space-y-3">
<!-- Create Post Card Top -->
    @csrf
    <div>
        {{-- @error('description')
            <div class=" text-sm font-medium leading-6 text-red-900">Please Create a Post</div>
        @enderror --}}
    <div class="flex items-start /space-x-3/">

        <!-- Content -->
        <div class="text-gray-700 font-normal w-full">
        <textarea
            class="block w-full p-2 pt-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
            value=""
            name="comments"
            rows="2"
            placeholder="{{ $comments->comments }}"></textarea>
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
            Update post
        </button>
        <!-- /Post Button -->
        </div>
    </div>
    <!-- /Card Bottom Action Buttons -->
    </div>
<!-- /Create Post Card Bottom -->
</form>
@error('description')
                <div class=" text-sm font-medium leading-6 text-red-900">Please Create a Post</div>
        @enderror
</main>
@endsection
