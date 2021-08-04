<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{ asset('page_dist/css/bootstrap/bootstrap.min.css') }}"> --}}
    <style>
        body {
            margin: 0;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans","Liberation Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            padding: 0;
            text-align: left;
        }
        h6 {
            font-size: 1rem;
            font-weight: 500;
            line-height: 1.2;
        }
        .col-md-6 {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }
        @media (min-width: 768px) {
            .col-md-6 {
                max-width: 50%;
                flex: 0 0 50%;
            }
        }
        /* background-color:rgb(38, 22, 70); */
    </style>
    <title>Document</title>
</head>
<body style="background-color: #e8e5ef;">
    <div style="width: 100%; height: 40px;background-color: transparent;"></div>
    <div class="col-md-6" style="margin-left:auto;margin-right:auto;border: 0;position: relative; overflow-wrap: break-word; background-color: rgb(255, 255, 255); background-clip: border-box;">
        <div class="" style="background-color:rgba(4,9,30,0.9);color:#ffffff;border-radius:0;margin-bottom: 0px;padding: 0.75rem 1.25rem;border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
            <h3 class="" style="font-weight: 700;margin-top: 0;margin-bottom: 0px;font-size: 1.75rem;line-height: 1.2;">LittleMonjo</h3>
            @if ($details['title'])
            <div style="width:230px; height:1px;background-color: #ffffff;margin: 10px 0;"></div>
            <h6 style="Margin:0;Margin-bottom:10px;color:inherit;display:inline-block;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:18px;font-style:italic;font-weight:700;line-height:1.3;margin:0;margin-bottom:10px;margin-right:15px;padding:0;text-align:left;word-wrap:normal">
                {{$details['title']}}
            </h6>
            @endif
        </div>
        <div style="width:100%;height:5px;margin-top:.5rem;background-color:rgba(4,9,30,0.9);"></div>
        <table style="background-color:#c9c8f1;border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
            <tbody>
                <tr style="padding:0;text-align:left;vertical-align:top">
                    <td style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                        <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top">
                            <tbody>
                                <tr style="padding:0;text-align:left;vertical-align:top">
                                    <td height="10px" style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:10px;font-weight:400;line-height:10px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%">
                            <tbody>
                                <tr style="padding:0;text-align:left;vertical-align:top">
                                    <th style="Margin:0 auto;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0 auto;padding:0;padding-bottom:10px;padding-left:20px;padding-right:10px;text-align:left;width:270px">
                                        <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                            <tbody>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <th style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                        <p style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                            28 Juni 2021 - 00:35:50
                                                        </p>
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </th>
                                    <th style="Margin:0 auto;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0 auto;padding:0;padding-bottom:10px;padding-left:10px;padding-right:20px;text-align:left;width:270px">
                                        <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                            <tbody>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <th style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                        <p style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:right">
                                                            @isset($details['codes'])
                                                            @if ($details['codes']['type'] == 'withdrawal')
                                                            TICKET ID: {{$details['codes']['code']}}
                                                            @elseif ($details['codes']['type'] == 'transaction')
                                                            ORDER ID: {{$details['codes']['code']}}
                                                            @endif
                                                            @else
                                                            -
                                                            @endisset
                                                        </p>
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="" style="min-height: 1px;flex: 1 1 auto;padding: 1.25rem;">
            <h1 style="margin-top:1.5rem;box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';color:#3d4852;font-size:18px;font-weight:bold;text-align:left">
                Hello, {{$details['username']}}!
            </h1>
            <hr style="margin-top: 1rem;margin-bottom: 1rem;border: 0; border-top: 1px solid rgba(0,0,0,.1);box-sizing: content-box;height: 0;overflow: visible;">
            <p style="Margin:0;Margin-bottom:10px;font-family: verdana;font-size: 13px;font-weight: 400;line-height: 14pt;margin:0;margin-bottom:10px;padding:0;text-align:left">
                Your withdrawal request has been processed by the Admin. Details of your withdrawal information as follows.
            </p>
            <table cellspacing="0" cellpadding="0" style="margin-top:3rem;border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                <tbody>
                    <tr>
                        <td colspan="2" style="background-color: #6f42c1;text-align: center;color: #ffffff;padding: 10px 15px;border-bottom: 3px solid #c9c8f1;">
                            <h6 style="margin: 0;">Bank Information</h6>
                        </td>
                    </tr>
                    <tr style="padding:0;text-align:left;vertical-align:top">
                        <td style="Margin:0;border-bottom:1px solid #d8d8d8;border-collapse:collapse!important;color:#777;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:10px 0;text-align:left;vertical-align:top;word-wrap:break-word">
                            Bank
                        </td>
                        <td style="Margin:0;border-bottom:1px solid #d8d8d8;border-collapse:collapse!important;color:#777;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:10px 0;text-align:right;vertical-align:top;word-wrap:break-word">
                            BCA
                        </td>
                    </tr>
                    <tr style="padding:0;text-align:left;vertical-align:top">
                        <td style="Margin:0;border-bottom:1px solid #d8d8d8;border-collapse:collapse!important;color:#777;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:10px 0;text-align:left;vertical-align:top;word-wrap:break-word">
                            Account Name
                        </td>
                        <td style="Margin:0;border-bottom:1px solid #d8d8d8;border-collapse:collapse!important;color:#777;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:10px 0;text-align:right;vertical-align:top;word-wrap:break-word">
                            Mochamad Rizky
                        </td>
                    </tr>
                    <tr style="padding:0;text-align:left;vertical-align:top">
                        <td style="Margin:0;border-bottom:1px solid #d8d8d8;border-collapse:collapse!important;color:#777;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:10px 0;text-align:left;vertical-align:top;word-wrap:break-word">
                            Account Number
                        </td>
                        <td style="Margin:0;border-bottom:1px solid #d8d8d8;border-collapse:collapse!important;color:#777;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:10px 0;text-align:right;vertical-align:top;word-wrap:break-word">
                            23085xxxxxx231
                        </td>
                    </tr>
                    <tr style="padding:0;text-align:left;vertical-align:top">
                        <td style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:700;line-height:19px;margin:0;padding:10px 0;text-align:left;vertical-align:top;word-wrap:break-word">
                            Amount
                        </td>
                        <td style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:700;line-height:19px;margin:0;padding:10px 0;text-align:right;vertical-align:top;word-wrap:break-word">
                            IDR 250.000
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="width: 100%;margin-top: 2rem;">
                <p style="font-family: verdana;font-size: 13px;font-weight: 400;line-height: 14pt;color:#555555;box-sizing:border-box;margin-top:0;margin-bottom:0;text-align:left">
                    <br>
                </p>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-6" style="margin-left: auto; margin-right: auto; background-color: rgb(255, 255, 255);">
        <div style="margin-right: -15px;margin-left: -15px;">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
                <tbody>
                    <tr>
                        <td>
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
                                <tbody>
                                    <tr>
                                        <td>
                                            <p style="position: absolute;margin-top: 40px;margin-left:35px;margin-bottom:0;font-family: verdana;font-size: 13px;font-weight: 400;line-height: 14pt;color:#555555;box-sizing:border-box;text-align:left">
                                                Regards,<br>
                                                LittleMonjo
                                            </p>
                                            <img src="https://webstatic-sea.mihoyo.com/upload/static-resource/2021/07/15/1e6c81b5118699232f6539ff4384cb72_1320900797983298806.png" style="display:block;max-width:800px;width:100%;height:auto;color:#6560b9;font-size:20px;font-weight:bold;font-family:Arial,'Helvetica Neue',Helvetica,sans-serif" width="800" tabindex="0">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> --}}
    <div class="col-md-6" style="margin-left: auto; margin-right: auto;background-color: rgb(35 20 66);">
        
        <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
            <tbody>
                <tr style="padding:0;text-align:left;vertical-align:top">
                    <td style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">
                        <table style="border-collapse:collapse;border-spacing:0;display:table;padding:0;text-align:left;vertical-align:top;width:100%">
                            <tbody>
                                <tr style="padding:0;text-align:left;vertical-align:top">
                                    <th style="Margin:0 auto;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0 auto;padding:0;padding-bottom:10px;padding-left:20px;padding-right:20px;text-align:left;width:560px">
                                        <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                            <tbody>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <th style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left">
                                                        <table style="border-collapse:collapse;border-spacing:0;padding:0;text-align:left;vertical-align:top;width:100%">
                                                            <tbody>
                                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                                    <td height="30px" style="Margin:0;border-collapse:collapse!important;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:30px;font-weight:400;line-height:30px;margin:0;padding:0;text-align:left;vertical-align:top;word-wrap:break-word">&nbsp;</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <p style="Margin:0;Margin-bottom:10px;color:#c1c1c1;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:13px;font-weight:400;line-height:19px;margin:0;margin-bottom:10px;padding:0;text-align:center">
                                                            For more information about your withdrawal, please contact:<br>
                                                            email: 
                                                            <a href="mailto:littlemonjo@gmail.com" style="Margin:0;color:#00b4ed;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-weight:400;line-height:1.3;margin:0;padding:0;text-align:left;text-decoration:none" target="_blank">
                                                                littlemonjo@gmail.com
                                                            </a> | 
                                                            phone: +6285159116034
                                                        </p>
                                                    </th>
                                                    <th style="Margin:0;color:#0a0a0a;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;line-height:19px;margin:0;padding:0!important;text-align:left;width:0"></th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="width: 100%;text-align: center;">
            <span style="font-family:Tahoma,Geneva,sans-serif;font-weight:normal;font-size:10px;line-height:16px;color:#c1c1c1;">
                Copyright &copy; {{date('Y')}} LittleMonjo All Rights Reserved<br><br>
            </span>
        </div>
    </div>
    <div style="width: 100%; height: 40px;background-color: transparent;"></div>
</body>
</html>