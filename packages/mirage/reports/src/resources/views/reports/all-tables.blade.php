<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Okaily</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">

    <!-- Bootstrap core CSS -->

</head>

<body>

<header>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <strong>Reports</strong>
            </a>

        </div>
    </div>
</header>

<main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Reports Builder</h1>
            <p>
                <button disabled type="button" class="btn btn-primary t-report">Table Report</button>
                <button  type="button" class="btn btn-primary c-report">Charts Report</button>
            </p>
            <select class="form-select select-table mb-3" aria-label="Default select example">
                <option selected value="null">Select Table Name</option>
                @foreach($tables as $table)
                    <option value="{{$table->Tables_in_mirage}}">{{$table->Tables_in_mirage}}</option>
                @endforeach
            </select>
            <p class="mb-3">OR</p>
            <div class="input-group mb-3">
                <input type="text" class="form-control model-name" name="model" aria-describedby="inputGroup-sizing-default" placeholder="Write model name with his namespace">
            </div>
        </div>
        <form action="{{route('make-report')}}" method="post">
            @csrf
            <input type="text" name="name" id="table-name" value="" hidden>
            <input type="text" name="model" id="model-name" value="" hidden>
            <div class="container">
                <ul class="list-group item-checked">
                </ul>
            </div>
            <div class="container mb-5">
                <div class="dropdown">
                    <select class="form-select select-type" name="type" aria-label="Default select example" style="display: none;">
                        <option selected value="doughnut">Doughnut Chart</option>
                        <option value="line">Line Chart</option>
                        <option value="bar">Bar Chart</option>
                        <option value="bubble">Bubble Chart</option>
                        <option value="polarArea">Polar Area Chart</option>
                        <option value="radar">Radar Chart</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-lg btn-block">Show</button>
        </form>

    </section>


</main>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script type="text/javascript">
        $(".c-report").on('click', function () {
            $(this).prop("disabled", true);
            $(".t-report").prop("disabled", false);
            $(".select-type").css("display", "block");
            $(".select-type").name = "type";
            $(".list-group").empty();
        });
        $(".t-report").on('click', function () {
            $(this).prop("disabled", true);
            $(".c-report").prop("disabled", false);
            $(".select-type").css("display", "none");
            $(".select-type").name = "";
            $(".list-group").empty();
        });

        $(".select-table").on('change', function () {
            $(".list-group").empty();
            var type = $('.c-report').is(':disabled') == false ? "checkbox" : "radio";
            var name = type == "checkbox" ? "list[]" : "field";
            var table = $('.select-table').val();

            $('input[name="name"]').val(table);
            $.ajax({
                type: 'get',
                url: '{{route('get-fields')}}',
                dataType: 'json',
                data: {
                    flag:"table",
                    table: table,
                },
                success: function (data) {
                    $.each(data, function(i,item){
                        optionTemp = '';
                        optionTemp +=
                        // $(".list-group").append(`  <div class="row"><div class="col"><label class="list-group-item"><input value="${item.Field}" class="form-check-input me-1" name="${name}" type="${type}">${item.Field}</label></div> <div class="col"><label class="list-group-item"><input type="checkbox" class="form-check-input me-1">Has Relation</label></div></div> `).trigger('change');
                        $(".list-group").append(` <label class="list-group-item"><input value="${item.Field}" class="form-check-input me-1" name="${name}" type="${type}">${item.Field}</label> `);
                    }) ;
                },
                error: function (data) {
                    alert("error");
                },

            });
        });


        $(".model-name").on('change', function () {
            $(".list-group").empty();
            var type = $('.c-report').is(':disabled') == false ? "checkbox" : "radio";
            var name = type == "checkbox" ? "list[]" : "field";
            var model = $('.model-name').val();

            $('input[name="model"]').val(model);
            $.ajax({
                type: 'get',
                url: '{{route('get-fields')}}',
                dataType: 'json',
                data: {
                    flag:"model",
                    table: model,
                },
                success: function (data) {
                    $.each(data, function(i,item){
                        $(".list-group").append(`  <label class="list-group-item"><input value="${item}" class="form-check-input me-1" name="${name}" type="${type}">${item}</label> `).trigger('change');
                    }) ;
                },
                error: function (data) {
                    $(".model-name").val('');
                    $(".model-name").attr("placeholder", "No Model in database such that");
                },

            });
        });

        $(document).on("click" , ".checked" , function() {
            console.log($(this).parent().parent())
            alert($(this).parent())
            $($(this).parent().parent()).find(".collapse").addClass("in show");
        });
</script>
</body>
</html>
