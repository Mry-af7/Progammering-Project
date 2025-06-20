<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Industry;
use App\Models\CompanySize;
use App\Models\CompanyBenefit;
use App\Models\CompanyTechnology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class CompanyOnboardingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
        
        if (!$company) {
            $company = Company::create([
                'user_id' => $user->id,
                'email' => $user->email,
                'onboarding_completed' => false,
            ]);
        }

        return Inertia::render('Company/Onboarding/CompanyBasics', [
            'company' => $company,
            'currentStep' => 1,
            'totalSteps' => 6,
            'industries' => Industry::all(),
            'companySizes' => CompanySize::all(),
        ]);
    }

    public function showStep($step)
    {
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();

        // If company doesn't exist, create one
        if (!$company) {
            $company = Company::create([
                'user_id' => $user->id,
                'email' => $user->email,
                'onboarding_completed' => false,
            ]);
        }

        // Redirect to dashboard if onboarding is already completed
        if ($company->onboarding_completed) {
            return redirect()->route('company.dashboard');
        }

        $data = [
            'company' => $company,
            'currentStep' => (int)$step,
            'totalSteps' => 6,
        ];

        switch ($step) {
            case '2':
                return Inertia::render('Company/Onboarding/CompanyDetails', $data);
            case '3':
                $data['technologies'] = CompanyTechnology::all();
                $data['companyTechnologies'] = $company->technologies ?? collect();
                return Inertia::render('Company/Onboarding/CompanyTech', $data);
            case '4':
                $data['benefits'] = CompanyBenefit::all();
                $data['companyBenefits'] = $company->benefits ?? collect();
                return Inertia::render('Company/Onboarding/CompanyBenefits', $data);
            case '5':
                return Inertia::render('Company/Onboarding/CompanyMedia', $data);
            case '6':
                return Inertia::render('Company/Onboarding/Review', $data);
            default:
                $data['industries'] = Industry::all();
                $data['companySizes'] = CompanySize::all();
                return Inertia::render('Company/Onboarding/CompanyBasics', $data);
        }
    }

    public function storeBasics(Request $request)
    {
        \Log::info('=== COMPANY BASICS SUBMISSION ===');
        \Log::info('Form data received:', $request->all());
        
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'industry_id' => 'required|exists:industries,id',
                'company_size_id' => 'required|exists:company_sizes,id',
                'website' => 'nullable|url|max:255',
                'founded_year' => 'nullable|integer|min:1800|max:' . date('Y'),
                'headquarters' => 'nullable|string|max:255',
            ]);
            
            \Log::info('Validation passed:', $validated);
            
            $user = Auth::user();
            $company = Company::where('user_id', $user->id)->first();
            
            $company->update($validated);
            
            \Log::info('Company updated successfully, redirecting to step 2');
            
            return redirect()->route('company.onboarding.step', 2)
                ->with('message', 'Company basics saved successfully!');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed:', ['errors' => $e->errors()]);
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Unexpected error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function storeDetails(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:2000',
            'mission_statement' => 'nullable|string|max:1000',
            'company_culture' => 'nullable|string|max:1000',
            'remote_policy' => 'required|in:fully_remote,hybrid,office_only',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'glassdoor_url' => 'nullable|url|max:255',
        ]);

        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
        
        $company->update($validated);

        return redirect()->route('company.onboarding.step', 3)
            ->with('message', 'Company details saved successfully!');
    }

    public function storeTech(Request $request)
    {
        $validated = $request->validate([
            'technologies' => 'required|array|min:1',
            'technologies.*' => 'exists:company_technologies,id'
        ]);

        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();

        // Sync technologies
        $company->technologies()->sync($validated['technologies']);

        return redirect()->route('company.onboarding.step', 4)
            ->with('message', 'Tech stack saved successfully!');
    }

    public function storeBenefits(Request $request)
    {
        $validated = $request->validate([
            'benefits' => 'required|array|min:1',
            'benefits.*' => 'exists:company_benefits,id'
        ]);

        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();

        // Sync benefits
        $company->benefits()->sync($validated['benefits']);

        return redirect()->route('company.onboarding.step', 5)
            ->with('message', 'Benefits saved successfully!');
    }

    public function storeMedia(Request $request)
    {
        $validated = $request->validate([
            'logo_url' => 'nullable|url|max:255',
            'cover_image_url' => 'nullable|url|max:255',
            'video_url' => 'nullable|url|max:255',
            'office_photos' => 'nullable|array|max:5',
            'office_photos.*' => 'url|max:255',
        ]);

        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
        
        $company->update($validated);

        return redirect()->route('company.onboarding.step', 6)
            ->with('message', 'Media uploaded successfully!');
    }

    public function complete(Request $request)
    {
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
        
        // Mark onboarding as completed
        $company->update([
            'onboarding_completed' => true,
            'profile_completed_at' => now(),
        ]);

        return redirect()->route('company.dashboard')
            ->with('message', 'Welcome! Your company profile is now live and ready to attract top talent!');
    }
}