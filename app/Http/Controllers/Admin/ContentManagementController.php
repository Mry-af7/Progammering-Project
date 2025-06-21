<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ContentManagementController extends Controller
{
    public function index()
    {
        $content = [
            'pages' => Page::orderBy('title')->get(),
            'faqs' => Faq::orderBy('order')->get(),
            'announcements' => Announcement::latest()->take(10)->get(),
            'siteSettings' => $this->getSiteSettings(),
        ];

        return Inertia::render('Admin/ContentManagement', [
            'content' => $content,
            'stats' => [
                'totalPages' => Page::count(),
                'totalFaqs' => Faq::count(),
                'activeAnnouncements' => Announcement::where('is_active', true)->count(),
                'lastUpdated' => Page::latest('updated_at')->first()?->updated_at,
            ]
        ]);
    }

    public function updatePage(Request $request, $pageId = null)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $pageId,
            'content' => 'required|string',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string',
            'is_published' => 'boolean',
            'show_in_nav' => 'boolean',
        ]);

        $pageData = [
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'content' => $request->content,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'is_published' => $request->boolean('is_published'),
            'show_in_nav' => $request->boolean('show_in_nav'),
            'updated_by' => auth()->id(),
        ];

        if ($pageId) {
            $page = Page::findOrFail($pageId);
            $page->update($pageData);
            $message = "Page '{$page->title}' updated successfully";
        } else {
            $pageData['created_by'] = auth()->id();
            $page = Page::create($pageData);
            $message = "Page '{$page->title}' created successfully";
        }

        // Log the action
        \Log::info('Page ' . ($pageId ? 'updated' : 'created') . ' by admin', [
            'admin_id' => auth()->id(),
            'page_id' => $page->id,
            'page_title' => $page->title,
            'action' => $pageId ? 'update' : 'create'
        ]);

        return back()->with('success', $message);
    }

    public function deletePage(Page $page)
    {
        $pageTitle = $page->title;
        $page->delete();

        // Log the deletion
        \Log::warning('Page deleted by admin', [
            'admin_id' => auth()->id(),
            'page_title' => $pageTitle
        ]);

        return back()->with('success', "Page '{$pageTitle}' deleted successfully");
    }

    public function updateFaq(Request $request, $faqId = null)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:100',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $faqData = [
            'question' => $request->question,
            'answer' => $request->answer,
            'category' => $request->category,
            'order' => $request->order ?? 0,
            'is_active' => $request->boolean('is_active'),
            'updated_by' => auth()->id(),
        ];

        if ($faqId) {
            $faq = Faq::findOrFail($faqId);
            $faq->update($faqData);
            $message = "FAQ updated successfully";
        } else {
            $faqData['created_by'] = auth()->id();
            $faq = Faq::create($faqData);
            $message = "FAQ created successfully";
        }

        // Log the action
        \Log::info('FAQ ' . ($faqId ? 'updated' : 'created') . ' by admin', [
            'admin_id' => auth()->id(),
            'faq_id' => $faq->id,
            'action' => $faqId ? 'update' : 'create'
        ]);

        return back()->with('success', $message);
    }

    public function deleteFaq(Faq $faq)
    {
        $faq->delete();

        // Log the deletion
        \Log::warning('FAQ deleted by admin', [
            'admin_id' => auth()->id(),
            'faq_id' => $faq->id
        ]);

        return back()->with('success', 'FAQ deleted successfully');
    }

    public function reorderFaqs(Request $request)
    {
        $request->validate([
            'faqs' => 'required|array',
            'faqs.*.id' => 'required|exists:faqs,id',
            'faqs.*.order' => 'required|integer|min:0',
        ]);

        foreach ($request->faqs as $faqData) {
            Faq::where('id', $faqData['id'])->update(['order' => $faqData['order']]);
        }

        return back()->with('success', 'FAQ order updated successfully');
    }

    public function updateAnnouncement(Request $request, $announcementId = null)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:info,warning,success,error',
            'is_active' => 'boolean',
            'show_on_dashboard' => 'boolean',
            'expires_at' => 'nullable|date|after:now',
        ]);

        $announcementData = [
            'title' => $request->title,
            'content' => $request->content,
            'type' => $request->type,
            'is_active' => $request->boolean('is_active'),
            'show_on_dashboard' => $request->boolean('show_on_dashboard'),
            'expires_at' => $request->expires_at,
            'updated_by' => auth()->id(),
        ];

        if ($announcementId) {
            $announcement = Announcement::findOrFail($announcementId);
            $announcement->update($announcementData);
            $message = "Announcement '{$announcement->title}' updated successfully";
        } else {
            $announcementData['created_by'] = auth()->id();
            $announcement = Announcement::create($announcementData);
            $message = "Announcement '{$announcement->title}' created successfully";
        }

        // Log the action
        \Log::info('Announcement ' . ($announcementId ? 'updated' : 'created') . ' by admin', [
            'admin_id' => auth()->id(),
            'announcement_id' => $announcement->id,
            'announcement_title' => $announcement->title,
            'action' => $announcementId ? 'update' : 'create'
        ]);

        return back()->with('success', $message);
    }

    public function deleteAnnouncement(Announcement $announcement)
    {
        $announcementTitle = $announcement->title;
        $announcement->delete();

        // Log the deletion
        \Log::warning('Announcement deleted by admin', [
            'admin_id' => auth()->id(),
            'announcement_title' => $announcementTitle
        ]);

        return back()->with('success', "Announcement '{$announcementTitle}' deleted successfully");
    }

    public function updateSiteSettings(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'contact_email' => 'required|email',
            'support_email' => 'nullable|email',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'social_facebook' => 'nullable|url',
            'social_twitter' => 'nullable|url',
            'social_linkedin' => 'nullable|url',
            'social_instagram' => 'nullable|url',
            'maintenance_mode' => 'boolean',
            'maintenance_message' => 'nullable|string',
            'allow_registration' => 'boolean',
            'allow_company_registration' => 'boolean',
            'require_email_verification' => 'boolean',
            'max_file_upload_size' => 'integer|min:1|max:100',
            'session_timeout' => 'integer|min:15|max:1440',
        ]);

        $settings = $request->except(['_token', '_method']);

        foreach ($settings as $key => $value) {
            $this->updateSetting($key, $value);
        }

        // Log the settings update
        \Log::info('Site settings updated by admin', [
            'admin_id' => auth()->id(),
            'updated_settings' => array_keys($settings)
        ]);

        return back()->with('success', 'Site settings updated successfully');
    }

    public function uploadMedia(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx|max:10240', // 10MB max
            'type' => 'required|in:image,document',
            'alt_text' => 'nullable|string|max:255',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        
        // Store in appropriate directory
        $directory = $request->type === 'image' ? 'images' : 'documents';
        $path = $file->storeAs("public/media/{$directory}", $fileName);

        // Save media record (if you have a Media model)
        $media = [
            'filename' => $fileName,
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'type' => $request->type,
            'size' => $file->getSize(),
            'alt_text' => $request->alt_text,
            'uploaded_by' => auth()->id(),
        ];

        // Log the upload
        \Log::info('Media uploaded by admin', [
            'admin_id' => auth()->id(),
            'filename' => $fileName,
            'type' => $request->type,
            'size' => $file->getSize()
        ]);

        return response()->json([
            'success' => true,
            'media' => $media,
            'url' => asset("storage/media/{$directory}/{$fileName}")
        ]);
    }

    public function getPageContent($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        
        return response()->json([
            'page' => $page
        ]);
    }

    public function bulkUpdateFaqs(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete,change_category',
            'faq_ids' => 'required|array',
            'faq_ids.*' => 'exists:faqs,id',
            'category' => 'required_if:action,change_category|string|max:100',
        ]);

        $faqIds = $request->faq_ids;
        $action = $request->action;
        $affectedCount = 0;

        switch ($action) {
            case 'activate':
                $affectedCount = Faq::whereIn('id', $faqIds)->update(['is_active' => true]);
                break;
                
            case 'deactivate':
                $affectedCount = Faq::whereIn('id', $faqIds)->update(['is_active' => false]);
                break;
                
            case 'delete':
                $affectedCount = Faq::whereIn('id', $faqIds)->delete();
                break;
                
            case 'change_category':
                $affectedCount = Faq::whereIn('id', $faqIds)->update(['category' => $request->category]);
                break;
        }

        // Log bulk action
        \Log::info('Bulk FAQ action performed', [
            'admin_id' => auth()->id(),
            'action' => $action,
            'faq_ids' => $faqIds,
            'affected_count' => $affectedCount
        ]);

        return back()->with('success', "Bulk action '{$action}' performed on {$affectedCount} FAQs");
    }

    private function getSiteSettings()
    {
        // This assumes you have a settings table or config
        // You might want to implement this based on your settings storage method
        return [
            'site_name' => config('app.name', 'Laravel'),
            'site_description' => 'A platform connecting students and companies',
            'contact_email' => config('mail.from.address', 'admin@example.com'),
            'support_email' => 'support@example.com',
            'phone' => '+1234567890',
            'address' => '123 Main St, City, Country',
            'social_facebook' => 'https://facebook.com/yourpage',
            'social_twitter' => 'https://twitter.com/yourhandle',
            'social_linkedin' => 'https://linkedin.com/company/yourcompany',
            'social_instagram' => 'https://instagram.com/yourhandle',
            'maintenance_mode' => false,
            'maintenance_message' => 'We are currently under maintenance. Please check back later.',
            'allow_registration' => true,
            'allow_company_registration' => true,
            'require_email_verification' => true,
            'max_file_upload_size' => 10, // MB
            'session_timeout' => 120, // minutes
        ];
    }

    private function updateSetting($key, $value)
    {
        // Implement your settings storage logic here
        // This could be database, config files, cache, etc.
        // For example, if using a settings table:
        
        // Setting::updateOrCreate(
        //     ['key' => $key],
        //     ['value' => $value, 'updated_by' => auth()->id()]
        // );
        
        // Or if using config:
        // config([$key => $value]);
    }
}