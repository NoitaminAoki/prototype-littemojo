<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Experiences | WHAT YOU WILL LEARN</h3>
            <div class="card-tools">
                <button type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-tool bg-primary">
                    Add Experience(s)
                </button>
            </div>
            <br>
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                    @foreach ($live_experiences as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>        
</div>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Experience</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>{{$name}}</p>
          <input wire:model="name" class="form-control" type="text">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button wire:click="test" type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->