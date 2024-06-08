<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Election</title>
</head>
<body>
    <h1>Create Election</h1>
    <form action="{{ route('elections.create') }}" method="post">
        @csrf
        <div>
            <label for="title">Election name:</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" required>
        </div>
        <div>
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" required>
        </div>
        <button type="submit">Create Election</button>
    </form>
</body>
</html>
