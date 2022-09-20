@extends('site.master')

@section('content')

<br>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="">
                <select id="select_category" class="form-control">
                    <option value="">Select</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->$name }}</option>
                    @endforeach
                </select>
                <br>
                <select id="select_product" class="form-control">

                </select>
            </form>
        </div>
    </div>
</div>
<br>
<br>
<br>

@stop

@section('scripts')

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

<script>

    var lang = $('html').attr('lang');
    $('#select_category').on('change', function() {
        var id = $(this).val();

        $.ajax({
            type: 'post',
            url: '{{ route("site.abu_aref_data") }}',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                $('#select_product option').remove();
                res.forEach(function(el) {
                    if (lang == 'en') {
                        var op = '<option value="'+el.id+'">'+el.name_en+'</option>'
                    } else {
                        var op = '<option value="'+el.id+'">'+el.name_ar+'</option>'
                    }

                    $('#select_product').append(op);
                })
            }
        })
    })

</script>

@stop
