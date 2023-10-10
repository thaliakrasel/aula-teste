<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold text-black leading-tight">
                    ToDo List
                </h2>
            </div>
            <div>
                <a href="{{ route('tasks.create') }}" class="text-white font-bold py-2 px-4 rounded bg-blue-900">
                    Add new ToDo
                </a>
            </div>
        </div>
    </x-slot>

    <div class="relative flex justify-center border m-5 p-4 border-2 rounded">
        <table class="w-full border">
            <thead class="text-black uppercase border">
                <tr class="bg-white">
                    <th scope="col" class="px-6 py-3 border">Task</th>
                    <th scope="col" class="px-6 py-3 border">Completed</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr class="bg-white border">
                    <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap border">{{ $task->name }}</td>
                    <td class="px-6 py-4 border">{{ $task->completed ? 'Yes' : 'No' }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('tasks.edit', ['task' => $task]) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Edit</a>
                        <button data-modal-toggle="popup-modal-{{ $task->id }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach ($tasks as $task)
    <div id="popup-modal-{{ $task->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-60 max-w-sm">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Title -->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-xl font-bold">Confirm Deletion</p>
                    <button data-modal-hide="popup-modal-{{ $task->id }}" class="text-gray-500 hover:text-gray-700">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <!-- Content -->
                <p class="text-gray-700">Are you sure you want to delete this task?</p>
                <!-- Actions -->
                <div class="mt-5">
                    <form method="POST" action="{{ route('tasks.destroy', ['task' => $task]) }}" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button data-modal-hide="popup-modal-{{ $task->id }}" type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Yes, I'm sure</button>
                    </form>
                    <button data-modal-hide="popup-modal-{{ $task->id }}" class="bg-gray-200 text-gray-700 hover:text-gray-900 font-bold py-2 px-4 rounded ml-2">No, cancel</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalButtons = document.querySelectorAll('[data-modal-toggle]');
            const closeModalButtons = document.querySelectorAll('[data-modal-hide]');

            modalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const taskId = button.getAttribute('data-modal-toggle');
                    const modal = document.getElementById(taskId);
                    modal.classList.remove('hidden');
                });
            });

            closeModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const taskId = button.getAttribute('data-modal-hide');
                    const modal = document.getElementById(taskId);
                    modal.classList.add('hidden');
                });
            });
        });
    </script>
</x-app-layout>
