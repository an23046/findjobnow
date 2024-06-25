<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobOffer;
use App\Models\Answer;
use App\Models\Category;
use App\Models\AnswersAttachment;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class JobOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $jobs = JobOffer::when($request->has('category'), function ($query) use ($request) {
        return $query->where('category_id', $request->input('category'));
      })->get();

      // $jobs = JobOffer::all()->sortByDesc('created_at');
      $categories = Category::all()->keyBy('id');

      // $categories = Category::all()->keyBy('id');
      return view('job_offers.index', compact('jobs', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            abort(403);
        }

        $categories = Category::all();

        return view('job_offers.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categories = Category::all();
        $user = Auth::user();

        if ($user->hasRole('Employee')) {
            return redirect()->route('job_offers.create', compact('categories'))->with('error', 'Failed to create post. Please try again.');
        }

        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'company_name' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|numeric|between:800,3000'
        ]);

        $jobOffer = JobOffer::create([
            'title' => $validateData['title'],
            'category_id' => $validateData['category_id'],
            'company_name' => $validateData['company_name'],
            'description' => $validateData['description'],
            'salary' => $validateData['salary'],
            'user_id' => $user->id
        ]);

        return redirect()->route('job_offers.show', $jobOffer->id)->with('success', 'Offer has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $job = JobOffer::find($id);
        return view('job_offers.show', compact('job','user'));
    }

    /**
     * Remove the specified resource from storage.
     */

    public function edit($id)
    {
        $job = JobOffer::findOrFail($id);
        $categories = Category::all();

        return view('job_offers.edit', compact('job', 'categories'));
    }
 
    public function update(Request $request, $id)
    {

        $job = JobOffer::findOrFail($id);

        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'company_name' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|numeric|between:800,3000'
        ]);


        $job->title = $validateData['title'];
        $job->category_id = $validateData['category_id'];
        $job->company_name = $validateData['company_name'];
        $job->description = $validateData['description'];
        $job->salary = $validateData['salary'];
        $job->save();

        return redirect()->route('profile.show')->with('success', 'Job offer updated');
    }

    public function destroy(string $id)
    {
        JobOffer::findOrfail($id)->delete();
        return redirect()->route('profile.show');
    }
}
