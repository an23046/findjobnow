<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$job->title}}</title>
</head>
<body>
    <div>
        <h1>{{$job->title}}</h1>
        <h2>{{$job->author}}</h2>
        <p>{{$job->category->title}}</p>
        <p>{{$job->description}}</p>
        <p>Published at:{{$job->created_at->format("d.m.y H:i:s")}}</p>
    </div>
    @if (isset($user))
        @if ($user->hasRole('Employee')) 
            <form method="POST" action="{{ route('answers.store', $job->id)}}" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="content">Content:</label>
                    <textarea id="content" name="content" required cols="80" rows="20" placeholder="Leave your answer here...">{{ old('content') }}</textarea>
                </div>

                <div>
                    <label for="format">Attach PDF</label>
                    <input type="file" name="format" id="format" class="form-control-file" accept="application/pdf">
                </div>

                <button type="submit" id="answer-btn" class="btn">Apply</button>
            </form>
        @endif
    @endif
</body>
</html>