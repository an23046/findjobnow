<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Job Offer</title>
</head>
<body>
    <h1>Edit Job Offer</h1>

    <form action="{{ route('job_offers.update', $job->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Job title:</label>
            <input type="text" id="title" name="title" value="{{ $job->title }}" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required cols="80" rows="20">{{ $job->description }}</textarea>
        </div>

        <div>
            <label for="company_name">Company name:</label>
            <input type="text" id="company_name" name="company_name" value="{{ $job->company_name }}" required>
        </div>

        <div>
            <label for="category">Category:</label>
            <select id="category" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $job->category_id ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="salary">Salary:</label>
            <input type="number" id="salary" name="salary" value="{{$job->salary}}" required>
        </div>

        <button type="submit">Update</button>
    </form>

</body>
</html>