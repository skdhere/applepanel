$(function(){
    var _to_ascii = {
        '188': '44',
        '109': '45',
        '190': '46',
        '191': '47',
        '192': '96',
        '220': '92',
        '222': '39',
        '221': '93',
        '219': '91',
        '173': '45',
        '187': '61', //IE Key codes
        '186': '59', //IE Key codes
        '189': '45'  //IE Key codes
    }

    var shiftUps = {
        "96": "~",
        "49": "!",
        "50": "@",
        "51": "#",
        "52": "$",
        "53": "%",
        "54": "^",
        "55": "&",
        "56": "*",
        "57": "(",
        "48": ")",
        "45": "_",
        "61": "+",
        "91": "{",
        "93": "}",
        "92": "|",
        "59": ":",
        "39": "\"",
        "44": "<",
        "46": ">",
        "47": "?"
    };
    $(document).on('keydown', '.v_number', function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        

        if($(this).val() && $(this).attr('data-rule-maxlength')){
            if($(this).val().length >= $(this).attr('data-rule-maxlength'))
            {
                e.preventDefault();
                return false;
            }
        }

        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
            return false;
        }
    });


    $(document).on('keydown', '.v_name', function (e) {
        
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }

        var regex = "^[a-zA-Z\\s._@&-]*$";
        var c = e.which;

        if (_to_ascii.hasOwnProperty(c)) {
            c = _to_ascii[c];
        }
        
        if (!e.shiftKey && (c >= 65 && c <= 90)) {
            c = String.fromCharCode(c + 32);
        } else if (e.shiftKey && shiftUps.hasOwnProperty(c)) {
            c = shiftUps[c];
        } else {
            c = String.fromCharCode(c);
        }

        console.log(e.keyCode);
        if (c.match(regex)) {
            
            if($(this).val() && $(this).attr('data-rule-maxlength')){
                if($(this).val().length >= $(this).attr('data-rule-maxlength'))
                {
                    e.preventDefault();
                    return false;
                }
            }
            return true;
        }

        e.preventDefault();
        return false;
    });


    $(document).on('keydown', '.v_text', function (e) {
        
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }

        var regex = "^[&-._@a-zA-Z0-9\\s]*$";
        var c = e.which;

        if (_to_ascii.hasOwnProperty(c)) {
            c = _to_ascii[c];
        }
        
        if (!e.shiftKey && (c >= 65 && c <= 90)) {
            c = String.fromCharCode(c + 32);
        } else if (e.shiftKey && shiftUps.hasOwnProperty(c)) {
            c = shiftUps[c];
        } else {
            c = String.fromCharCode(c);
        }

        console.log(e.keyCode);
        if (c.match(regex)) {
            
            if($(this).val() && $(this).attr('data-rule-maxlength')){
                if($(this).val().length >= $(this).attr('data-rule-maxlength'))
                {
                    e.preventDefault();
                    return false;
                }
            }
            return true;
        }

        e.preventDefault();
        return false;
    });

    $(document).on('focus', "input[data-rule-maxlength], input[maxlength]", function (e) {

        if($(this).siblings('h6').length === 0){
            if($(this).attr('maxlength')){
                $(this).attr('data-rule-maxlength', $(this).attr('maxlength'));
            }
            $(this).before('<h6 style="color: #b7b7b7; margin: 0px; display:none; position:relative;"></h6>');
            var len = $(this).val().length;
            var maxlen = $(this).attr('data-rule-maxlength');
            $(this).siblings('h6').html((maxlen-len) +' <small>remaining characters</small>');
            
        }
        $(this).siblings('h6').show('swing');
    });


    $(document).on('blur', "input[data-rule-maxlength], input[maxlength]", function (e) {
        
        // $(this).siblings('h6').hide('swing');
    });


    $(document).on('keyup', "input[data-rule-maxlength]", function (e) {
        var len = $(this).val().length;
        var maxlen = $(this).attr('data-rule-maxlength');
        // $(this).siblings('h6').html(len+' / '+maxlen);
        $(this).siblings('h6').html((maxlen-len) +' <small>remaining characters</small>');
    });



        // $('select').select2();

});