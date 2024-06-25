<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    <title>Your Profile</title>
</head>
<body>
<!-- If auth, depending on user show: -->
@if (isset($user))
  <h1 class="text-2xl font-semibold">Hello {{$user->name}}!</h1>
<!-- Employee show -->
  @if ($user->hasRole('Employee'))
    <h2>Your applications:</h2>
    @foreach($answers as $answer)
      <div>
        <h1><a href="{{ route('job_offers.show', $answer->job_offer->id) }}"> {{$answer->job_offer->title}}</a></h1>
          <p>{{$answer->content}}</p>
          <p>Applied on: {{$answer->created_at->format("d.m.y H:i:s")}}</p>
          @if ($answer->attachment)
            <div>
                <a href="{{ Storage::url($answer->attachment->format) }}" target="_blank" class="btn btn-primary">Download Attachment</a>
            </div>
          @endif
      </div>
    @endforeach
  @endif
  @if ($user->hasRole('Employer')) 
    <h2>Your job offers:</h2>
    @foreach($jobs as $job)
      <div>
          <div>
            <h2><a href="{{ route('job_offers.show', $job->id) }}">
                {{ $job->title }}
            </a></h2>
            <p><strong>
                {{$job->category->title}}
            </strong></p>
            <small >
                {{$job->description}}
            </small>
              <p><form method="POST" action="{{ route('job_offers.destroy', $job->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="border-solid border-2">Delete job offer</button>
              </form></p>
              <p>
                <form method="GET" action="{{ route('job_offers.edit', $job->id) }}">
                  <button type="submit" class="border-solid border-2">Edit job offer</button>
                </form>
              </p>
              @if (isset($job->answers) && count($job->answers)>0)
                <div>
                  @foreach($job->answers as $answer)
                    <h3>Answer by {{$answer->user->name}}</h3>
                    <p>{{$answer->content}}</p>
                    <p>Published on: {{$job->created_at->format("d.m.y H:i:s")}}</p>
                    @if ($answer->attachment)
                      <div>
                          <a href="{{ Storage::url($answer->attachment->format) }}" target="_blank" class="btn btn-primary">Download Attachment</a>
                      </div>
                    @endif
                  @endforeach
                </div>
              @endif
          </div>
        </div>
    @endforeach
    <a href="{{ route('job_offers.create') }}" class="btn btn-primary border-solid border-2 ">Add new job offer</a>
  @endif
@endif


<script src="{{ asset('js/modal.js') }}"></script>
</body>
</html>