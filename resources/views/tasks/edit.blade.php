<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold text-black leading-tight">
                    Edit Task
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="relative flex justify-center border m-5 p-4 border-2 rounded">
        <form method="POST" action="{{ route('tasks.update', ['task' => $task]) }}" class="w-full max-w-md">
            @csrf
            @method('PUT')

            <div class="mb-4 border">
                <label for="name" class="block text-black font-bold mb-2 text-center">Task Name:</label>
                <input type="text" name="name" id="name" class="w-full max-w-md form-input rounded-md shadow-sm @error('name') border-red-500 @enderror" value="{{ old('name', $task->name) }}">
                @error('name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="completed" class="flex items-center">
                    <input type="checkbox" name="completed" id="completed" class="form-checkbox rounded text-primary" {{ $task->completed ? 'checked' : '' }}>
                    <span class="ml-2">Completed</span>
                </label>
            </div>

            <div class="mb-4 text-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Update Task</button>
            </div>
        </form>
    </div>
</x-app-layout>
