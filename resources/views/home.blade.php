<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sollicitatie-opdracht</title>
        <style>
            body, html {
                margin: 0;
                font-family: sans-serif;
            }
            form {
                position: absolute;
                text-align: center;
                margin: auto;
                height: 0;
                width: 30%;
                min-width: 500px;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
            }
            input {
                display: block;
                width: 100%;
                cursor: pointer;
            }
            input[type="submit"] {
                height: 30px;
                text-transform: uppercase;
                color: #ffffff;
                background-color: #4a5568;
                border: 0;
            }
            input[type="file"] {
                display: none;
            }
            label {
                background-color: #37c637;
                width: 100%;
                display: block;
                padding: 20px 0;
                color: #ffffff;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
    <form action="{{ route('add_person') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label id="upload-label" for="upload">Upload .JSON file</label>
        <input required type="file" name="data_file_upload" id="upload">
        <input type="submit" value="Upload">
    </form>
    <script>
        document.getElementById('upload').onchange = e => {
            document.getElementById('upload-label').innerText =  "Selected file: " + e.target.files[0].name
        }
    </script>
    </body>
</html>
