<div class="card-body">
    <ul class="todo-list ui-sortable" data-widget="todo-list">
        
        @foreach ($quizzes as $quiz)
        <li class="" style="">
            <!-- drag handle -->
            <span class="handle ui-sortable-handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
            </span>
            <input type="hidden" class="orders-id" value="{{$quiz->id}}">
            <!-- todo text -->
            <span class="text">{{$quiz->title}}</span>
            
            <!-- Emphasis label -->
            <small class="badge badge-secondary">{{$quiz->minimum_score}}</small>
            <!-- General tools such as edit or delete-->
            <div class="float-right">
                <div class="rounded px-2 bg-info">
                    {{$quiz->orders}}
                </div>
            </div>
        </li>
        @endforeach
        
    </ul>
</div>