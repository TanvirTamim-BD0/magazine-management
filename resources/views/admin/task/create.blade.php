@extends('layouts.admin')
@section('content')
<style>
        /* jQuery UI Datepicker Basic Style */
    .ui-datepicker {
        font-size: 14px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .ui-datepicker .ui-datepicker-header {
        background-color: #f7f7f7;
        color: #333;
        text-align: center;
        padding: 8px;
        border-bottom: 1px solid #ccc;
    }

    .ui-datepicker .ui-datepicker-prev, .ui-datepicker .ui-datepicker-next {
        background-color: transparent;
        color: #333;
        border: none;
        font-size: 18px;
        padding: 5px;
    }

    .ui-datepicker .ui-datepicker-calendar td {
        padding: 8px;
        text-align: center;
        cursor: pointer;
    }

    .ui-datepicker .ui-datepicker-calendar td:hover {
        background-color: #f1f1f1;
    }

    .ui-datepicker .ui-datepicker-calendar .ui-state-highlight {
        background-color: #ddd;
        color: #333;
    }
</style>

<div class="d-flex justify-content-center align-items-center">
<div class="card" style="width: 45rem;">
    <div class="card-header">
        Create Task
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.task.store") }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
            </div>

            <div class="form-group">
                    <label class="required" for="assign_by">Assign By</label>
                        <select class="form-control select2 {{ $errors->has('assign_by') ? 'is-invalid' : '' }}" name="assign_by" required>
                            <option selected disabled></option>
                            @foreach($userData as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
            </div>

            <div class="form-group">
                <label class="required" for="deadline">Deadline</label>
                <input class="form-control {{ $errors->has('deadline') ? 'is-invalid' : '' }}" type="text" name="deadline" id="deadline"required>
            </div>

            <div class="form-group">
                    <label class="required" for="priority">Priority</label>
                        <select class="form-control select2 {{ $errors->has('priority') ? 'is-invalid' : '' }}" name="priority" required>
                            <option selected disabled></option>
                            <option value="1"> 1</option>
                            <option value="2"> 2</option>
                            <option value="3"> 3</option>
                            <option value="4"> 4</option>
                            <option value="5"> 5</option>
                            <option value="6"> 6</option>
                            <option value="7"> 7</option>
                            <option value="8"> 8</option>
                            <option value="9"> 9</option>
                            <option value="10"> 10</option>
                        </select>
            </div>

            <div class="form-group">
                <label class="required" for="remark">Remark</label>
                <textarea class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" type="date" name="remark" id="description"></textarea>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
</div>

<script src="{{ asset('tinymce.min.js') }}"></script>

    <script>
        var editor_config = {
            path_absolute: "/",
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback: function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                    'body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no"
                });
            }
        };

        tinymce.init(editor_config);
    </script>

@endsection

@section('scripts')
@parent
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    // Datepicker for From Date and To Date
    $('#deadline').datepicker({
        dateFormat: 'yy-mm-dd', // Set the date format
        changeMonth: true,
        changeYear: true
    });
</script>
@endsection