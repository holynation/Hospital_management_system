"use strict";

$(document).ready(function() {
    // var base_url = '<?php echo base_url(); ?>';

    $("#multiselect1").multiselect({
        buttonWidth: '160px'
    });
    $("#multiselect2").multiselect({
        enableFiltering: true,
        includeSelectAllOption: true,
        maxHeight: 300,
        dropUp: true
    });
    $("#select21").select2({
        theme: "bootstrap",
        placeholder: "single select"
    });
    $("#select211").select2({
        theme: "bootstrap",
        placeholder: "select medicine"
    });


    $("#select22").select2({
        theme: "bootstrap",
        placeholder: "multi select"
    });

    function formatState(state) {
        if (!state.id) {
            return state.text;
        }
        var $state = $(
            '<span><img src="img/us_states_flags/' + state.element.value.toLowerCase() + '.png" class="img-flag"  width="20px" height="20px"/> ' + state.text + '</span>'
        );
        return $state;
    }

    $("#select23").select2({
        templateResult: formatState,
        templateSelection: formatState,
        placeholder: "select with country flag",
        theme: "bootstrap"
    });
    $('#select24').select2({
        allowClear: true,
        theme: "bootstrap",
        placeholder: "select"
    });
    $('#select25').select2({
        allowClear: true,
        theme: "bootstrap",
        placeholder: "select"
    });

    $('#select26').select2({
        placeholder: "select",
        theme: "bootstrap"
    });


    $('#select-gear').selectize({
        sortField: 'text'
    });
    $("#selectize3").selectize({
        maxItems: 3
    });
    $('#selectize-tags1').selectize({
        plugins: ['restore_on_backspace'],
        delimiter: ',',
        persist: false,
        create: function (input) {
            return {
                value: input,
                text: input
            }
        }
    });
    $('#selectize-tags2').selectize({
        plugins: ['remove_button'],
        delimiter: ',',
        persist: false,
        create: function (input) {
            return {
                value: input,
                text: input
            }
        }
    });
    $('#selectize-tags3').selectize({
        plugins: ['drag_drop'],
        delimiter: ',',
        persist: false,
        create: function (input) {
            return {
                value: input,
                text: input
            }
        }
    });

//Get selected option value
    var $selectValue = $('#select_value').find('strong');
    $selectValue.text($('#get_value').val());
    $('#get_value').selectric().on('change', function () {
        $selectValue.text($(this).val());
    });

    var base_url = '<?php echo base_url(); ?>';

    var $selectValue = $('#feedstockform');
    $selectValue.text($('#select211').val());
    $('#select211').selectric().on('change', function () {
        var id = $(this).val();

        $.get('../get_medicine_jquery' , {id: id},
         function(result){
            // console.log(result);
            // var dataArray = result.split("||");
            // var html_output = "";
            // var i = 0;
            // for(i; i < dataArray.length - 1;i++){
            //     var itemArray = dataArray[i].split("|");

            //     html_output += 
            //     '<div class="col-sm-3"><div class="panel"><div class="panel-heading"><h3 class="panel-title"> class="fa ti-list" aria-hidden="true"></i> Selected Drugs</h3></div></div><div class="panel-body"><div class="box-body"><div class="form-group"><p id="select_value"><strong>'+itemArray[1]+'</strong></p></div></div></div></div><form id="form-validation" action="" method="post" class="form-horizontal"><div class="col-sm-12"><div class="panel"><div class="panel-heading"><h3 class="panel-title"><i class="fa ti-list" aria-hidden="true"></i> Selected Item</h3></div></div><div class="panel-body"><div class="col-sm-12"><div class="form-group"><label class="col-sm-5 control-label" for="">Name :</label><div class="col-sm-7">'+itemArray[1]+'</div></div><div class="form-group"><label class="col-sm-5 control-label" for="">Company :</label><div class="col-sm-7">'+itemArray[2]+'</div></div><div class="form-group"><label class="col-sm-5 control-label" for="">Price :</label><div class="col-sm-7">'+itemArray[3]+'</div></div><div class="form-group"><label class="col-sm-5 control-label" for="">Current Stock :</label><div class="col-sm-7">'+itemArray[4]+'</div></div><div class="form-group"><label class="col-sm-5 control-label" for="">Quantity :</label><div class="col-sm-7"><input type="text" name="quantityForm" value="1" class="form-control"></div></div></div></div></div></form>';   
            // }

            $selectValue.html(result);
        });

        
        // $selectValue.text(id);

        // var results_box = document.getElementById("feedstockform");

        //     // results_box.innerHTML = '<img style="padding-left:40%;margin:auto;" src="images/loader.gif" />';

        //     var hr = new XMLHttpRequest();
        //         hr.open("post", "../get_medicine_jquery", true);
        //         hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //         hr.onreadystatechange = function(){
        //             if(hr.readyState == 4 && hr.status == 200){
        //                 var dataArray = hr.responseText.split("||");
        //                 var html_output = "";
        //                 var i = 0;
        //                 for(i; i < dataArray.length - 1;i++){
        //                     var itemArray = dataArray[i].split("|"); // 39|title|date|data

        //                     html_output += 
        //                     '<div class="col-sm-3"><div class="box-body"><div class="form-group"><p id="select_value"><strong>'+itemArray[1]+'</strong></p></div></div></div><form id="form-validation" action="" method="post" class="form-horizontal"><div class="col-sm-5"><div class="panel"><div class="panel-heading"><h3 class="panel-title"><i class="fa ti-list" aria-hidden="true"></i> Selected Item</h3></div></div><div class="panel-body"><div class="col-sm-12"><div class="form-group"><label class="col-sm-5 control-label" for="">Name :</label><div class="col-sm-7">'+itemArray[1]+'</div></div><div class="form-group"><label class="col-sm-5 control-label" for="">Company :</label><div class="col-sm-7">'+itemArray[2]+'</div></div><div class="form-group"><label class="col-sm-5 control-label" for="">Price :</label><div class="col-sm-7">'+itemArray[3]+'</div></div><div class="form-group"><label class="col-sm-5 control-label" for="">Current Stock :</label><div class="col-sm-7">'+itemArray[4]+'</div></div><div class="form-group"><label class="col-sm-5 control-label" for="">Quantity :</label><div class="col-sm-7"><input type="text" name="quantityForm" value="1" class="form-control"></div></div></div></div></div></form>';   
        //                 }

        //                 results_box.innerHTML = html_output;    
        //             }
        //         }

        //         hr.send("id="+id);

    });
//Get selected option value end

//Set value
    $('#set_value').selectric();

    $('#set_first_option').on('click', function () {
        $('#set_value').prop('selectedIndex', 0).selectric('refresh');
    });

    $('#set_second_option').on('click', function () {
        $('#set_value').prop('selectedIndex', 1).selectric('refresh');
    });

    $('#set_third_option').on('click', function () {
        $('#set_value').prop('selectedIndex', 2).selectric('refresh');
    });
    $('#set_fourth_option').on('click', function () {
        $('#set_value').prop('selectedIndex', 3).selectric('refresh');
    });
//Set value end

//Change options on the fly
    $('#dynamic').selectric();
    $('#dynamicnew').selectric();

    $('#bt_add_val').on('click', function () {
        var value = $.trim($('#add_val').val());
        $('#dynamic').append('<option>' + (value ? value : 'Empty') + '</option>').selectric('refresh');
        $('#add_val').val("");
    });
//Change options on the fly end
});