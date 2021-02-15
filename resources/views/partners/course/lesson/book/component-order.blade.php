<div class="card-body">
    <ul class="todo-list ui-sortable" data-widget="todo-list">
        
        @foreach ($books as $book)
        <li class="" style="">
            <!-- drag handle -->
            <span class="handle ui-sortable-handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
            </span>
            <input type="hidden" class="orders-id" value="{{$book->id}}">
            <!-- todo text -->
            <span class="text">{{$book->title}}</span>
            
            <!-- Emphasis label -->
            <small class="badge badge-secondary">{{$book->size}}</small>
            <!-- General tools such as edit or delete-->
            <div class="float-right">
                <div class="rounded px-2 bg-info">
                    {{$book->orders}}
                </div>
            </div>
        </li>
        @endforeach
        
    </ul>
</div>