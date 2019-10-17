var global = function () {
    var hlp_dtrp = function(tipe,clas,prm){
        // 1 = datepicker, 2 = datettimepicker, 3 = timepicker, 4 = rangepicker

        if(tipe == '1'){
            $(clas).datepicker(prm);
        }else if(tipe == '2'){
            $(clas).datetimepicker(prm);
        }else if(tipe == '3'){
            $(clas).timepicker(prm);
        }else{
            $(clas).daterangepicker(prm,function(start, end, label) {
                $(clas + ' .form-control').val( start.format(prm.format) + ' - ' + end.format(prm.format));
            });
        }
    }

    var hlp_select2 = function(clas,url,clear,tag){
        var Dtag = (typeof tag == "undefined" || tag == false  ? false : true); 
        var Dclr = (typeof clear == "undefined" ? false : true); 

        $( clas ).select2({
            minimumInputLength : 2,
            allowClear         : Dclr,
		    ajax: {
		        url         : base_url + url,
		        dataType    : 'json',
		        quietMillis : 250,
		        data: function (term, page) {
		            return {
		                key : term,
		            };
		        },
		        results: function (data, page) {
		            return { results : data.item };
		        },
		        cache: true
		    },
		    initSelection: function(element, callback) {
		    	var id = $(element).val();
		        if (id !== "") {
		            $.ajax(base_url + url + "/" + id, {
		                dataType: "json"
		            }).done( function(data) { callback(data[0]); });
		        }
		    },
		    formatResult    : formatResult,
    		formatSelection : formatResult,
        });
    }

    function formatResult(state){
	    var data = state.name;
	 
	    return data;
	}

    return {
        init_dtrp : function (tipe,clas,prm) { hlp_dtrp(tipe,clas,prm) },
        init_select2 : function(clas,url,clear,tag) { hlp_select2(clas,url,clear,tag) }
    };
}();
