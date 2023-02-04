<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Script -->
    <script src="{{ asset('javascript/app.js') }}"></script>
</head>

<body>
    @if (session()->has('alert'))
        <div class="delete-alert">
            {{ session()->get('alert') }}
        </div>
    @endif
    <section class="main">
        <div class="AddTaskForm">
            <div class="ImageDiv">
                <div class="TitleSlogon">
                    <h1 class="BigTitle">TaskMaster</h1>
                    <p>Stay organized, Stay on top of life, Use TaskMaster.</p>
                </div>
                <img class="imgClass" src="/imgs/Liste.png" alt="ChekinListImage">
            </div>
            <form action="{{ route('saveItem') }}" method="POST">
                @csrf
                <div class="addItemForm">
                    <label for="listItem">New Thing To Do</label>
                    <br />
                    <input type="text" name="listItem" placeholder="Add Task..." />
                    <br />
                    <button type="submit">Add Item</button>
                </div>
            </form>
        </div>
        <div class="all">
            <h1> Done...</h1>
            <div class="completedItems">
                @foreach ($listItems as $listItem)
                    @if ($listItem->is_complete == 1)
                        <div class="completedItem">
                            <div class="CompletedTaskNameIcon">
                                <p>{{ svg('feathericon-check-circle') }}</p>
                                <p> {{ $listItem->name }}</p>
                            </div>
                            <div class="time">
                                <p>{{ $listItem->updated_at->format('D, d-M') }}</p>
                                <p class="timeP">{{ $listItem->updated_at->format('H:i') }}</p>
                            </div>
                            <form action="{{ route('deleteComplete', $listItem->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    @endif
                @endforeach
            </div>
            <hr>
            <div class="NewItemDiv">
                <h1> On Hold...</h1>
                @foreach ($listItems as $listItem)
                    @if ($listItem->is_complete == 0)
                        <div class="NewItem">
                            <p> {{ $listItem->name }}</p>
                            <div class="time">
                                <p>{{ $listItem->created_at->format('D, d-M') }}</p>
                                <p class="timeP">{{ $listItem->created_at->format('H:i') }}</p>
                            </div>
                            <form action="{{ route('markComplete', $listItem->id) }}" method="POST">
                                @csrf
                                <button type="submit"> Mark Completed </button>
                            </form>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
</body>

</html>
