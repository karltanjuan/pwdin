<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Validator;
use Session;
use Storage;
use App\Models\Admin;
use App\Models\Job;
use App\Models\Application;
use App\Models\Employer;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index() {
        $id = auth()->guard('admins')->user()->id;

        $total_applicants = Application::count();
        $total_hired      = Application::where('status', 'Hired')->count();
        $total_rejected   = Application::where('status', 'Rejected')->count();

        $total_jobs = Job::count();
        $total_jobs_open = Job::where('status', 1)->count();
        $total_jobs_closed = Job::where('status', 0)->count();
        $job_applications = Application::with('job')
                                ->with('applicant')
                                ->get();

        $total_employer_pending  = Employer::where('status', 0)->count();
        $total_employer_approved = Employer::where('status', 1)->count();
        $total_employer_rejected = Employer::where('status', 2)->count();

        $total_applicant_pending  = User::where('status', 0)->count();
        $total_applicant_approved = User::where('status', 1)->count();
        $total_applicant_rejected = User::where('status', 2)->count();

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

        $total_male = Application::whereHas('applicant', function ($query) use ($id) {
                    $query->where('gender', 'Male');
                  })->count();

        $total_female = Application::whereHas('applicant', function ($query) use ($id) {
                    $query->where('gender', 'Female');
                  })->count();

        return view('admin.dashboard', compact(
            'total_applicants',
            'total_hired',
            'total_rejected',
            'total_jobs',
            'total_jobs_open',
            'total_jobs_closed',
            'category_result',
            'total_employer_approved',
            'total_employer_pending',
            'total_employer_rejected',
            'total_applicant_approved',
            'total_applicant_pending',
            'total_applicant_rejected',
            'total_male',
            'total_female'

        ));
    }
}
