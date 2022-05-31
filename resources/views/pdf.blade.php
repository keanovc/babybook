<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #2C2C2C;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
            }

            a {
                color: #2C2C2C;
            }

            span {
                font-weight: 700;
            }

            p {
                font-weight: 400;
            }
        </style>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
    <body class="font-sans antialiased">
        <div>
            <div style='background:#FFFFFF;background-color:#FFFFFF;max-width:800px;'>
                <div align='left'>
                    <h1 class="title">{{ $list->name }}</h1>
                    <p class="text"><span>Geslacht: </span>{{ $list->gender }}</p>
                    <p class="text"><span>Beschrijving: </span>{{ $list->description }}</p>
                    <p class="text"><span>Invite code: </span>{{ $list->invitation_code }}</p>
                    <hr>
                    <h1 class="title">Articles</h1>
                </div>
              <table align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='background:#FFFFFF;background-color:#FFFFFF;width:100%;'>
                <tbody>
                  <tr>
                    <td style='direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;'>
                      <div class='dys-column-per-100 outlook-group-fix' style='direction:ltr;display:inline-block;font-size:13px;text-align:left;vertical-align:top;width:100%;'>
                        <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='vertical-align:top;' width='100%'>
                          <tr>
                            <td align='left' style='font-size:0px;padding:10px 25px;word-break:break-word;'>
                              <table border='0' cellpadding='0' cellspacing='0' style="cellpadding:0;cellspacing:0;color:#777777;font-size:14px;line-height:21px;table-layout:auto;width:100%;" width='100%'>
                                <tr>
                                  <th style='text-align: left; border-bottom: 1px solid #cccccc; color: #4d4d4d; font-weight: 700; padding-bottom: 5px;' width='50%'>
                                    Item
                                  </th>
                                  <th style='text-align: right; border-bottom: 1px solid #cccccc; color: #4d4d4d; font-weight: 700; padding-bottom: 5px;' width='15%'>
                                    Qty
                                  </th>
                                  <th style='text-align: right; border-bottom: 1px solid #cccccc; color: #4d4d4d; font-weight: 700; padding-bottom: 5px; ' width='15%'>
                                    Total
                                  </th>
                                  <th style='text-align: right; border-bottom: 1px solid #cccccc; color: #4d4d4d; font-weight: 700; padding-bottom: 5px; ' width='15%'>
                                    Link
                                  </th>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          @foreach ($articles as $article)
                            <tr>
                                <td align='left' style='font-size:0px;padding:10px 25px;word-break:break-word;'>
                                <table border='0' cellpadding='0' cellspacing='0' style='cellpadding:0;cellspacing:0;color:#000000;font-size:13px;line-height:22px;table-layout:auto;width:100%;' width='100%'>
                                    <tr style="font-size:14px; line-height:19px; color:#777777">
                                    <td width='50%'>
                                        <table cellpadding='0' cellspacing='0' style="font-size:14px; line-height:19px; " width='100%'>
                                        <tbody>
                                            <tr>
                                            <td style="text-align:left; font-size:14px; line-height:19px; color: #777777;">
                                                <span style='color: #4d4d4d; font-weight:bold;'>
                                                    {{ $article->title }}
                                                </span>
                                            </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                    </td>
                                    <td style='text-align:center; ' width='15%'>
                                        1
                                    </td>
                                    <td style='text-align:center; ' width='10%'>
                                      €{{ $article->price }}
                                    </td>
                                    <td style='text-align:right; ' width='10%'>
                                      <a href="{{ $article->url }}">View</a>
                                    </td>
                                    </tr>
                                </table>
                                </td>
                            </tr>
                          @endforeach
                          <tr>
                            <td align='left' style='font-size:0px;padding:10px 25px;word-break:break-word;margin-top:10px;'>
                              <table border='0' cellpadding='0' cellspacing='0' style='cellpadding:0;cellspacing:0;color:#000000;font-size:13px;line-height:22px;table-layout:auto;width:100%;' width='100%'>
                                <tr style="font-size:14px; line-height:19px; color:#777777">
                                  <td width='50%'>
                                  </td>
                                  <td style='text-align:right; padding-right: 10px; border-top: 1px solid #cccccc;'>
                                    <span style='padding:8px 0px;display: inline-block;font-weight: bold; color: #4d4d4d'>
                                      Total
                                    </span>
                                  </td>
                                  <td style='text-align: right; border-top: 1px solid #cccccc;'>
                                    <span style='display: inline-block;font-weight: bold; color: #4d4d4d'>
                                        €{{ $totalPrice }}
                                    </span>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
    </body>
</html>
