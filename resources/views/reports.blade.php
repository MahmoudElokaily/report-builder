<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Okaily</title>
    <link rel="stylesheet" href="{{asset('style/style.css')}}" />
</head>
<body>

<div class="container">
    <div class="select choice">
        @foreach($tables as $table)
{{--            <a href="" class="st"><p draggable="true">{{$table->Tables_in_mirage}}</p></a>--}}
            <h3 class="{{$table->Tables_in_mirage}}"  draggable="true">{{$table->Tables_in_mirage}}</h3>
        @endforeach

    </div>
    <div class="show">
        <div class="contact-form">
            <form action="{{route('make-report')}}" method="post" class="fixed">
                @csrf
                <input type="text" name="name" id="table-name" value="" hidden>
                <div class="choice">
                    <p class="Enter" >Enter The Text Below</p>
                </div>
                    <div class="select-list">

                        <ul class="list">

                        </ul>

                    </div>
                    <button class="btn" type="submit">Report</button>
            </form>
        </div>
    </div>
</div>
    <script type="text/javascript">
        var a = document.getElementsByTagName('h3');
        var choice = document.getElementsByClassName('choice');
        var dragItem = null;
        for (var i of a){
            i.addEventListener('dragstart' , dragStar);
            i.addEventListener('dragend' , dragEnd);
        }
        function dragStar(){
            dragItem = this;
            setTimeout(()=>this.style.display = 'none' , 0);
        }
        function dragEnd(){
            dragItem = this;
            setTimeout(()=>this.style.display = "block" , 0);
        }
        for (j of choice){
            j.addEventListener('dragover' , dragOver);
            j.addEventListener('dragenter' , dragEnter);
            j.addEventListener('dragleave' , dragLeave);
            j.addEventListener('drop' , Drop);
        }
        function Drop(){
            this.append(dragItem);
            var table = dragItem.getAttribute("class");
            console.log(table);
            $('input[name="name"]').val(table);
            $.ajax({
                type: 'get',
                url: '{{route('get-table-fields')}}',
                dataType: 'json',
                data: {
                    table : table,
                },
                success: function(data) {
                    $("ul").empty();
                    $.each(data, function(i,item){
                        $(".list").append(` <li style="background: white"><input type="checkbox" name="list[]" id="GFG" value="${item.Field}"> ${item.Field}</li> <br> `).trigger('change');
                    }) ;

                },
                error: function(data) {
                    alert("error");
                },

            });

        }
        function dragOver(e){
            e.preventDefault();
            this.style.border = "2px dotted cyan";
        }
        function dragEnter(e){
            e.preventDefault();
        }
        function dragLeave(e){
            this.style.border = "none";
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

</body>
</html>
