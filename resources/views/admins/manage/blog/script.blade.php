@section('script')
<script src="{{ asset('plugins/summernote/summernote-bs4.js') }}"></script>
<script>
    $('#summernote').summernote({
        height: 300
    });

    var fileInput = document.getElementById('customFile');
    fileInput.addEventListener('change', () => {
        if (fileInput.value !== '') {
            var filename = fileInput.files[0].name;
            fileInput.nextElementSibling.textContent = filename
        }
        else {
            fileInput.nextElementSibling.textContent = 'Choose cover'
        }
    })
</script>
@endsection