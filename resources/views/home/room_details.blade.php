<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('home.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style type="text/css">
        label {
            display: inline-block;
            width: 200px;
        }

        input {
            width: 100%;
        }

        .amenity-checkbox {
            margin-right: 10px;
        }
    </style>
</head>

<body class="main-layout">

    <!-- loader -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div>
    <!-- end loader -->

    <!-- header -->
    <header>
        @include('home.header')
    </header>
    <!-- end header -->

    <div class="our_room">
        <div style="padding-top: 40px" class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Room</h2>
                        <p>Lorem Ipsum available, but the majority have suffered</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Room Info -->
                <div class="col-md-8">
                    <div id="serv_hover" class="room">
                        <div style="padding: 20px" class="room_img">
                            <figure>
                                <img style="height: 300px; width:800px;" src="/room/{{$room->image}}" alt="#">
                            </figure>
                        </div>

                        <div class="bed_room" style="padding:40px;text-align: center;">
                            <b>
                                <h2 style="font-size: 18px">{{$room->room_title}}</h2>
                            </b>
                            <p>{{$room->description}}</p>
                            <h4 style="padding-top: 10px">Free wifi : {{$room->wifi}}</h4>
                            <h4>Room Type : {{$room->room_type}}</h4>
                            <b>
                                <h3 style="font-size: 17px">Price : {{$room->price}}</h3>
                            </b>
                        </div>
                    </div>
                </div>

                <!-- Booking Form -->
                <div class="col-md-4">
                    <h1 style="font-size:40px !important;">Book Room</h1>

                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                            {{session()->get('message')}}
                        </div>
                    @endif

                    @if($errors->any())
                        <ul style="padding-left: 20px; margin-bottom: 15px;">
                            @foreach ($errors->all() as $error)
                                <li style="color: red;">{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form action="{{url('add_booking',$room->id)}}" method="POST">
                        @csrf

                        <div>
                            <label>Name</label>
                            <input type="text" name="name"
                                @if (Auth::id()) value="{{ Auth::user()->name }}" @endif>
                        </div>

                        <div>
                            <label>Email</label>
                            <input type="email" name="email"
                                @if (Auth::id()) value="{{ Auth::user()->email }}" @endif>
                        </div>

                        <div>
                            <label>Phone</label>
                            <input type="tel" name="phone"
                                @if (Auth::id()) value="{{ Auth::user()->phone }}" @endif>
                        </div>

                        <div>
                            <label>Checkin</label>
                            <input type="date" name="startDate" id="startDate">
                        </div>

                        <div>
                            <label>Checkout</label>
                            <input type="date" name="endDate" id="endDate">
                        </div>

                        <!-- Amenities Section -->
                        <h5 style="margin-top:20px;">Optional Amenities</h5>
                        @foreach($amenities as $amenity)
                            <div class="form-check">
                                <input class="form-check-input amenity-checkbox" type="checkbox"
                                    value="{{ $amenity->id }}" data-price="{{ $amenity->price }}"
                                    id="amenity{{ $amenity->id }}" name="amenities[]">
                                <label class="form-check-label" for="amenity{{ $amenity->id }}">
                                    {{ $amenity->name }} (+{{ $amenity->price }} Rs)
                                </label>
                            </div>
                        @endforeach

                        <p style="margin-top:10px;">Total Price: <span id="totalPrice">{{$room->price}}</span> Rs</p>

                        <div style="padding-top:20px;">
                            <input type="submit" style="background-color:rgb(90, 174, 207)"
                                class="btn btn-primary" value="Book Room">
                        </div>
                    </form>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </div>

    <footer>
        @include('home.footer')
    </footer>

    @include('home.js')

    <script type="text/javascript">
        $(function () {
            var dtToday = new Date();
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();

            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            $('#startDate').attr('min', maxDate);
            $('#endDate').attr('min', maxDate);
        });

        // Live total price calculation
        let basePrice = {{$room->price}};
        const checkboxes = document.querySelectorAll('.amenity-checkbox');
        const totalPriceEl = document.getElementById('totalPrice');

        checkboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                let total = basePrice;
                checkboxes.forEach(c => {
                    if (c.checked) {
                        total += parseInt(c.dataset.price);
                    }
                });
                totalPriceEl.textContent = total;
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

</body>
</html>
