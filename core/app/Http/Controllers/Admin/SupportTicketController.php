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
use App\Models\RoomItem;
use App\Models\RoomItemInspection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
        $items     = SupportTicket::orderBy('id', 'desc')->with('user')->get();
        $inspection = RoomItemInspection::orderBy('id', 'desc')->get();
        return view('admin.support.tickets', compact('items', 'pageTitle', 'inspection'));
    }

    public function pendingTicket()
    {
        $pageTitle = 'Pending Tickets';
        $items = SupportTicket::whereIn('status', [Status::TICKET_OPEN, Status::TICKET_REPLY])->orderBy('id', 'desc')->with('user')->get();
        $inspection = RoomItemInspection::orderBy('id', 'desc')->get();
        return view('admin.support.tickets', compact('items', 'pageTitle', 'inspection'));
    }

    public function closedTicket()
    {
        $pageTitle = 'Closed Tickets';
        $items = SupportTicket::where('status', Status::TICKET_CLOSE)->orderBy('id', 'desc')->with('user')->get();
        $inspection = RoomItemInspection::orderBy('id', 'desc')->get();
        return view('admin.support.tickets', compact('items', 'pageTitle', 'inspection'));
    }

    public function answeredTicket()
    {
        $pageTitle = 'Answered Tickets';
        $items = SupportTicket::orderBy('id', 'desc')->with('user')->where('status', Status::TICKET_ANSWER)->get();
        $inspection = RoomItemInspection::orderBy('id', 'desc')->get();
        return view('admin.support.tickets', compact('items', 'pageTitle', 'inspection'));
    }

    public function ticketReply($id)
    {
        $ticket = SupportTicket::with('user')->where('id', $id)->firstOrFail();
        $pageTitle = 'Reply Ticket';
        $messages = SupportMessage::with('ticket', 'admin', 'attachments')->where('support_ticket_id', $ticket->id)->orderBy('id', 'desc')->get();
        return view('admin.support.reply', compact('ticket', 'messages', 'pageTitle'));
    }

    public function ticketDelete($id)
    {
        $message = SupportMessage::findOrFail($id);
        $path = getFilePath('ticket');
        if ($message->attachments()->count() > 0) {
            foreach ($message->attachments as $attachment) {
                fileManager()->removeFile($path . '/' . $attachment->attachment);
                $attachment->delete();
            }
        }
        $message->delete();
        $notify[] = ['success', "Support ticket deleted successfully"];
        return back()->withNotify($notify);
    }

    public function store(Request $request)
    {
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
        $ticket->room_item_inspection_id = $request->room_item_inspection_id;
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
        if (isset($request->room_item_inspection_id)) {
            $this->sendWhatsAppNotification($request->room_item_inspection_id);
        }

        $notify[] = ['success', "Support ticket added successfully by" . "  " . $admin->name];
        return back()->withNotify($notify);
    }
    public function sendWhatsAppNotification($id)
    {
        $item = RoomItemInspection::find($id);
        $roomItems = ''; // Initialize the string to hold room item names
        // Decode the JSON string into an array
        $damageRoomItemIds = json_decode($item->damage_room_item_id, true);

        // Check if the result is an array and proceed
        if (is_array($damageRoomItemIds)) {
            foreach ($damageRoomItemIds as $value) {
                $roomItem = RoomItem::find((int) $value); // Convert to int and find the RoomItem
                if ($roomItem) {
                    $roomItems .= $roomItem->name . ", ";
                }
            }

            // Remove the trailing comma and space, if any
            $roomItems = rtrim($roomItems, ', ');
        }
        $text = "Accommodation Name: " . $item->accommodation->name . " \n Room: " . $item->room->room_number . " \n Bed: " . $item->bed->bed_name . " \n Items Damaged: " . $roomItems;
        dd($text);
        if ($item) {
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://apisocial.telebu.com/whatsapp-api/v1.0/customer/88325/bot/f43165f7e8c441fa/template",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => '{
                    "payload": {
                        "name": "demo_11may",
                        "components": [
                            {
                                "type": "header",
                                "parameters": [
                                    {
                                        "type": "image",
                                        "image": {
                                            "link": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSWH7uvl1NBKuSE-OrtSaizmhI7cVuVTUUiw&s"
                                        }
                                    }
                                ]
                            },
                            {
                                "type": "body",
                                "parameters": [
                                    {
                                        "type": "text",
                                        "text": ' . $text . '
                                    }
                                ]
                            }
                        ],
                        "language": {
                            "code": "en_US",
                            "policy": "deterministic"
                        },
                        "namespace": "cc1260e5_979d_4ce4_8c84_64fb27f20140"
                    },
                    "phoneNumber": "923224458223"
                }',
                CURLOPT_HTTPHEADER => [
                    "Authorization: Basic a82ee439-a7a3-48bf-b25b-9efa52623241-G23S6Dd",
                    "Content-Type: application/json"
                ],
            ]);

            // Execute the request
            $response = curl_exec($curl);

            // Check for errors
            $err = curl_error($curl);

            // Close the cURL session
            curl_close($curl);

            // Handle the response
            if ($err) {
                Log::error("cURL Error #:" . $err);
            }
        }
    }
}
