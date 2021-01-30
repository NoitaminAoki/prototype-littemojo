@extends('partners.templates.main')

@section('css')
<style>
    .custom-bg-gradient-green {
        color: white;
        background-image: linear-gradient(to right, rgba(9, 227, 140,1), rgba(9, 209, 227,1));
    }
    
    .custom-bg-gradient-orange {
        color: white;
        background-image: linear-gradient(to right, rgba(227, 114, 9,1), rgba(227, 173, 9,1));
    }
    .custom-info-box {
        min-height: 60px !important;
    }
    .custom-info-box-content {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        -ms-flex-pack: center;
        justify-content: center;
        line-height: 120%;
    }
    .custom-content-top {
        justify-content: end !important;
    }
    .custom-info-box-icon {
        -webkit-box-align: center;
        -webkit-box-pack: center;
        width: 44px !important;
        height: 44px !important;
        border: 2px solid rgb(225, 225, 225);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-shrink: 0;
    }
    .custom-info-box-text {
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: pre-wrap;
    }
    .custom-icon-top {
        align-items: end;
        padding-top: 3px;
    }
    a.custom-text-white:hover {
        text-decoration: underline !important;
    }
    .custom-header-text-lesson {
        font-size: 3.75rem;
        line-height: 4.5rem;
        font-weight: normal;
        font-family: OpenSans-Light, OpenSans, Arial, sans-serif;
    }
    .custom-headline-text-lesson {
        font-family: OpenSans,Arial,sans-serif;
        font-size: 20px;
        line-height: 24px;
    }
    .custom-icon-sm {
        width: 40px !important;
        height: 40px !important;
    }
</style>
@endsection

