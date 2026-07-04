<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\Http\Request;

class ContactInquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactInquiry::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $inquiries = $query->paginate(20);
        $counts    = [
            'new'     => ContactInquiry::where('status', 'new')->count(),
            'read'    => ContactInquiry::where('status', 'read')->count(),
            'replied' => ContactInquiry::where('status', 'replied')->count(),
            'closed'  => ContactInquiry::where('status', 'closed')->count(),
            'all'     => ContactInquiry::count(),
        ];

        return view('admin.contact-inquiries.index', compact('inquiries', 'counts'));
    }

    public function show(ContactInquiry $contactInquiry)
    {
        if ($contactInquiry->status === 'new') {
            $contactInquiry->update(['status' => 'read']);
        }
        return view('admin.contact-inquiries.show', compact('contactInquiry'));
    }

    public function updateStatus(Request $request, ContactInquiry $contactInquiry)
    {
        $request->validate(['status' => 'required|in:new,read,replied,closed']);
        $contactInquiry->update(['status' => $request->status]);
        return back()->with('success', 'Status updated to ' . ucfirst($request->status) . '.');
    }

    public function destroy(ContactInquiry $contactInquiry)
    {
        $contactInquiry->delete();
        return redirect()->route('admin.contact-inquiries.index')->with('success', 'Inquiry deleted.');
    }
}
