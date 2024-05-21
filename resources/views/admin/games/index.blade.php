@extends('layouts.admin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Danh Sách Game</h4>

                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Thumbnail</th>
                            <th>Thể loại</th>
                            <th>Game/App</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($games as $game)
                            <tr class="td-custom">
                                <td>
                                    {{$game->id}}

                                </td>
                                <td>
                                    <a href="{{route('admin.game.edit', $game->id)}}">{{$game->name}}</a>
                                </td>
                                <td>
                                    <img src="{{$game->thumbnail}}" style="border-radius: 0">
                                </td>

                                <td>
                                        <label style="width: max-content" class="badge badge-danger">{{$game->genres->name}}</label>
                                </td>

                                <td >
                                    <label style="width: max-content" class="badge badge-danger">{{$game->type ? 'Game' : 'App'}}</label>
                                </td>

                                <td>

                                        <form onsubmit="if (!confirm('Bạn có chắc chắn muốn xóa ?')) return false;" class="ms-2" method="POST" action="{{ route('admin.game.destroy', $game->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-rounded btn-icon">
                                                <i class="typcn typcn-trash"></i>
                                            </button>

                                        </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        {!! $games->links() !!}


                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    <script>

    </script>
@endpush
