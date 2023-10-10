<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <div class="relative m-5 flex justify-center rounded border border-2 p-4">
        <div class="mx-auto w-full max-w-md">
          <div class="rounded-lg bg-white p-6">
            <h2 class="mb-4 text-2xl font-semibold leading-tight text-black">Create New Task</h2>
            <form method="POST" action="{{ route('tasks.store') }}">
              @csrf

              <div class="mb-4">
                <label for="name" class="mb-2 block text-sm font-bold text-gray-700"> Task Name </label>
                <input id="name" type="text" class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none" name="name" value="{{ old('name') }}" required autofocus />
                @error('name')
                <p class="text-xs italic text-red-500">{{ $message }}</p>
                @enderror
              </div>

              <div class="mb-4">
                <label for="completed" class="mb-2 block text-sm font-bold text-gray-700"> Task Completed </label>
                <select id="completed" name="completed" class="focus:shadow-outline block w-full appearance-none rounded border border-gray-400 bg-white px-4 py-2 leading-tight shadow hover:border-gray-500 focus:outline-none">
                  <option value="1">Completed</option>
                  <option value="0">Not Completed</option>
                </select>
              </div>

              <div class="mb-6">
                <button type="submit" class="focus:shadow-outline rounded bg-emerald-400 px-4 py-2 font-bold text-white focus:outline-none">Create Task</button>
              </div>
              <div>
                <a href="{{ route('tasks.index') }}" class="rounded bg-gray-500 px-4 py-2 font-bold text-white hover:bg-gray-600"> Back </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </x-slot>
</x-app-layout>
