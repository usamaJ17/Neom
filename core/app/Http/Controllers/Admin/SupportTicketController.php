<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Traits\SupportTicketManager;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\AdminNotification;

class SupportTicketController extends Controller
{
    use SupportTicketManager;

    public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next) {
            $this->user = auth()->guard('admin')->user();
            return $next($request);
        });

        $this->userType = 'admin';
        $this->column   = 'admin_id';
    }

    public function tickets()
    {
        $pageTitle = 'Support Tickets';
        $items     = SupportTicket::orderBy('id','desc')->with('user')->get();
        return view('admin.support.tickets', compact('items', 'pageTitle'));
    }

    public function pendingTicket()
    {
        $pageTitle = 'Pending Tickets';
        $items = SupportTicket::whereIn('status', [Status::TICKET_OPEN,Status::TICKET_REPLY])->orderBy('id','desc')->with('user')->get();
        return view('admin.support.tickets', compact('items', 'pageTitle'));
    }

    public function closedTicket()
    {
        $pageTitle = 'Closed Tickets';
        $items = SupportTicket::where('status',Status::TICKET_CLOSE)->orderBy('id','desc')->with('user')->get();
        return view('admin.support.tickets', compact('items', 'pageTitle'));
    }

    public function answeredTicket()
    {
        $pageTitle = 'Answered Tickets';
        $items = SupportTicket::orderBy('id','desc')->with('user')->where('status',Status::TICKET_ANSWER)->get();
        return view('admin.support.tickets', compact('items', 'pageTitle'));
    }

    public function ticketReply($id)
    {
        $ticket = SupportTicket::with('user')->where('id', $id)->firstOrFail();
        $pageTitle = 'Reply Ticket';
        $messages = SupportMessage::with('ticket','admin','attachments')->where('support_ticket_id', $ticket->id)->orderBy('id','desc')->get();
        return view('admin.support.reply', compact('ticket', 'messages', 'pageTitle'));
    }

    public function ticketDelete($id)
    {
        $message = SupportMessage::findOrFail($id);
        $path = getFilePath('ticket');
        if ($message->attachments()->count() > 0) {
            foreach ($message->attachments as $attachment) {
                fileManager()->removeFile($path.'/'.$attachment->attachment);
                $attachment->delete();
            }
        }
        $message->delete();
        $notify[] = ['success', "Support ticket deleted successfully"];
        return back()->withNotify($notify);

    }
    
        public function store(Request $request) {
            
        $request->validate([
            'subject'        => 'required|string',
            'message' => 'required',
        ]);
        
        $admin = auth()->guard('admin')->user();
        
        $ticket = new SupportTicket();
        $ticket->ticket = random_int(10000000, 99999999);
        $ticket->subject = $request->subject;
        // $ticket->user_id = $admin->id;
        $ticket->name = $admin->name;
        $ticket->email = $admin->email;
        $ticket->priority = 2;
        $ticket->last_reply = Carbon::now();
        $ticket->save();
        
        $message = new SupportMessage();
        $message->message = $request->message;
        $message->support_ticket_id = $ticket->id;
        $message->admin_id = 0;
        $message->save();
        
        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title = 'Support Ticket';
        $adminNotification->click_url = urlPath('admin.ticket.view', $ticket->id);
        $adminNotification->save();

        $notify[] = ['success', "Support ticket added successfully by". "  " .$admin->name];
        return back()->withNotify($notify);
    }

}
