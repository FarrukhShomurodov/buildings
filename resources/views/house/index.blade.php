@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">Houses</h5>
            <a href="{{ route('houses.create') }}" class="btn btn-primary" style="margin-right: 22px;">Create</a>
        </div>


        <div class="card-datatable table-responsive">
            <table class="datatables-users table border-top">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Photo</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($houses as $house)
                    <tr>
                        <td>{{ $house->id }}</td>
                        <td>{{ $house->name }}</td>
                        <td>{{ $house->description }}</td>
                        <td class="main__td">
                            <div class="td__img">
                                <img class="popup-img" src="storage/{{ $house->photo_url }}" alt="House Photo"/>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('houses.edit', $house->id) }}" class="btn btn-warning"
                               style="margin-right: 22px;">Udpate</a>
                        </td>
                        <td>

                            <form action="{{ route('houses.destroy', $house->id) }}" method="POST"
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
        $(document).ready(function () {
            $('.popup-img').on('click', function () {
                var src = $(this).attr('src');
                var popup = `
                <div class="popup-overlay" onclick="$(this).remove()">
                    <img src="${src}" class="popup-img-expanded">
                </div>
            `;
                $('body').append(popup);
            });
        });
    </script>
@endsection
