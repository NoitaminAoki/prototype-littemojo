@extends('admins.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Quiz')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Partner</a></li>
<li class="breadcrumb-item">Lesson</li>
<li class="breadcrumb-item active">Quiz</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <tbody>
                        @if ($quizzes->isEmpty())
                        <tr class="border bg-light">
                            <td class="text-center text-secondary">No Data</td>
                        </tr>
                        @else
                        @foreach ($quizzes as $quiz)
                        <tr>
                            <td>{{$quiz->title}}</td>
                            <td>{{$quiz->minimum_score}}</td>
                            <td class="text-right py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.quiz.detail', ['quiz'=> $quiz->id]) }}" class="btn btn-primary"><i class="fas fa-search"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $("#example1").DataTable({
            "autoWidth": false,
        });
    })
</script>
@endsection