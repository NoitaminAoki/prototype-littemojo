<div class="card-body">
    <ul class="todo-list ui-sortable" data-widget="todo-list">
        
        @foreach ($questions as $question)
        <li class="" style="">
            <!-- drag handle -->
            <span class="handle ui-sortable-handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
            </span>
            <input type="hidden" class="orders-id" value="{{$question->id}}">
            <!-- todo text -->
            <span class="text">{{$question->title}}</span>
            
            <!-- General tools such as edit or delete-->
            <div class="float-right">
                <div class="rounded px-2 bg-info">
                    {{$question->orders}}
                </div>
            </div>
        </li>
        @endforeach
        
    </ul>
</div>