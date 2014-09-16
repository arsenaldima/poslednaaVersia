$(document).ready(function(){

    $('#dat').bind("change",function(){
        var date =  $('#dat').val();
        var razd =date.substr(2, 1);

        if(razd=='/')
        {
            var year=date.substr(6, 2);
            var month=date.substr(0, 2);
            var day = date.substr(3,2);

            var year=Number(year)+Number(2000);
            date=null;
            date=year+'/'+month+'/'+day;
        }
        else
        {
            var year=date.substr(0, 4);
            var month=date.substr(5, 2);
            var day = date.substr(8);
        }

        if(Number(day)<=Number($('#day').val()))
        {
            if((Number(month)<=Number($('#month').val()))||((Number(year)<Number($('#year').val()))&&Number(month)>Number($('#month').val())))
            {
                var id = $('#cat').val();
                window.location.href='http://web/page/index?data='+date+'&id='+id;
            }
            else
            {
                $('#dat').val(null);
                alert("Дата не может быть больше текущей");
            }
        }
        else
        {
            $('#dat').val(null);
            alert("Дата не может быть больше текущей");

        }
    });



});