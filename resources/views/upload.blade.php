<!DOCTYPE html>
<html>
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

        .form-outline .form-control {
            border: none;
            border-radius: 0;
            border-bottom: 1px solid #ccc;
            box-shadow: none;
        }
    </style>
</head>
<body>
<div class="container" style="max-width: 2000px;">
    <!-- Section: Design Block -->
    <section class="background-radial-gradient overflow-hidden">
        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                    <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                    <div class="card bg-glass">
                        <div class="card-body px-4 py-5 px-md-5">
                            <div class="row d-flex justify-content-center align-items-center h-100">
                                <div class="col-lg-12">
                                    <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="divider d-flex align-items-center my-4">
                                            <img src="{{asset('images/logo.svg')}}" width="100px">
                                        </div>

                                        <div class="form mb-4">
                                            <input type="file" id="file" name="file" class="form-control form-control-lg"
                                                   placeholder="Select File" onchange="setFileName(this)"/>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input type="text" id="title" name="title" class="form-control form-control"
                                                   placeholder="Set Title" readonly/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="message" name="message" class="form-control form-control"
                                                   placeholder="Set Messages"/>
                                        </div>

                                        <div class="text-center text-lg-start mt-4 pt-2">
                                            <button type="submit" class="btn btn-primary"
                                                    style="padding-left: 2.5rem; padding-right: 2.5rem; background-color: #293E63">Upload
                                            </button>
                                            <a href="{{route('home')}}" class="btn btn-secondary"
                                               style="padding-left: 2.5rem; padding-right: 2.5rem; background-color: #580687">Home
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        Share and Access Your Files<br/>
                        <span style="color: hsl(218, 81%, 75%)">Anytime, Anywhere</span>
                    </h1>
                    <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                        Upload your files and access them securely from anywhere. Simple and easy file sharing platform
                        for all your needs.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: Design Block -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function setFileName(input) {
        const file = input.files[0];
        if (file) {
            const titleInput = document.getElementById('title');
            titleInput.value = file.name;
            titleInput.removeAttribute('readonly');
        } else {
            document.getElementById('title').value = '';
        }
    }
</script>
</body>
</html>
