{{--

<body style="font-family: Poppins, sans-serif; margin: 0; padding: 0; background-color: #ff969617;">
  <table cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td style="text-align: center;">
        <table cellpadding="0" cellspacing="0" width="600"
          style="background-color: #fff; margin: 20px auto; padding: 20px 50px; border-radius: 20px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
          <tr>
            <td>
              <h1 style="font-size: 24px; margin-bottom: 10px;">Notifikasi</h1>
              <p style="font-size: 16px; margin-bottom: 20px;">Pemberitahuan baru untuk anda dari Bebras Help Desk</p>
            </td>
          </tr>
          <tr>
            <td>
              <!-- Loop through notifications -->
              @foreach ($data_email['isi'] as $item)
              @php
              if ($item->type == 'answer') {
              $link = route('question.show', $item->slug_link);
              }
              elseif ($item->type == 'question') {
              $link = route('question.show', $item->slug_link);
              }
              elseif ($item->type == 'user') {
              $link = route('profile.show', $item->slug_link);
              }
              elseif ($item->type == 'topic') {
              $link = route('topic.show', $item->slug_link);
              }
              @endphp
              <div style="margin-bottom: 15px;display: flex;align-items: center;">
                <span style="font-size: 20px; margin-right: 5px;">&#8226;</span>
                <a href="{{ $link }}" style="font-size: 15px; text-decoration: none; color: black; max-width: 75%;">{{
                  $item->text }}</a>
                <a href="{{ $link }}"
                  style="text-decoration: none; color: #fff; background-color: #db2c58; padding: 8px 12px; border-radius: 50px; margin-left: 10px;">Tampilkan</a>
              </div>
              @endforeach
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body> --}}


<div style="font-family: 'Poppins', sans-serif;margin: 0;padding: 0;background-color: #ff969617;">
  <div style="
  background-color: #fff;
  max-width: 600px;
  margin: 20px auto;
  padding: 20px 50px;
  border-radius: 20px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
    <div style="text-align: center; color: black;">
      <h1 style="
      font-size: 24px;
      margin-bottom: 10px;
      line-height: 5px;">Notifikasi</h1>
      <p style="
      font-size: 16px;
      margin-bottom: 20px;">Pemberitahuan baru untuk anda
        dari Bebras Help Desk</p>
    </div>

    <div style="
    padding-top: 5px;">
      @foreach ($data_email['isi'] as $item)
      @php
      if ($item->type == 'answer') {
      $link = route('question.show', $item->slug_link);
      }
      elseif ($item->type == 'question') {
      $link = route('question.show', $item->slug_link);
      }
      elseif ($item->type == 'user') {
      $link = route('profile.show', $item->slug_link);
      }
      elseif ($item->type == 'topic') {
      $link = route('topic.show', $item->slug_link);
      }
      @endphp
      <div style="display:flex">
        <span style="padding-right:12px;font-size: 33px;line-height: 1;">
          &#8226;
        </span>
        <a href="{{ $link }}" style="max-width:75%;text-decoration:none;color:black;">
          <p style="font-size:18px;margin: 0;">{{ $item->text }}</p>
        </a>
        <a style="font-size:14px;text-decoration:none;color:#db2c58;display:flex;background-color:#db2c58;color:#fff;padding:8px 12px;border-radius:20px;margin-left:auto;margin-bottom: 7vh;"
          href="{{ $link }}">Tampilkan</a>
      </div>
      @endforeach
    </div>
  </div>
</div>


{{-- <html>

<head>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #ff969617;
    }

    .email {
      background-color: #fff;
      max-width: 600px;
      margin: 20px auto;
      padding: 20px 50px;
      border-radius: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 24px;
      margin-bottom: 10px;
      line-height: 5px;
    }

    p {
      font-size: 16px;
      margin-bottom: 20px;
    }

    a {
      text-decoration: none;
      color: black;
    }

    .notifications {
      padding-top: 5px;
    }

    .notification {
      margin-bottom: 5px;
      display: flex;
      align-items: center;
    }

    .notification p {
      font-size: 18px;
      margin-right: auto;
    }

    .notificationsss {
      font-size: 14px;
      text-decoration: none;
      color: #db2c58;
      display: flex;
      align-items: center;
      background-color: #db2c58;
      color: #fff;
      padding: 8px 12px;
      border-radius: 50px;
      margin-left: auto;
    }

    .notificationsss:hover {
      background-color: #df5a7b;
    }

    .notification i {
      font-size: 18px;
      margin-right: 5px;
    }
  </style>
</head>

<body>
  <div class="email">
    <div style="text-align: center;">
      <h1>Notifikasi</h1>
      <p>Pemberitahuan baru untuk anda
        dari Bebras Help Desk</p>
    </div>

    <div class="notifications">
      @foreach ($data_email['isi'] as $item)
      @php
      if ($item->type == 'answer') {
      $link = route('question.show', $item->slug_link);
      }
      elseif ($item->type == 'question') {
      $link = route('question.show', $item->slug_link);
      }
      elseif ($item->type == 'user') {
      $link = route('profile.show', $item->slug_link);
      }
      elseif ($item->type == 'topic') {
      $link = route('topic.show', $item->slug_link);
      }
      @endphp
      <div class="notification">
        <span style="padding-right: 12px; font-size: 30px;">
          &#8226;
        </span>
        <a href="{{ $link }}" style="max-width: 75%">
          <p>{{ $item->text }}</p>
        </a>
        <a class="notificationsss" href="{{ $link }}" target="_blank">Tampilkan</a>
      </div>
      @endforeach
    </div>
  </div>
</body>

</html> --}}