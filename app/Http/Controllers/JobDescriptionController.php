<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use App\Models\JobDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobDescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (Auth::user()->type=="HR" || Auth::user()->type=="Director" || Auth::user()->type == "company") {
            $jobDescriptions = JobDescription::where('workspace', '=', getActiveWorkSpace())->get();
        } else {
            $jobDescriptions = JobDescription::where('workspace', '=', getActiveWorkSpace())->where('created_by', '=', Auth::user()->id)->get();
        }
        return view('jobDescription.index', compact('jobDescriptions'));
    }

    public function create()
    {
        return view('jobDescription.create');
    }

    public function store(Request $request)
    {
        $jobDescription = new JobDescription();
        $jobDescription->title = $request->jobTitle;
        $jobDescription->description = $request->jobDescription;
        $jobDescription->start_date = $request->start_date;
        $jobDescription->end_date = $request->end_date;
        $jobDescription->workspace = getActiveWorkSpace();
        $jobDescription->created_by = Auth::user()->id;
        $jobDescription->save();
        if (Auth::user()->managedUsers()->exists()) {
            $jobDescription = JobDescription::where('workspace', '=', getActiveWorkSpace())->where('created_by', '=', Auth::user()->id)->get();
        } else {
            $jobDescription = JobDescription::where('workspace', '=', getActiveWorkSpace())->get();
        }
        $resp = EmailTemplate::sendEmailTemplate('New Job Description Added', [$request->employee_id => "hr@jbdspower.com"], []);
        $resp = EmailTemplate::sendEmailTemplate('New Job Description Added', [$request->employee_id => "amit.duhan@jbdspower.com"], []);

        return redirect()->route('jobDescription.index')->with('success', __('Job Description successfully created.'));
    }

    public function edit($id)
    {
        $jobDescription = JobDescription::where('id', '=', $id)->first();
        return view('jobDescription.edit', compact('jobDescription'));
    }

    public function update($id, Request $request)
    {
        $jobDescription = JobDescription::where('id', '=', $id)->first();
        $jobDescription->title = $request->jobTitle;
        $jobDescription->description = $request->jobDescription;
        $jobDescription->start_date = $request->start_date;
        $jobDescription->end_date = $request->end_date;
        $jobDescription->save();
        return redirect()->route('jobDescription.index')->with('success', __('Job Description successfully updated.'));
    }

    public function delete($id)
    {
        JobDescription::where('id', '=', $id)->delete();
        return redirect()->route('jobDescription.index')->with('success', __('Job Description successfully deleted.'));
    }

    public function schedule($id)
    {
        $jobDescription = JobDescription::where('id', '=', $id)->first();
        return view('jobDescription.schedule', compact('jobDescription'));
    }

    public function hiring($id)
    {
        $jobDescription = JobDescription::where('id', '=', $id)->first();
        return view('jobDescription.hiring', compact('jobDescription'));
    }

    public function updateStatus(Request $request, $id){
        $jobDescription = JobDescription::where('id', '=', $id)->first();
        $jobDescription->selected_candidates = $request->selected_candidates;
        $jobDescription->status = "Closed";
        $jobDescription->save();
        return redirect()->route('jobDescription.index')->with('success', __('Job Description status successfully updated.'));
    }

    public function hraction($id, Request $request)
    {
        $jobDescription = JobDescription::where('id', '=', $id)->first();
        $jobDescription->inteviews_scheduled = $request->interview_number;
        $jobDescription->save();
        return redirect()->route('jobDescription.index')->with('success', __('Job Description successfully updated.'));
    }

    public function view($id)
    {
        $jobDescription = JobDescription::where('id', '=', $id)->first();
        return view('jobDescription.view', compact('jobDescription'));
    }

    public function adminaction($id,Request $request)
    {
        $jobDescription = JobDescription::where('id', '=', $id)->first();
        $jobDescription->status = $request->status;
        $jobDescription->save();
        return redirect()->route('jobDescription.index')->with('success', __('Job Description status successfully updated.'));
    }

    public function hiringReOpen($id){
        $jobDescription = JobDescription::where('id', '=', $id)->first();
        $jobDescription->selected_candidates = "";
        $jobDescription->inteviews_scheduled = 0;
        $jobDescription->status = "ReOpen";
        $jobDescription->save();

        return redirect()->route('jobDescription.index')->with('success', __('Job Description successfully updated.'));
    }
}
