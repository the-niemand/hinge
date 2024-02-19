<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jobpost;
use App\Models\Jobapplication;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class JobsController extends Controller
{
    /**
     * Show the form for creating the resource.
     */
    public function create(): never
    {
        abort(404);
    }



    public function storeproposal(Request $request)
    {
        $data = $request->all();

        // Create the user record
        Jobapplication::create([
            'proposal' => $data['proposal'],
            'files' => $data['files'],
            'Hirer_id' => $data['Hirer_id'],
            'Freelancer_id' => $data['Freelancer_id'],
            'job_post_id' => $data['job_post_id'],

        ]);

        return response()->json(['message' => 'User created successfully'], 201);
    }
    /**
     * Store the newly created resource in storage.
     */
    public function storepost(Request $request)
    {
        $data = $request->all();

        // Create the user record
        Jobpost::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'target_country' => $data['target_country'],
            'Jtype' => $data['Jtype'],
            'Duration' => $data['Duration'],
            'price' => $data['price'],
            'level' => $data['level'],
            'skills_required' => $data['skills_required'],
            'Hirer_id' => $data['Hirer_id'],
            'Job_time' => $data['Job_time'],
        ]);

        return response()->json(['message' => 'User created successfully'], 201);
    }

    /**
     * Display the resource.
     */
    public function showbyskills()
    {
        $searchKeywords = request()->input('skills');
        $results = [];

        foreach ($searchKeywords as $keyword) {
            $keyword = trim($keyword);
            $result = DB::select("CALL bringjobsaccordingtoskills(?)", [$keyword]);
            if (!empty($result)) {
                array_push($results, $result);
            }
        }

        return response()->json($results);
    }

    public function showtalentsbyskills()
    {
        $searchKeywords = request()->input('skills');
        $results = [];

        foreach ($searchKeywords as $keyword) {
            $keyword = trim($keyword);
            $result = DB::select("CALL bringtalentsaccordingtoskills(?)", [$keyword]);
            if (!empty($result)) {
                array_push($results, $result);
            }
        }
        return response()->json($results);
    }





    public function showjobsproposal()
    {
        $job_post_id = request()->input('job_post_id');
        $job_post_id = intval($job_post_id);
        $result = DB::select("CALL bringjobsproposals(?)", [$job_post_id]);
        return response()->json($result);
    }





    public function showjobsbyhirerid()
    {
        $Hirer_id = request()->input('Hirer_id');
        $Hirer_id = intval($Hirer_id);
        $result = DB::select("CALL bringjobsandproposals(?)", [$Hirer_id]);
        return response()->json($result);
    }

    public function showjobsbyfreelancerid()
    {
        $Freelancer_id = request()->input('Freelancer_id');
        $Freelancer_id = intval($Freelancer_id);
        $result = DB::select("CALL bringjobsproposasedbyfreelancreid(?)", [$Freelancer_id]);
        return response()->json($result);
    }





    public function showbysearch()
    {
        $searchKeywords = request()->input('searchkeywords');
        $results = [];

        foreach ($searchKeywords as $keyword) {
            $keyword = trim($keyword);
            $result = DB::select("CALL bringjobsaccordingtoskills(?)", [$keyword]);
            if (!empty($result)) {
                array_push($results, $result);
            }
        }

        return response()->json($results);
    }



    public function show_precise($index)
    {
        $job = Jobpost::findOrFail($index);
        return response()->json($job);
    }


    public function show_talented($index)
    {
        $index = intval($index);
        $Talented = User::findOrFail($index);
        return response()->json($Talented);
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the resource in storage.
     */
    public function updateStatus()
    {
        $job_application_id = request()->input('jop_application_id');
        $is_true = request()->input('status');
        // $iia = null ; 


        $jobApplication = Jobapplication::find($job_application_id);

        if ($is_true == 'Declined') {
            $jobApplication->status = 'Declined';
        } else {
            $jobApplication->status = 'Accepted';
        }

        $jobApplication->save();

        return response()->json(['job_application_id' => $job_application_id, 'status' => $is_true]);
    }

    /**
     * Remove the resource from storage.
     */
    public function Deletepostjob()
    {
        $job_post_id = request()->input('job_post_id');

        // Delete related job applications first
        $deletedApplications = DB::table('jobapplication')->where('job_post_id', $job_post_id)->delete();

        // Check if related job applications were successfully deleted
        if ($deletedApplications !== null) {
            // Now, delete the job post
            $deletedPost = DB::table('jobpost')->where('job_post_id', $job_post_id)->delete();

            if ($deletedPost) {
                return response()->json(['message' => 'Job post and related applications deleted successfully']);
            } else {
                return response()->json(['error' => 'Failed to delete job post']);
            }
        } else {
            return response()->json(['error' => 'Failed to delete related job applications']);
        }
    }
}
