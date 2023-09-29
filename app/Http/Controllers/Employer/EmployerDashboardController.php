<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Validator;
use Session;
use Storage;
use App\Models\Employer;
use App\Models\Job;
use App\Models\Application;
use Carbon\Carbon;


class EmployerDashboardController extends Controller
{
    public function index() {
        $id = auth()->guard('employers')->user()->id;

        $total_applicants = Application::whereHas('job', function ($query) use ($id) {
                                $query->where('employer_id', '=', $id);
                            })
                            ->count();

        $total_hired = Application::where('status', 'Hired')
                        ->whereHas('job', function ($query) use ($id) {
                            $query->where('employer_id', '=', $id);
                        })
                        ->count();

        $total_rejected = Application::where('status', 'Rejected')
                        ->whereHas('job', function ($query) use ($id) {
                            $query->where('employer_id', '=', $id);
                        })
                        ->count();

        $total_jobs = Job::where('employer_id', $id)->count();
        $total_jobs_open = Job::where('employer_id', $id)->where('status', 1)->count();
        $total_jobs_closed = Job::where('employer_id', $id)->where('status', 0)->count();

        $job_applications = Application::whereHas('job', function ($query) use ($id) {
                                    $query->where('employer_id', '=', $id);
                                })
                                ->with('job')
                                ->with('applicant')
                                ->get();

        $all_categories = [];
        foreach ($job_applications as $application) {
            $job_categories = explode(',', $application->job->pwd_categories);
            $applicant_categories = explode(',', $application->applicant->pwd_categories);

            $all_categories = array_merge($all_categories, $job_categories, $applicant_categories);
        }
        $all_categories = array_unique($all_categories);

        // Define the default categories
        $default_categories = [
            'Psychosocial', 'Mental', 'Chronic illness', 'Learning',
            'Visual', 'Orthopedic', 'Communication'
        ];

        // Merge the default categories with all categories
        $categories_for_count = array_merge($default_categories, $all_categories);
        $categories_for_count = array_unique($categories_for_count);

        // Initialize an array to store the category counts
        $category_counts = [];

        // Initialize the category counts with zeros for all categories
        foreach ($categories_for_count as $category) {
            $category_counts[$category] = 0;
        }

        // Loop through the job applications
        foreach ($job_applications as $application) {
            $job_categories = explode(',', $application->job->pwd_categories);
            $applicant_categories = explode(',', $application->applicant->pwd_categories);

            // Loop through the applicant's categories and check if they match job categories
            foreach ($applicant_categories as $applicant_category) {
                if (in_array($applicant_category, $job_categories)) {
                    // Increment the count for the matched category
                    $category_counts[$applicant_category]++;
                }
            }
        }

        // Transform the category counts into the desired format for Morris.js
        $category_result = [];
        foreach ($category_counts as $category => $count) {
            $category_result[] = ['category' => $category, 'count' => $count];
        }

        return view('employer.dashboard', compact(
            'total_applicants',
            'total_hired',
            'total_rejected',
            'total_jobs',
            'total_jobs_open',
            'total_jobs_closed',
            'category_result'
        ));
    }
}
