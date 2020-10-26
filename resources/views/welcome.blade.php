<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <style>
            .right-list-wrapper h3 {
                height: 38px;
                margin-bottom: 1rem;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Items Management Page</h2>
            <div class="row">
                <div class="col-xl-5 col-lg-5">
                    <div class="left-list-wrapper">
                        <form action="{{ route('addItem') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name">
                                <button class="btn btn-primary">Add</button>
                            </div>
                            @if ($errors->has('name'))
                                <small style="color: red">Item should be unique</small>
                            @endif           
                        </form>

                        <div class="list-wrapper">
                            <select multiple id="available-fields" class="form-control">
                                @foreach ($leftItems as $leftItem)
                                    <option value="{{ $leftItem->id }}">{{ $leftItem->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2">
                    <button id="btnRight" class="btn btn-secondary w-100">></button>
                    <button id="btnLeft" class="btn btn-secondary w-100 mt-5"><</button>
                </div>

                <div class="col-xl-5 col-lg-5">
                    <div class="right-list-wrapper">
                        <h3>Selected Items</h3>
                        <div class="list-wrapper">
                            <select multiple id="selected-fields" class="form-control">
                                @foreach ($rightItems as $rightItem)
                                    <option value="{{ $rightItem->id }}">{{ $rightItem->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function () {
                $("#btnRight").click(function () {
                    const index = $("#available-fields").prop('selectedIndex');
                    const name = $($("#available-fields option")[index]).val();

                    $.ajax({
                        url: "{{ route('moveToRight') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            name
                        }
                    }).done(function () {
                        location.reload();
                    })
                })

                $("#btnLeft").click(function () {
                    const index = $("#selected-fields").prop('selectedIndex');
                    const name = $($("#selected-fields option")[index]).val();

                    $.ajax({
                        url: "{{ route('moveToLeft') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            name
                        }
                    }).done(function () {
                        location.reload();
                    })
                })
            })
        </script>
    </body>
</html>
