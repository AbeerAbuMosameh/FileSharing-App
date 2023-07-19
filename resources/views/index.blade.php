<!DOCTYPE html>
<html>
<head>
    <title>File Sharing App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #fff;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
</head>
<body class="d-flex align-items-center" style="height: 100vh;">
<div class="container mt-5">
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">

                <div class="col-lg-4">
                    <img src="{{asset('images/main2.png')}}"
                         class="img-fluid" alt="Sample image">
                    <a href="{{route('file.upload')}}" class="btn btn-primary"
                       style="padding-left: 2rem;padding-right: 2rem;background-color: #094D86;margin-left: 90px; color:#F2AA1F; font-weight:900;">
                        <i class="fas fa-plus"></i>  Add file
                    </a>
                </div>

                <div class="col-lg-8">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">Type of file</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($files as $file)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$file->name}}</td>
                                <td>{{$file->extension}} File</td>
                                <td>
                                    <a href="{{ route('file.download', ['link' => $file->download_link]) }}"
                                       class="btn btn-sm btn-clean btn-icon" title="Download File">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <button class="btn btn-sm btn-clean btn-icon" title="Copy file path to share"
                                            onclick="copyToClipboard('{{ route('file.download', ['link' => $file->download_link]) }}')">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

<script>
    function copyToClipboard(text) {
        var tempInput = document.createElement('input');
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        Swal.fire({
            icon: 'success',
            title: 'Link Copied!',
            text: 'The link has been copied to the clipboard.',
        });
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
