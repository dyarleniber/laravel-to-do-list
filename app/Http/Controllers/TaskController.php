<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->latest()->paginate(15);

        return view('index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);

        try {
            DB::beginTransaction();

            $task = new Task();
            $task->name = $request->name;
            $task->completed = false;
            $task->user_id = Auth::id();
            $task->save();

            DB::commit();

            return redirect()->route('tasks.create')
                ->with('success', 'Task created successfully.');
        } catch (\Throwable $t) {
            DB::rollback();

            Log::error($t->getMessage());

            return redirect()->route('tasks.create')
                ->with('error', 'Something went wrong, try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->first();
        if(!$task) {
            abort(404);
        }

        return view('show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->first();
        if(!$task) {
            abort(404);
        }

        return view('edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'check' => [Rule::in(['completed'])],
        ]);

        try {
            DB::beginTransaction();

            $task = Task::where('id', $id)->where('user_id', Auth::id())->first();
            if(!$task) {
                abort(404);
            }

            $task->name = $request->name;
            $task->completed = $request->check === 'completed' ? true : false;
            $task->save();

            DB::commit();

            return back()->with('success', 'Task updated successfully.');
        } catch (\Throwable $t) {
            DB::rollback();

            Log::error($t->getMessage());

            return back()->with('error', 'Something went wrong, try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try {
            DB::beginTransaction();

            $task = Task::where('id', $id)->where('user_id', Auth::id())->first();
            if(!$task) {
                abort(404);
            }

            $task->delete();

            DB::commit();

            return redirect()->route('tasks.index')
                ->with('success', 'Task deleted successfully.');
        } catch (\Throwable $t) {
            DB::rollback();

            Log::error($t->getMessage());

            return redirect()->route('tasks.index')
                ->with('error', 'Something went wrong, try again later.');
        }
    }

    /**
     * Check the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function check(int $id)
    {
        try {
            DB::beginTransaction();

            $task = Task::where('id', $id)->where('user_id', Auth::id())->first();
            if(!$task) {
                abort(404);
            }

            $task->completed = true;
            $task->save();

            DB::commit();

            return back()->with('success', 'Task checked successfully.');
        } catch (\Throwable $t) {
            DB::rollback();

            Log::error($t->getMessage());

            return back()->with('error', 'Something went wrong, try again later.');
        }
    }
}
