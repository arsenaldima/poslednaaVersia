

    function funS(){

        if($('#but').val()=="Подписаться на рассылку")
            $('#but').val("Отписаться от рассылки");
        else
            $('#but').val("Подписаться на рассылку");
    }

    function Fun(){
        $('#FormSms').hide();
        $('#metka').show();
        alert('Сообщение успешно отправлено');

    }



    $(document).ready(function(){

        $('#but').bind("click",function(){

            $.ajax({
                url:"http://web/UserPersonal/AxjaxQuery",
                type:"POST",
                data:({}),
                dataType:"html",
                success: funS
            });
        })

        $('#metka').bind("click",function(){
            $('#metka').hide();
            $('#FormSms').show(1000);


        });

        $('#sub_but').bind("click",function(){

            $.ajax({
                url:"http://web/UserPersonal/AxjaxMail",
                type:"POST",
                data:({text: $('#SmsId').val(), id:$('#IdUser').val()}),
                dataType:"html",
                success: Fun
            });
        });

		 $('#graphShow').bind("click",function(){
            $('#graphShow').hide();
            $('#graphClose').show(1000);
			$('#graph').show(1000);


        });
		
		 $('#graphClose').bind("click",function(){
            $('#graphClose').hide();
            $('#graphShow').show(1000);
			$('#graph').hide();


        });
		
		$('#PageShow').bind("click",function(){
            $('#PageShow').hide();
            $('#PageClose').show(1000);
			$('#MyPage').show(1000);


        });
		
		 $('#PageClose').bind("click",function(){
            $('#PageClose').hide();
            $('#PageShow').show(1000);
			$('#MyPage').hide();


        });
		$('#CommentShow').bind("click",function(){
            $('#CommentShow').hide();
            $('#CommentClose').show(1000);
			$('#MyComment').show(1000);


        });
		
		 $('#CommentClose').bind("click",function(){
            $('#CommentClose').hide();
            $('#CommentShow').show(1000);
			$('#MyComment').hide();


        });

        $('#ButPol').bind("click",function(){


            var status=this.innerHTML;

            if(status=="Показать приглашоных пользователей")
            {
                this.innerHTML="Скрыть приглашоных пользователей";
                $('#idBut').show(1000);
            }
            else
            {
                this.innerHTML="Показать приглашоных пользователей";
                $('#idBut').hide(1000);
            }


        });




    });