@section('Page-Header', 'Detail Course')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('partner.manage.course.index') }}" class="text-info">Course</a></li>
<li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card custom-bg-gradient-green">
            <div class="card-body">
                <ol class="breadcrumb pl-0" style="background-color: transparent">
                    <li class="mx-1"><a href="{{ route('partner.manage.course.index') }}" class="text-white custom-text-white text-decoration-none">Course</a></li>
                    <li class="mx-1"><i class="fas fa-chevron-right text-sm "></i></li>
                    <li class="mx-1"><a href="{{ route('partner.manage.course.index') }}" class="text-white custom-text-white text-decoration-none">{{$course->nama_catalog}}</a></li>
                    <li class="mx-1"><i class="fas fa-chevron-right text-sm"></i></li>
                    <li class="mx-1"><a href="{{ route('partner.manage.course.index') }}" class="text-white custom-text-white text-decoration-none">{{$course->nama_catalog_topic}}</a></li>
                </ol>
                <h2 class="font-weight-bold"> {{$course->title}} </h2>
            </div>
        </div>
    </div>
    
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <h4>About this Course</h4>
                        <div class="pr-1">
                            {{$course->description}}
                        </div>
                    </div>
                    <div class="col-lg-4 border-left">
                        <div class="info-box custom-info-box shadow-none p-0">
                            <div class="custom-info-box-content">
                                <span class="custom-info-box-icon rounded-circle text-primary"><i class="far fa-clock"></i></span>
                            </div>
                            
                            <div class="info-box-content">
                                <span class="info-box-text"><h5 class="mb-0">Duration</h5></span>
                                <span class="info-box-text"> 7 days / 1 week </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <div class="info-box custom-info-box shadow-none p-0">
                            <div class="custom-info-box-content">
                                <span class="custom-info-box-icon rounded-circle text-primary"><i class="fas fa-calendar-check"></i></span>
                            </div>
                            
                            <div class="info-box-content">
                                <span class="info-box-text"><h5 class="mb-0">flexible schedules</h5></span>
                                <span class="info-box-text"> free to choose a start date </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        
                        <div class="info-box custom-info-box shadow-none p-0">
                            <div class="custom-info-box-content">
                                <span class="custom-info-box-icon rounded-circle text-primary"><i class="fas fa-signal"></i></span>
                            </div>
                            
                            <div class="info-box-content">
                                <span class="info-box-text"><h5 class="mb-0">Beginner Level</h5></span>
                                <span class="info-box-text">No degree or prior experience required</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        
                        <div class="info-box custom-info-box shadow-none p-0">
                            <div class="custom-info-box-content">
                                <span class="custom-info-box-icon rounded-circle text-primary"><i class="fas fa-tag"></i></span>
                            </div>
                            
                            <div class="info-box-content">
                                <span class="info-box-text"><h5 class="mb-0">Price</h5></span>
                                <span class="info-box-text">Rp {{number_format($course->price, 0)}} </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Summary</h4>
            </div>
            <div class="card-body">
                <div class="card-body px-2 pt-0 border">
                    <div class="card-header">
                        <h3 class="card-title text-secondary">WHAT YOU WILL LEARN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool bg-primary">
                                Manage
                            </button>
                        </div>
                        <br>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <div class="info-box custom-info-box shadow-none p-0">
                                <span class="custom-info-box-icon custom-icon-top border-0 text-success"><i class="fas fa-check"></i></span>
                                
                                
                                <div class="info-box-content custom-content-top pl-0">
                                    <span class="custom-info-box-text">Gain skills required to succeed in an entry-level IT capacity</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box custom-info-box shadow-none p-0">
                                <span class="custom-info-box-icon custom-icon-top border-0 text-success"><i class="fas fa-check"></i></span>
                                
                                
                                <div class="info-box-content custom-content-top pl-0">
                                    <span class="custom-info-box-text">Learn how to provide end-to-end customer support, ranging from identifying problems to troubleshooting and debugging</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box custom-info-box shadow-none p-0">
                                <span class="custom-info-box-icon custom-icon-top border-0 text-success"><i class="fas fa-check"></i></span>
                                
                                
                                <div class="info-box-content custom-content-top pl-0">
                                    <span class="custom-info-box-text">Learn to perform day-to-day IT support tasks including computer assembly, wireless networking, installing programs, and customer service</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="info-box custom-info-box shadow-none p-0">
                                <span class="custom-info-box-icon custom-icon-top border-0 text-success"><i class="fas fa-check"></i></span>
                                
                                
                                <div class="info-box-content custom-content-top pl-0">
                                    <span class="custom-info-box-text">Learn to use systems including Linux, Domain Name Systems, Command-Line Interface, and Binary Code</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-2 pt-0 mt-3 border">
                    <div class="card-header">
                        <h3 class="card-title text-secondary">SKILLS YOU WILL GAIN</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool bg-primary">
                                Manage
                            </button>
                        </div>
                        <br>
                    </div>
                    <div class="d-flex flex-wrap mt-3">
                        <div class="rounded bg-secondary py-1 px-2 my-1 mx-2">Debugging</div>
                        <div class="rounded bg-secondary py-1 px-2 my-1 mx-2">Encryption Algorithms and Techniques</div>
                        <div class="rounded bg-secondary py-1 px-2 my-1 mx-2">Customer Service</div>
                        <div class="rounded bg-secondary py-1 px-2 my-1 mx-2">Network Protocols</div>
                        <div class="rounded bg-secondary py-1 px-2 my-1 mx-2">Cloud Computing</div>
                        <div class="rounded bg-secondary py-1 px-2 my-1 mx-2">Binary Code</div>
                        <div class="rounded bg-secondary py-1 px-2 my-1 mx-2">Customer Support</div>
                        <div class="rounded bg-secondary py-1 px-2 my-1 mx-2">Linux</div>
                        <div class="rounded bg-secondary py-1 px-2 my-1 mx-2">Troubleshooting</div>
                        <div class="rounded bg-secondary py-1 px-2 my-1 mx-2">Domain Name System (DNS)</div>
                        <div class="rounded bg-secondary py-1 px-2 my-1 mx-2">Ipv4</div>
                        <div class="rounded bg-secondary py-1 px-2 my-1 mx-2">Network Model</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool bg-primary">
                        Manage
                    </button>
                </div>
                <h4 class="text-center">Syllabus - What you will learn from this course</h4>
            </div>
            <div class="card-body">
                <div class="my-1">
                    <br>
                </div>
                <div class="row">
                    <div class="col-12 mt-3 row">
                        <div class="col-lg-2">
                            <div class="text-center" style="display: inline-block">
                                <span>LESSON</span>
                                <br>
                                <span class="custom-header-text-lesson">1</span>
                            </div>
                        </div>
                        <div class="col-lg-10 border-bottom">
                            <h2 class="font-weight-bold custom-headline-text-lesson mb-3">What is System Administration?</h2>
                            
                            <p>Welcome to the System Administration course of the IT Support Professional Certificate! In the first week of this course, we will cover the basics of system administration. We'll cover organizational policies, IT infrastructure services, user and hardware provisioning, routine maintenance, troubleshooting, and managing potential issues. By the end of this module, you will understand the roles and responsibilities of a System Administrator. So let's get started!</p>
                            
                            <div class="info-box custom-info-box shadow-none p-0 mb-5">
                                <div class="custom-info-box-content pr-1">
                                    <span class="custom-info-box-icon border-0 custom-icon-sm custom-bg-gradient-green rounded-circle text-white"><i class="fas fa-book"></i></span>
                                </div>
                                
                                <div class="info-box-content">
                                    <span class="info-box-text text-secondary">16 videos (Total 44 min), 6 readings, 5 quizzes</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                    </div>
                    <!-- /.col-12 row (div lesson) -->
                    <div class="col-12 mt-3 row">
                        <div class="col-lg-2">
                            <div class="text-center" style="display: inline-block">
                                <span>LESSON</span>
                                <br>
                                <span class="custom-header-text-lesson">2</span>
                            </div>
                        </div>
                        <div class="col-lg-10 border-bottom">
                            <h2 class="font-weight-bold custom-headline-text-lesson mb-3">Network and Infrastructure Services</h2>
                            
                            <p>In the second week of this course, we'll learn about network and infrastructure services. We will cover what IT infrastructure services are and what their role is in system administration. We'll also learn about server operating systems, virtualization, network services, DNS for web services, and how to troubleshoot network services. By the end of this module, you will know the most common IT infrastructure services you'll encounter when handling system administration tasks.</p>
                            
                            <div class="info-box custom-info-box shadow-none p-0 mb-5">
                                <div class="custom-info-box-content pr-1">
                                    <span class="custom-info-box-icon border-0 custom-icon-sm custom-bg-gradient-green rounded-circle text-white"><i class="fas fa-book"></i></span>
                                </div>
                                
                                <div class="info-box-content">
                                    <span class="info-box-text text-secondary">23 videos (Total 74 min), 6 readings, 10 quizzes</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                    </div>
                    <!-- /.col-12 row (div lesson) -->
                    <div class="col-12 mt-3 row">
                        <div class="col-lg-2">
                            <div class="text-center" style="display: inline-block">
                                <span>LESSON</span>
                                <br>
                                <span class="custom-header-text-lesson">3</span>
                            </div>
                        </div>
                        <div class="col-lg-10 border-bottom">
                            <h2 class="font-weight-bold custom-headline-text-lesson mb-3">Software and Platform Services</h2>
                            
                            <p>In the third week of this course, we'll explore software and platform services. We'll cover what types of software and platform services you may encounter in a tech role and how to manage them. We'll learn how to configure email services, security services, file services, print services, and platform services. We'll explore ways to troubleshoot platform services and common issues to look out for. By the end of this module, you'll understand how to setup and manage the IT infrastructure services to help a business stay productive, keep information secure, and deliver applications to its users.</p>
                            
                            <div class="info-box custom-info-box shadow-none p-0 mb-5">
                                <div class="custom-info-box-content pr-1">
                                    <span class="custom-info-box-icon border-0 custom-icon-sm custom-bg-gradient-green rounded-circle text-white"><i class="fas fa-book"></i></span>
                                </div>
                                
                                <div class="info-box-content">
                                    <span class="info-box-text text-secondary">16 videos (Total 45 min), 10 readings, 8 quizzes</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                    </div>
                    <!-- /.col-12 row (div lesson) -->
                    <div class="col-12 mt-3 row">
                        <div class="col-lg-2">
                            <div class="text-center" style="display: inline-block">
                                <span>LESSON</span>
                                <br>
                                <span class="custom-header-text-lesson">4</span>
                            </div>
                        </div>
                        <div class="col-lg-10 border-bottom">
                            <h2 class="font-weight-bold custom-headline-text-lesson mb-3">Directory Services</h2>
                            
                            <p>In the fourth week of this course, we'll learn about directory services. Specifically, we'll cover how two of the most popular directory services, Active Directory and OpenLDAP, work in action. We'll explore the concept of centralized management and how this can help SysAdmins maintain and support all the different parts of an IT infrastructure. By the end of this module, you will know how to add users, passwords, and use group policies in Active Directory and OpenLDAP.</p>
                            
                            <div class="info-box custom-info-box shadow-none p-0 mb-5">
                                <div class="custom-info-box-content pr-1">
                                    <span class="custom-info-box-icon border-0 custom-icon-sm custom-bg-gradient-green rounded-circle text-white"><i class="fas fa-book"></i></span>
                                </div>
                                
                                <div class="info-box-content">
                                    <span class="info-box-text text-secondary">19 videos (Total 100 min), 11 readings, 6 quizzes</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                    </div>
                    <!-- /.col-12 row (div lesson) -->
                    <div class="col-12 mt-3 row">
                        <div class="col-lg-2">
                            <div class="text-center" style="display: inline-block">
                                <span>LESSON</span>
                                <br>
                                <span class="custom-header-text-lesson">5</span>
                            </div>
                        </div>
                        <div class="col-lg-10 border-bottom">
                            <h2 class="font-weight-bold custom-headline-text-lesson mb-3">Data Recovery & Backups</h2>
                            
                            <p>In the fifth week of this course, we'll learn about data recovery and backups. In any tech role, it's important to know how to backup and recover data -- it's even more important for system administration. We will also learn about common corporate practices like designing a disaster recovery plan and writing post-mortem documentation. By the end of this module, you'll know the tradeoffs between on-site and off-site backups, understand the value and importance of backup and recovery testing, know different options for data backup (as well as the risks) and understand the purpose and contents of a disaster recovery plan.</p>
                            
                            <div class="info-box custom-info-box shadow-none p-0 mb-5">
                                <div class="custom-info-box-content pr-1">
                                    <span class="custom-info-box-icon border-0 custom-icon-sm custom-bg-gradient-green rounded-circle text-white"><i class="fas fa-book"></i></span>
                                </div>
                                
                                <div class="info-box-content">
                                    <span class="info-box-text text-secondary">13 videos (Total 43 min), 3 readings, 6 quizzes</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                    </div>
                    <!-- /.col-12 row (div lesson) -->
                    <div class="col-12 mt-3 row">
                        <div class="col-lg-2">
                            <div class="text-center" style="display: inline-block">
                                <span>LESSON</span>
                                <br>
                                <span class="custom-header-text-lesson">6</span>
                            </div>
                        </div>
                        <div class="col-lg-10 border-bottom">
                            <h2 class="font-weight-bold custom-headline-text-lesson mb-3">Final Project</h2>
                            
                            <p>Congratulations, you've made it to the final week in the course! The last week of this course is dedicated to the final project. For the final project, you will apply all the skills you've learned in this course by providing systems administration consultation. You will assess the IT infrastructure of three fictitious (but very real-life based!) companies and provide recommendations and advice about how to support their IT infrastructure. By the end of this project, you will demonstrate the skills and problem-solving techniques of a SysAdmin. Good luck!</p>
                            
                            <div class="info-box custom-info-box shadow-none p-0 mb-5">
                                <div class="custom-info-box-content pr-1">
                                    <span class="custom-info-box-icon border-0 custom-icon-sm custom-bg-gradient-green rounded-circle text-white"><i class="fas fa-book"></i></span>
                                </div>
                                
                                <div class="info-box-content">
                                    <span class="info-box-text text-secondary">3 videos (Total 4 min)</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                    </div>
                    <!-- /.col-12 row (div lesson) -->
                </div>
            </div>
        </div>
    </div>
</div>       
</div>
@endsection
@section('script')
<script>
    $('button').click(function(){
        if ($('input').val() != '') {
            $(this).attr('disabled', true)
            $(this).text('Load..')
        } 
    })
</script>
@endsection