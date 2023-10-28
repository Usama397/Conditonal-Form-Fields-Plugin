jQuery(document).ready(function($) {
    $('#harry_fo_select').change(function() {
        var selectedOption = $(this).val();
        if (selectedOption === '1') {
            // User selected "Car," make an AJAX request to fetch data from the API
            $.ajax({
                type: 'GET',
                url: harry_fo_ajax.ajax_url,
                data: {
                    action: 'harry_fo_get_api_response',
                    type:   selectedOption
                },
                success: function(response) {
                    var selectElement = document.getElementById('harry_fo_select_2'); // Replace 'yourSelectElementId' with the actual ID of your <select> element
        
                  
				
	

                    response2 = JSON.parse(response);
                    response2.forEach(function(item) {
                        var option = document.createElement('option');
                        option.value = item.name;
                        option.text = item.name;
                        option.setAttribute("data_set_id", item.id);
                        selectElement.appendChild(option);
                    });
                }
            });
        } else {
            // Reset the second select box when "Select Type" is chosen
            $('#harry_fo_select_2').empty();
        }
    });
});


jQuery(document).ready(function($){
    $("#harry_fo_select_2").change(function(){
        var secondselected = $("#harry_fo_select_2 option:selected").attr('data_set_id');
        alert(secondselected);
            // User selected "Car," make an AJAX request to fetch data from the API
            $.ajax({
                type: 'GET',
                url: harry_fo_ajax.ajax_url,
                data: {
                    action: 'harry_fo_get_api_response_genration',
                    model:   secondselected
                },
                success: function(response) {
                    // Handle the API response and update the second select box
                    const selectElement = document.getElementById('harry_fo_select_3');
                    

                    // Use PapaParse to parse the CSV data
                    $('#harry_fo_select_3')
                    .empty()
                    .append('<option selected="selected" value="00">Select Model</option>');

                  
				

                    response2 = JSON.parse(response);
                    response2.forEach(function(item) {
                        var option = document.createElement('option');
                        option.value = item.name;
                        option.text = item.name;
                        option.setAttribute("data_set_id", item.id);
                        selectElement.appendChild(option);
                    });    
                }
            });
       
    })
});


jQuery(document).ready(function($){
    $("#harry_fo_select_3").change(function(){
        var secondselected = $("#harry_fo_select_3 option:selected").attr('data_set_id');
        $.ajax({
            type: 'GET',
            url: harry_fo_ajax.ajax_url,
            data: {
                action: 'harry_fo_get_api_response_trim',
                generation:   secondselected
            },
            success: function(response) {
                // Handle the API response and update the second select box
                const selectElement = document.getElementById('harry_fo_select_4');
                $('#harry_fo_select_4')
                .empty()
                .append('<option selected="selected" value="00">Select Generation</option>');


              

				
				

                response2 = JSON.parse(response);
                response2.forEach(function(item) {
                    var option = document.createElement('option');
                    option.value = item.name;
                    option.text = item.name;
                    option.setAttribute("data_set_id", item.id);
                    selectElement.appendChild(option);
                });
            }
        });
        
    })
});

jQuery(document).ready(function($){
    $("#harry_fo_select_4").change(function(){
        var secondselected = $("#harry_fo_select_4 option:selected").attr('data_set_id');
        $.ajax({
            type: 'GET',
            url: harry_fo_ajax.ajax_url,
            data: {
                action: 'harry_fo_get_api_response_trim_2',
                trim:   secondselected
            },
            success: function(response) {
                // Handle the API response and update the second select box
                    const selectElement = document.getElementById('harry_fo_select_5');
                // Use PapaParse to parse the CSV data
                
                $('#harry_fo_select_5')
                .empty()
                .append('<option selected="selected" value="00">Select Trim</option>');

           
			

                response2 = JSON.parse(response);
                response2.forEach(function(item) {
                    var option = document.createElement('option');
                    option.value = item.id;
                    option.text = item.name;
                    selectElement.appendChild(option);
                });
                

                
                                   
            }
        });
        
    })
});



jQuery(document).ready(function($){
    $("#harry_fo_select_4").change(function(){
        var secondselected = $("#harry_fo_select_4 option:selected").attr('data_set_id');
        $.ajax({
            type: 'GET',
            url: harry_fo_ajax.ajax_url,
            data: {
                action: 'harry_fo_get_api_response_year',
                trim:   secondselected
            },
            success: function(response) {
                // Handle the API response and update the second select box
                    const selectElement = document.getElementById('harry_fo_select_6');
                // Use PapaParse to parse the CSV data
                
                $('#harry_fo_select_6')
                .empty()
                .append('<option selected="selected" value="00">Select Year</option>');

           
				

                response2 = JSON.parse(response);
                response2.forEach(function(item) {
                    var option = document.createElement('option');
                    option.value = item.id;
                    option.text = item.name;
                    selectElement.appendChild(option);
                });
                

                
                                   
            }
        });
        
    })
});


