<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;
use Response;
use File;

class MainController extends Controller
{
    //
    public function e_profile(Request $request)
    {
        $url = route('e-profile');
        $request->session()->put('current_url', $url);

        return view('employee.profile');
    }

    public function e_dashboard(Request $request)
    {
        // $url = route('e-dashboard');
        // $request->session()->put('current_url', $url);

        // return view('employee.dashboard');

        if (Auth::user()->user_type != 'Administrator')
        {
            $url = route('e-dashboard');
            $request->session()->put('current_url', $url);
            // return view('employee.dashboard');

            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            return view('employee.dashboard')->with('tasks', $user->tasks);
        }
        else{
            $url = route('a-dashboard');
            $request->session()->put('current_url', $url);

            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            return redirect()->route('a-dashboard')->with('tasks', $user->tasks);
        }
    }

    public function a_dashboard(Request $request)
    {
        $url = route('a-dashboard');
        $request->session()->put('current_url', $url);

        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $users = User::orderBy('created_at', 'desc')->get();     //or "asc"
        return view('admin.dashboard')->with('users', $users);
    }

    // public function exportCsv(Request $request)
    // {
    //     $fileName = 'tasks.csv';
    //     $tasks = Task::all();

    //     $headers = array(
    //         "Content-type"        => "text/csv",
    //         "Content-Disposition" => "attachment; filename=$fileName",
    //         "Pragma"              => "no-cache",
    //         "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
    //         "Expires"             => "0"
    //     );

    //     $columns = array('Title', 'Assign', 'Description', 'Start Date', 'Due Date');

    //     $callback = function() use($tasks, $columns) {
    //         $file = fopen('php://output', 'w');
    //         fputcsv($file, $columns);

    //         foreach ($tasks as $task) {
    //             $row['Todo']  = $task->todo;

    //             fputcsv($file, array($row['Todo']));
    //         }

    //         fclose($file);
    //     };

    //     return response()->stream($callback, 200, $headers);
    //     // return Response::download($fileName, 'tasks.csv', $headers);
    // }

        

    public function user_export(){

        $users = User::get();

        // these are the headers for the csv file.
        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Disposition' => 'attachment; filename=download.csv',
            'Expires' => '0',
            'Pragma' => 'public',
        );


        //I am storing the csv file in public >> files folder. So that why I am creating files folder
        if (!File::exists(public_path()."/files")) {
            File::makeDirectory(public_path() . "/files");
        }

        //creating the download file
        $filename =  public_path("files/users_details.csv");
        $handle = fopen($filename, 'w');

        //adding the first row
        fputcsv($handle, [
            "Name",
            "Email",
            "phone",
            "gender",
            "age",
            "company",
            "address",
        ]);

        //adding the data from the array
        foreach ($users as $each_user) {
            fputcsv($handle, [
                $each_user->name,
                $each_user->email,
                $each_user->profiles->phone ?? "N/A",
                $each_user->profiles->gender ?? "N/A",
                $each_user->profiles->age ?? "N/A",
                $each_user->profiles->company ?? "N/A",
                $each_user->profiles->address ?? "N/A",
            ]);

        }
        fclose($handle);

        //download command
        return Response::download($filename, "users_details.csv", $headers);
    }


    public function task_export(){

        $tasks = Auth::user()->tasks;

        // these are the headers for the csv file.
        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Disposition' => 'attachment; filename=download.csv',
            'Expires' => '0',
            'Pragma' => 'public',
        );


        //I am storing the csv file in public >> files folder. So that why I am creating files folder
        if (!File::exists(public_path()."/files")) {
            File::makeDirectory(public_path() . "/files");
        }

        //creating the download file
        $filename =  public_path("files/tasks.csv");
        $handle = fopen($filename, 'w');

        //adding the first row
        fputcsv($handle, [
            "Todo",
        ]);

        //adding the data from the array
        foreach ($tasks as $each_task) {
            fputcsv($handle, [
                $each_task->todo,
            ]);

        }
        fclose($handle);

        //download command
        return Response::download($filename, "tasks.csv", $headers);
    }
}
