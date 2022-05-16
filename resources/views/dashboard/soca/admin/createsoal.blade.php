@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Soal SOCA</h1>
    </div>

    @if ($errors->has('errorJam'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('errorJam') }}
        </div>
    @endif

    <div class="d-flex justify-content-between">
        <a href="/dashboard/settingsoca" class="btn btn-success">
            <span data-feather="arrow-left"></span> Kembali
        </a>
    </div>

    <div class="col-lg-8 mt-3">
        <form method="post" action="/dashboard/settingsoca/createsoal/tambah" class="mb-5"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama_soca" class="form-label">Nama SOCA</label>
                <select class="form-select" id="nama_soca" name="nama_soca">
                    @foreach ($namasocas as $namasoca)
                        <option value="{{ $namasoca->namasoca }}">{{ $namasoca->namasoca }}</option>
                    @endforeach
                </select>
            </div>

            <table class="table table-borderless" id="dynamicTable">
                <tr>
                    <th>Soal Analisa Kasus II</th>
                    <th>Bobot</th>
                </tr>
                <tr>
                    <td><input type="text" name="soals[0][soal]" class="form-control" /></td>
                    <td><input type="text" name="bobots[0][bobot]" class="form-control" /></td>
                    <td><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
                </tr>
            </table>

            <button type="submit" class="btn btn-primary">Tambah</button>

        </form>
    </div>

    <script type="text/javascript">
        var i = 0;

        $("#add").click(function() {

            ++i;

            $("#dynamicTable").append('<tr><td><input type="text" name="soals[' + i + '][soal]" class="form-control" /></td><td><input type="text" name="bobots[' + i + '][bobot]" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">-</button></td></tr>'
            );
        });

        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endsection
