<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\ContactInquiry;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $messagesCount = ContactInquiry::count();
        $productsCount = Product::count();
        $servicesCount = Service::count();
        $blogPostsCount = BlogPost::count();

        $users = User::latest()->get();
        $contactInquiries = ContactInquiry::latest()->get();
        $settings = Setting::allKeyed();

        $dbMessages = $contactInquiries->map(function ($i) {
            return [
                'id' => $i->id,
                'from' => $i->name,
                'email' => $i->email,
                'subject' => $i->subject ?? 'Inquiry',
                'time' => $i->created_at->format('H:i'),
                'body' => $i->message,
                'read' => $i->status !== 'new',
            ];
        })->values()->all();

        return view('admin.dashboard', compact(
            'usersCount',
            'messagesCount',
            'productsCount',
            'servicesCount',
            'blogPostsCount',
            'users',
            'contactInquiries',
            'dbMessages',
            'settings'
        ));
    }
}
