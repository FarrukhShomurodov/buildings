@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">Table Basic</h5>

            <div class="d-flex justify-content-center align-items-center">

                <div class="card-body">
                    <div class="dropdown bootstrap-select" style="width: 200px; height: 40px; margin-right: 10px">
                        <select id="selectpickerBasic" name="apartment_count" class="selectpicker w-100"
                                data-style="btn-default" tabindex="null">
                            @foreach($houses as $house)
                                <option
                                    value="{{ $house->id }}" @selected($house->id == (isset(request()->segments()[1]) ? request()->segments()[1] : 1) )>{{ $house->name }}</option>
                            @endforeach
                            <option disabled @selected(!isset(request()->segments()[1]))>By house</option>

                        </select>
                    </div>
                </div>

                <a href="{{ route('floors.create') }}" class="btn btn-primary" style="margin-right: 22px;">Create</a>
            </div>
        </div>


        <div class="card-datatable table-responsive">
            <table class="datatables-users table border-top">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Number</th>
                    <th>Apartment count</th>
                    <th>House</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($floors as $floor)
                    <tr>
                        <td>{{ $floor->id }}</td>
                        <td>{{ $floor->number }}</td>
                        <td>{{ $floor->apartment_count }}</td>
                        <td>{{ $floor->house->name }}</td>
                        <td>
                            <a href="{{ route('floors.edit', $floor->id) }}" class="btn btn-warning"
                               style="margin-right: 22px;">Udpate</a>
                        </td>
                        <td>
                            <form action="{{ route('floors.destroy', $floor->id) }}" method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" style="margin-left: -40px !important;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('selectpickerBasic').addEventListener('change', function () {
            var houseId = this.value;
            if (houseId) {
                window.location.href = '/floors-by-house/' + houseId;
            }
        });
    </script>
@endsection
