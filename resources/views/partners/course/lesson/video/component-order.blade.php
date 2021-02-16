<div class="card-body">
    <ul class="todo-list ui-sortable" data-widget="todo-list">
        
        @foreach ($videos as $video)
        <li class="" style="">
            <!-- drag handle -->
            <span class="handle ui-sortable-handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
            </span>
            <input type="hidden" class="orders-id" value="{{$video->id}}">
            <!-- todo text -->
            <span class="text">{{$video->title}}</span>
            
            <!-- Emphasis label -->
            <small class="badge badge-secondary">{{$video->size}}</small>
            <!-- General tools such as edit or delete-->
            <div class="float-right">
                <div class="rounded px-2 bg-info">
                    {{$video->orders}}
                </div>
            </div>
        </li>
        @endforeach
        
    </ul>
</div>