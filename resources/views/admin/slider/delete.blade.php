<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
    data-bs-target="#exampleModal{{$slider->id}}">
    delete
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal{{$slider->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-4 shadow border-0">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are You Sure..! You want delete this Data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{url('admin/sliders/delete/' .$slider->id)}}" class="btn btn-danger text-white">Yes Delete</a>
            </div>
        </div>
    </div>
</div>