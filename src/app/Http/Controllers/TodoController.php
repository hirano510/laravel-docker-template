<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Todo;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    private $todo;
    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function index()
    {
        $todoList = $this->todo->all();
        // dd($todo);

        return view('todo.index',['todoList' => $todoList]);
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(TodoRequest $request)
    {
        $inputs = $request->all();

        $this->todo->fill($inputs);
        $this->todo->save();
        

        return redirect()->route('todo.index');
    }
    public function show($id)
    {
    $todo = $this->todo->find($id);

    return view('todo.show', ['todo' => $todo]);
    }

    public function edit($id)
    {
        $todo = $this->todo->find($id);
        
        return view('todo.edit',['todo' => $todo]);
    }

    public function update(TodoRequest $request, $id)
    {
        $inputs = $request->all();
        $todo = $this->todo->find($id);
        $todo->fill($inputs);
        $todo->save();

        return redirect()->route('todo.show', $todo->id);
    }

    public function delete($id)
    {
        $todo = $this->todo->find($id);
        $todo->delete();

        return redirect()->route('todo.index');
    }
}

