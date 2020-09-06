$(function () {
    //Textare auto growth
    //autosize($('textarea.auto-growth'));

    //Datetimepicker plugin
    //$('.datetimepicker').bootstrapMaterialDatePicker({
       // format: 'dddd DD MMMM YYYY - HH:mm',
       // clearButton: true,
       // weekStart: 1
  //  });

    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'Y-MM-DD',
        clearButton: false,
        weekStart: 1,
        time: false
    });

   // $('.timepicker').bootstrapMaterialDatePicker({
   //     format: 'HH:mm',
    //    clearButton: true,
   //     date: false
  //  });
  $('#cari').click(function(){
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        if (from_date != '' && to_date != '')
        {
            $.ajax({
                url:"?page=datapenjualan&aksi=filter",
                method: "POST",
                data:{from_date:from_date,to_date:to_date},
                success:function(data)
                {
                    
                }
            })
        }
  });
});