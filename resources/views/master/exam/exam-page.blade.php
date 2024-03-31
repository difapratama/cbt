<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Boxed Layout</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }} ">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('asset/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-boxed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-left: 0px;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>CBT HAJIMAN COURSE</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Question 1-5</h3>
                                    <div class="my-div">Timer: <span id="countdown"></span></div>
                                    {{-- <div id="timer">Timer: 
                                        <span id="countdown" class="direct-chat-timestamp float-right"></span>
                                    </div> --}}
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="lead"><b>다음 그림을 보고 맞는 단어나 문장을 고르십시오 ?:</b></h2>
                                            <div class="form-group">
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="customRadio1"
                                                        name="customRadio">
                                                    <label for="customRadio1" class="custom-control-label">Custom
                                                        Radio</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="customRadio2"
                                                        name="customRadio">
                                                    <label for="customRadio2" class="custom-control-label">Custom
                                                        Radio</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="customRadio3"
                                                        name="customRadio">
                                                    <label for="customRadio3" class="custom-control-label">Custom
                                                        Radio</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="customRadio4"
                                                        name="customRadio">
                                                    <label for="customRadio4" class="custom-control-label">Custom
                                                        Radio</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 text-center">
                                            <img src="https://adminlte.io/themes/v3/dist/img/photo1.png"
                                                alt="user-avatar" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Prev</button>
                                    <button type="submit" class="btn btn-info float-right">Next</button>
                                </div>
                                <!-- /.card-footer-->
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }} "></script>
    <script>
        $(document).ready(function() {
            $("#my-div").timer();
            // Set the time limit for the exam in seconds
            var timeLimit = 120; // 1 hour
            var display = $('#countdown');
            var startTime;
            var remainingTime;

            // Function to start the countdown timer
            function startTimer(duration, display) {
                var timer = duration,
                    minutes, seconds;
                startTime = new Date().getTime();
                sessionStorage.setItem('startTime', startTime);
                var intervalId = setInterval(function() {
                    var now = new Date().getTime();
                    var elapsedTime = now - startTime;
                    remainingTime = duration - Math.floor(elapsedTime / 1000);
                    if (remainingTime <= 0) {
                        // Time's up, perform actions like submitting the exam
                        clearInterval(intervalId);
                        alert('Time is up!');
                        // You may want to submit the exam via AJAX or redirect to another page
                    } else {
                        minutes = parseInt(remainingTime / 60, 10);
                        seconds = parseInt(remainingTime % 60, 10);

                        minutes = minutes < 10 ? "0" + minutes : minutes;
                        seconds = seconds < 10 ? "0" + seconds : seconds;

                        display.text(minutes + ":" + seconds);
                        sessionStorage.setItem('remainingTime', remainingTime);
                    }
                }, 1000);
            }

            // Check if timer was previously started
            if (sessionStorage.getItem('startTime')) {
                var now = new Date().getTime();
                var elapsedTime = now - parseInt(sessionStorage.getItem('startTime'));
                remainingTime = parseInt(sessionStorage.getItem('remainingTime')) - Math.floor(elapsedTime / 1000);
                if (remainingTime > 0) {
                    startTimer(remainingTime, display);
                } else {
                    alert('Time is up!');
                }
            } else {
                startTimer(timeLimit, display);
            }
        });
    </script>
</body>

</html>
