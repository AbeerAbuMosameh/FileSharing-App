<!DOCTYPE html>
<head>
    <title>File Sharing App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <style>
        .background-radial-gradient {
            background-color: hsl(218, 41%, 15%);
            background-image: radial-gradient(650px circle at 0% 0%,
            hsl(218, 41%, 35%) 15%,
            hsl(218, 41%, 30%) 35%,
            hsl(218, 41%, 20%) 75%,
            hsl(218, 41%, 19%) 80%,
            transparent 100%),
            radial-gradient(1250px circle at 100% 100%,
                hsl(218, 41%, 45%) 15%,
                hsl(218, 41%, 30%) 35%,
                hsl(218, 41%, 20%) 75%,
                hsl(218, 41%, 19%) 80%,
                transparent 100%);
        }

        #radius-shape-1 {
            height: 220px;
            width: 220px;
            top: -60px;
            left: -130px;
            background: radial-gradient(#44006b, #ad1fff);
            overflow: hidden;
        }

        #radius-shape-2 {
            border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
            bottom: -60px;
            right: -110px;
            width: 300px;
            height: 300px;
            background: radial-gradient(#44006b, #ad1fff);
            overflow: hidden;
        }

        .bg-glass {
            background-color: hsla(0, 0%, 100%, 0.9) !important;
            backdrop-filter: saturate(200%) blur(25px);
        }
    </style>
</head>
<body>
<div class="container" style="max-width: 2000px;">
    <!-- Section: Design Block -->
    <section class="background-radial-gradient overflow-hidden">
        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-5 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        Share and Access Your Files<br/>
                        <span style="color: hsl(218, 81%, 75%)">Anytime, Anywhere</span>
                    </h1>
                    <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                        Upload your files and access them securely from anywhere. Simple and easy file sharing platform
                        for all your needs.
                    </p>
                    <div class="text-center text-lg-start mt-4 pt-2">
                        <a href="{{route('file.upload')}}" class="btn btn-primary"
                           style="padding-left: 2.5rem; padding-right: 2.5rem; background-color: #293E63">Upload New
                            file
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 mb-5 mb-lg-0 position-relative">
                    <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                    <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                    @if (!$files->isEmpty()) {
                        <div class="card bg-glass">
                            <div class="card-body px-12 py-12 px-md-12">
                                <div class="row d-flex justify-content-center align-items-center h-100">
                                    <div class="col-lg-12">
                                        <h4> Uploaded Files</h4>
                                        <table class="table" style="--bs-table-bg: FFFFFFE5;">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Type of file</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($files as $file)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $file->title }}</td>
                                                    <td>{{ $file->extension }} File</td>
                                                    <td>
                                                        <a href="{{ route('file.download.signed', ['link' => $file->download_link]) }}"
                                                           class="btn btn-sm btn-clean btn-icon"
                                                           title="Download File">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                        <button class="btn btn-sm btn-clean btn-icon"
                                                                title="Copy file path to share"
                                                                onclick="copyToClipboard('{{ $downloadUrls[$file->id] }}')">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                        <a onclick="sweet('{{$file->id}}',this)" class="btn btn-sm btn-clean btn-icon"
                                                           title="Delete"><i class="nav-icon fa fa-trash"></i></a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <img src="{{asset('images/file.svg')}}" width="400px">
                    @endif

                </div>

            </div>
        </div>

</div>
</section>
<!-- Section: Design Block -->
</div>

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
<script>
    function sweet(id, reference) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#ff0303',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/file/delete/' + id, // Update the URL to match your file deletion route
                    method: 'DELETE',
                    data: {_token: '{{ csrf_token() }}'},
                    success: function (response) {
                        // Show the success message
                        Swal.fire(
                            'Deleted!',
                            'The file has been deleted.',
                            'success'
                        ).then((result) => {
                            // Reload the page to update the file list
                            location.reload();
                        });
                    },
                    error: function (xhr, status, error) {
                        // Show the error message
                        Swal.fire(
                            'Error!',
                            'There was an error deleting the file.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
