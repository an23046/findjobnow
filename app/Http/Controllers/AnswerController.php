<?php

namespace App\Http\Controllers;
use App\Models\JobOffer;
use App\Models\Answer;
use App\Models\AnswersAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller {

  public function store(Request $request, JobOffer $job_offer)
  {
      $request->validate([
        'content' => 'required|string|max:255',
        'format' => 'nullable|mimes:pdf|max:10000'
      ]);

      // Find the recipe by ID
      $job_offer = JobOffer::findOrFail($job_offer->id);

      // Create a new comment
      $answer = new Answer();
      $answer->content = $request->content;
      $answer->user_id = auth()->id();
      $answer->job_offer_id = $job_offer->id;
      $answer->save();

      if ($request->hasFile('format')) {
        $path = $request->file('format')->store('pdfs', 'public');
        $attachment = new AnswersAttachment();
        $attachment->format = $path;
        $attachment->answer_id = $answer->id;
        $attachment->save();
      }

      // Redirect back to the recipe detail page
      return redirect()->route('job_offers.index')->with('success', 'Answer added successfully!');
  }

  
}
