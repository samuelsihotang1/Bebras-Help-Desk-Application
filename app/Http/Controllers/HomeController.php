<?php

namespace App\Http\Controllers;

use App\Mail\kirimEmail;
use App\Models\User;
use App\Models\Topic;
use App\Models\Answer;
use App\Models\Notifikasi;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'verified']);
  }

  // public function sendMessage()
  // {
  //   try {
  //     // Send Template
  //     $whatsapp_cloud_api->sendTemplate('62895612360693', 'hello_world', 'en_US');

  //     // Send Text Message
  //     $whatsapp_cloud_api->sendTextMessage('62895612360693', 'hello its workinng ? test');

  //     // Send Document by link
  //     $document_link = 'https://i.ytimg.com/vi/0jIQK3GvmDk/hqdefault.jpg';
  //     $link_id = new LinkID($document_link);
  //     $whatsapp_cloud_api->sendDocument('62895612360693', $link_id, "Document", "caption of document");

  //     // Send Image by link
  //     $link_id = new LinkID('https://i.ytimg.com/vi/0jIQK3GvmDk/hqdefault.jpg');
  //     $whatsapp_cloud_api->sendImage('62895612360693', $link_id);

  //     // Contact
  //     $name = new ContactName('Sajid', 'Ali');
  //     $phone = new Phone('7065221377', PhoneType::CELL());
  //     $whatsapp_cloud_api->sendContact('62895612360693', $name, $phone);

  //     // List
  //     $rows = [
  //       new Row('1', '⭐️', "Experience wasn't good enough"),
  //       new Row('2', '⭐⭐️', "Experience could be better"),
  //       new Row('3', '⭐⭐⭐️', "Experience was ok"),
  //       new Row('4', '⭐⭐️⭐⭐', "Experience was good"),
  //       new Row('5', '⭐⭐️⭐⭐⭐️', "Experience was excellent"),
  //     ];
  //     $sections = [new Section('Stars', $rows)];
  //     $action = new Action('Submit', $sections);

  //     $whatsapp_cloud_api->sendList(
  //       '62895612360693',
  //       'Rate your experience',
  //       'Please consider rating your shopping experience in our website',
  //       'Thanks for your time',
  //       $action
  //     );

  //     // Media messages accept as identifiers an Internet URL pointing to a public resource (image, video, audio, etc.). When you try to send a media message from a URL you must instantiate the LinkID object.
  //     $response = $whatsapp_cloud_api->uploadMedia('1.jpeg');
  //     $media_id = new MediaObjectID($response->decodedBody()['id']);
  //     $whatsapp_cloud_api->sendImage('62895612360693', $media_id);
  //   } catch (\Netflie\WhatsAppCloudApi\Response\ResponseException $e) {
  //     echo "<pre>";
  //     print_r($e->response()); // You can still check the Response returned from Meta servers
  //     echo "</pre>";
  //   }
  // }

  public function index(Request $request)
  {
    //jika user belum disetujui
    if (auth()->check() && auth()->user()->approved == 'false') {
      auth()->logout();
      return redirect()->route('login')->with('message', ['text' => 'Anda belum bisa masuk, sebelum akun anda disetujui oleh admin. Harap menunggu.']);
    } elseif (auth()->check() && auth()->user()->approved == 'true') {
      $answers = Answer::with(['user', 'question'])->where('user_id', '!=', auth()->id())
        ->whereNull('status')->orWhere('status', 'viewed_by_admin')->orWhere('status', 'updated_by_user')
        ->latest()->get();

      if (!Cache::has('email_notification_' . auth()->user()->id)) {
        $notif = Notifikasi::where('user_id', '=', auth()->id())->where('viewed', '=', 'false')->get();
        if (count($notif) > 0) {
          Mail::to(auth()->user()->email)->send(new kirimEmail([
            'subject' => 'Notifikasi dari Bebras Help Desk',
            'sender_name' => 'bebras@bebrasindonesia.org',
            'isi' => $notif
          ]));
          Cache::put('email_notification_' . auth()->user()->id, true, 86400);
        }
      }
      return view('home', compact('answers'));
    }

    //jika user belum login
    // if (!auth()->check()) {
    //     $answers = Answer::with(['user', 'question'])->latest()->get();
    //     return view('home', compact('answers'));
    // }
  }

  public function search(Request $request)
  {
    if ($request->search == null) {
      return view('search-results');
    } else {
      $searchArray = explode(' ', $request->search);
      $questions = Question::where(function ($query) use ($searchArray) {
        foreach ($searchArray as $search) {
          if ($search != null) {
            $query->orWhere('title', 'like', '%' . $search . '%')
              ->orWhere('title_slug', 'like', '%' . $search . '%');
          }
        }
      })->latest()->get();
      return view('search-results', [
        'questions' => $questions,
        'search' => $request->search
      ]);
    }
  }
}
