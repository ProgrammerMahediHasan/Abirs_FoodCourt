<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index()
    {
        // Mock data for inbox to make it look realistic
        $emails = [
            [
                'id' => 1,
                'sender' => 'John Doe',
                'subject' => 'Weekly Report',
                'preview' => 'Here is the weekly report for the restaurant operations...',
                'time' => '10:30 AM',
                'starred' => false,
                'unread' => true,
                'avatar_color' => 'primary'
            ],
            [
                'id' => 2,
                'sender' => 'Jane Smith',
                'subject' => 'New Menu Items',
                'preview' => 'We should discuss the new menu items for next season...',
                'time' => 'Yesterday',
                'starred' => true,
                'unread' => false,
                'avatar_color' => 'warning'
            ],
            [
                'id' => 3,
                'sender' => 'Support Team',
                'subject' => 'System Maintenance',
                'preview' => 'Scheduled maintenance will occur on Sunday at 2 AM...',
                'time' => 'Feb 15',
                'starred' => false,
                'unread' => true,
                'avatar_color' => 'danger'
            ],
            [
                'id' => 4,
                'sender' => 'Supplier X',
                'subject' => 'Invoice #12345',
                'preview' => 'Please find attached the invoice for the latest delivery...',
                'time' => 'Feb 14',
                'starred' => false,
                'unread' => false,
                'avatar_color' => 'success'
            ],
            [
                'id' => 5,
                'sender' => 'Marketing Dept',
                'subject' => 'New Campaign Ideas',
                'preview' => 'Here are some ideas for the upcoming holiday campaign...',
                'time' => 'Feb 12',
                'starred' => true,
                'unread' => false,
                'avatar_color' => 'info'
            ],
        ];

        return view('pages.erp.inbox.index', compact('emails'));
    }
}
