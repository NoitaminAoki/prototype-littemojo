<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Gelasio:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('page_dist/css/bootstrap/bootstrap.min.css') }}">
    <style>
        html{
            min-height:100%;/* make sure it is at least as tall as the viewport */
            position:relative;
        }
        body{
            height:100%; /* force the BODY element to match the height of the HTML element */
        }
        
        .font-main {
            font-family: 'Montserrat', sans-serif;
        }

        .font-footer {
            font-family: 'Gelasio', serif;
        }

        #cloud-container{
            position:absolute;
            background-color: #9e9e9e;
            top:0;
            bottom:0;
            left:0;
            right:0;
            overflow:hidden;
            z-index:-1; /* Remove this line if it's not going to be a background! */
        }
        
        .content {
            margin: 15px auto;
            width: 861.899963px;
            height: 615.289978px;
            background-image: url("{{asset('page_dist/img/certificates/background.png')}}");
            background-color: #ffffff;
            background-size: cover;
        }
        
        .box-content {
            padding: 40px 39px;
        }

        .content-body {
            position: relative;
            height: 100%;
        }

        .content-img {
            position: absolute;
            top: 0;
            right: 50px;
            padding: .5rem 0 0;
        }

        .content-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            padding-left: .5rem;
            width: 32%;
        }
        
        .text-corporation {
            font-size: 16px;
            margin-top: 2.5rem;
            color: rgb(69,69,69);
            
        }

        .text-certificate {
            color: rgb(69,69,69);
            letter-spacing: .5rem;
            margin-top: 2.5rem;
        }

        .text-certificate-sub {
            color: rgb(69,69,69);
            font-size: 18px;
        }

        .text-single-1 {
            margin-top: 2.5rem;
            font-size: 13px;
            color: rgb(69,69,69);
        }

        .text-single-2 {
            margin-top: 1rem;
            font-size: 13px;
            color: rgb(69,69,69);
        }

        .text-single-3 {
            margin-top: .5rem;
            font-weight: 500;
            font-size: 15px;
            color: rgb(69,69,69);
        }

        .text-date {
            margin-top: 3rem;
            font-size: 16px;
            padding: .2rem 2rem;
            color: rgb(69,69,69);
            border-bottom: 2.2px solid rgb(128, 83, 147);
        }

        .text-date-sub {
            color: rgb(69,69,69);
            font-size: 16px;
        }

        .text-name {
            font-size: 3rem;
            color: rgb(69,69,69);
            margin-top: .5rem;
            padding: 0 .5rem;
            border-bottom: 2.2px solid rgb(255, 98, 185);
        }

        .text-footer {
            font-size: 10px;
            font-weight: 600;
            color: #989898;
        }

        .text-footer-sub {
            font-size: 9px;
            font-weight: 500;
            color: #989898;
            margin-bottom: .5rem;
        }
    </style>
</head>
<body>
    <div id="cloud-container">
        <div class="content">
            <div class="w-100 h-100 box-content">
                <div class="d-flex align-items-center flex-column content-body">
                    <div class="content-img">
                        <img src="http://localhost:8000/uploaded_files/corporation/88224769-702a-309b-5682-4e61vf3095t4/_thumbnail.png" alt="Google" title="Google">
                    </div>
                    <h5 class="font-main text-corporation font-weight-normal">LITTLEMONJO</h5>
                    <h2 class="font-main text-certificate font-weight-bold">CERTIFICATE</h2>
                    <h5 class="font-main text-certificate-sub font-weight-normal">OF ACHIEVEMENT</h5>

                    <span class="font-main text-single-1 font-weight-bold">THIS CERTIFICATE IS AWARDED TO</span>
                    <h2 class="font-main text-name font-weight-bold text-uppercase">NAME SURNAME</h2>
                    <span class="font-main text-single-2 font-weight-light">has successfully completed</span>
                    <span class="font-main text-single-3">Introduction to Search Engine Optimization</span>
                    <div class="text-center">
                        <h5 class="font-main text-date">May 04, 2021</h5>
                        <h5 class="font-main text-date-sub font-weight-normal">DATE</h5>
                    </div>
                    <div class="content-footer d-flex flex-column">
                        <span class="font-footer text-footer">Verify at littlemonjo.com/verify/SDH4OASMXL5</span>
                        <p class="text-footer-sub">Littlemonjo has confirmed the identity of this individual and their participation in the course.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>