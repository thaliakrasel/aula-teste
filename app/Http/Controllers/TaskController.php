<?php

namespace App\Http\Controllers;

use App\Models\Task as ModelsTask;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = ModelsTask::paginate(10); // Obtém todas as tarefas (você pode ajustar isso conforme necessário)
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'completed' => 'required', // Certifique-se de que o campo 'completed' esteja presente no formulário.
        ]);

        // Crie uma nova instância da ModelsTask com base nos dados do formulário.
        // O valor 'completed' será definido com base no valor do campo 'completed' no formulário.
        ModelsTask::create([
            'name' => $request->input('name'),
            'completed' => $request->input('completed'),
        ]);

        return redirect('/tasks')->with('success', 'Task created successfully');
    }


    public function edit(ModelsTask $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, ModelsTask $task)
    {
        // Valide os dados recebidos do formulário
        $request->validate([
            'name' => 'required|max:255', // Adicione outras regras de validação, se necessário
            'completed' => 'boolean', // Certifique-se de que o campo "completed" seja um booleano
        ]);

        // Atualize os atributos da tarefa com base nos dados do formulário
        $task->update([
            'name' => $request->input('name'),
            'completed' => $request->input('completed', false), // Define como false se não estiver presente
        ]);

        // Redirecione de volta para a página de lista de tarefas com uma mensagem de sucesso
        return redirect('/tasks')->with('success', 'Task updated successfully');
    }

    public function destroy(ModelsTask $task)
    {
        // Deleta a tarefa
        $task->delete();

        // Redireciona de volta para a página de lista de tarefas com uma mensagem de sucesso
        return redirect('/tasks')->with('success', 'Task deleted successfully');
    }
}
