(function($){
    $.fn.toJSON = function(options){
        options = $.extend({}, options);
        var self = this,
            json = {},
            push_counters = {},
            patterns = {
                "validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
                "key":      /[a-zA-Z0-9_]+|(?=\[\])/g,
                "push":     /^$/,
                "fixed":    /^\d+$/,
                "named":    /^[a-zA-Z0-9_]+$/
            };
        this.build = function(base, key, value){
            base[key] = value;
            return base;
        };
        this.push_counter = function(key){
            if(push_counters[key] === undefined){
                push_counters[key] = 0;
            }
            return push_counters[key]++;
        };
        $.each($(this).serializeArray(), function(){
            // skip invalid keys
            if(!patterns.validate.test(this.name)){
                return;
            }
            var k,
                keys = this.name.match(patterns.key),
                merge = this.value,
                reverse_key = this.name;
            while((k = keys.pop()) !== undefined){
                // adjust reverse_key
                reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');
                // push
                if(k.match(patterns.push)){
                    merge = self.build([], self.push_counter(reverse_key), merge);
                }
                // fixed
                else if(k.match(patterns.fixed)){
                    merge = self.build([], k, merge);
                }
                // named
                else if(k.match(patterns.named)){
                    merge = self.build({}, k, merge);
                }
            }
            json = $.extend(true, json, merge);
        });
        return json;
    };
})(jQuery);


function showModal(uri, div) {
    get_call({
        'uri': uri,
        action : function(data) {
            $(div).replaceWith(data);
            $(div).modal('show');
        }
    });
}
function get_call(payload) {
    var form_data;

    if ( payload.form_data ) {

        form_data = JSON.stringify(payload.form_data.toJSON());
        form_data = payload.form_data.serialize();
    }

    $.ajax({
        url : payload.uri,
        type : 'GET',
        contentType: "application/json",
        data : form_data,
        success : function(result) {
            payload.action(result);
        },
        error : function(result) {
            text = jQuery.parseJSON(result.responseText);

            if ( payload.alerts ) {
                payload.alerts.append('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>' + text.error + '</div>');
            } else {
                $('.text-error').html(text.error);
                setTimeout(function() {
                    $('.text-error').html('');
                }, 3000);
            }
        }
    });
}

function post_call(payload) {
    var form_data;

    if ( payload.form_data ) {
        form_data = JSON.stringify(payload.form_data.toJSON());
        form_data = payload.form_data.serialize();
    }
    $.ajax({
        url : payload.uri,
        type : 'POST',
        data : form_data,
        success : function(result) {
            if ( payload.action ) {
                payload.action(result);
            } else {
                location.reload();
            }
        },
        error : function(result) {
            text = jQuery.parseJSON(result.responseText);

            if ( payload.alerts ) {
                payload.alerts.append('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>' + text.error + '</div>');
            } else {
                $('.text-error').html(text.error);
                setTimeout(function() {
                    $('.text-error').html('');
                }, 3000);
            }


        }
    });
}




$('table#workouts > tbody > tr').click(function() {
    var link;
    link = $(this).children("td").children("a").attr("href");
    window.location = link;
});

function getExercises(value, id, uri){
    var string = "";
    get_call({
        'uri': uri,
        form_data: $( value ),
        action : function(data) {
            $( string.concat('#exercise', id)).html($( $.parseHTML(data) ).filter("#exerciseSelectTD").html());
            $( string.concat('#value', id)).html($( $.parseHTML(data) ).filter("#exerciseValueTD").html());
        }
    });
}

function removeExercise(id) {
    $(id).empty();
        count = count - 1;
    if (0 == count) {
        $("#submitButtonTr").hide();
    }
}

var id = 0;
var count = 0;

function addExercise(uri) {
    id = id + 1;
    count = count + 1;
    get_call({
        'uri': uri.concat('/', id),
        action: function (data) {
            $("table#workoutTable").children("tbody").children("tr:first").after(data);
            if (1 == count) {
                $("#submitButtonTr").show();
            }
        }
    });
}

var $id = 0;
function addSelect() {
    var $prev = "#formgroup_" + $id;
    $id += 1;
    var $next = "#formgroup_" + $id;
    var $clone = $( "#formgroup_0" ).clone();
    $clone.attr("id", $next);
    $clone.find("select.form-control").attr("id", "internal_type_id[" + $id +"]");
    $clone.find("select.form-control").attr("name", "internal_type_id[" + $id +"]");
    $( $prev ).after($clone);

}

function getExerciseValues(value, id, uri){
    var string = "";
    get_call({
        'uri': uri,
        form_data: $( value ),
        action : function(data) {
            $( '#value' + id).html($( $.parseHTML(data) ).filter("#exerciseValueTD").html());
        }
    });
}

window.fbAsyncInit = function() {
    FB.init({
        appId      : '1683363808551374',
        xfbml      : true,
        version    : 'v2.3'
    });
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
