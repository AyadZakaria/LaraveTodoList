<?php
namespace App\Http\Controllers;
use log;
use App\Models\ListItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TodoListController extends Controller
{
    public function index()
    {
        return view('welcome', ['listItems' => ListItem::all()]);
    }
    public function saveItem(Request $request)
    {
        $newListItem = new ListItem;
        $newListItem->name = $request->listItem;
        $newListItem->is_complete = 0;
        $newListItem->save();
        return redirect('/');
    }
    public function markComplete($id)
    {
        $lisItem = ListItem::find($id);
        $lisItem->is_complete = 1;
        $lisItem->save();
        return redirect('/');
    }
    public function deleteComplete($id)
    {
        $lisItem = ListItem::find($id);
        $lisItem->delete();
        // Set alert message
        $message = 'Task Deleted Successfully ';
        session()->flash('alert', $message);
        return Redirect::back();
    }
}