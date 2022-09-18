
jQuery(document).ready(function($) {

    var main_box = $(".box1").eq(1);
    var list_box = main_box.find("span#res");
    var zero_list = main_box.find("#line.zero");

    var stop = $(".box1").eq(0);
    var stopTimer = stop.find('#clock');
    
    //stop_start_clock();

    stop.find(".btns input").click(function(){
        //console.log( $(this).attr('id') );
        switch( $(this).attr('id') ){
            case 'continue':
            case 'start': stop_start_clock(); break;
            case 'stop': stop_stop_clock(); break;
            case 'reset': stop_reset_clock(); break;
            case 'save': stop_save_clock(); break;
        }
    });

    var last_rec = 0;
    var rec_list = 0;
    function stop_save_clock(){
        if( !stopTS ) return;
        //my_list.push( stopTS );
        rec_list++;
        var distance = ( last_rec ) ? stop_time_calculator( stopTS - last_rec, "<i>+</i>") : '';
        last_rec = stopTS;
        var list_row = '<div id="line"><div><i>'+rec_list+'.</i> '
            + stop_time_calculator(stopTS) +'</div><div>'
            + distance +'</div></div>';
        list_box.prepend( list_row );
        if( zero_list.is(":visible") ) zero_list.fadeOut();
    }

    var zeros;
    function stop_time_calculator( ts, preTex = '' ){
        if( !ts ) return "<span id='zero'>0</span>";
        ih = Math.floor(( ts % 86400000 ) / 3600000 );
        im = Math.floor(( ts % 3600000 ) / 60000 );
        is = Math.floor(( ts % 60000) / 1000);
        it = Math.floor(( ts % 1000) / 10 );
        zeros = 0;
        return preTex
            +stop_calculator_leading_zeros(ih)
            +stop_calculator_leading_zeros(im)
            +stop_calculator_leading_zeros(is)
            +stop_calculator_leading_zeros(it,0);
    }

    function stop_calculator_leading_zeros( t, lead = ':' ) {
        t = ( t < 10 ? '0' : '' ) + t;
        var ret = ( lead ) ? t + lead : t;
        if( t == '00' && zeros == 0 ){
            zeros++;
            ret = "<span id='zero'>" + ret;
        }else if( t !== '00' && zeros == 1 ){
            zeros++;
            ret = "</span>" + ret;
        }
        return ret;
    }


    var clockInter = false;
    function stop_start_clock(){

        if( clockInter ) return;

        stop.find(".btns input#start,.btns input#continue").hide();
        stop.find(".btns input").not('.btns input#start,.btns input#continue').show();
        
        stopShowTimer();
        clockInter = setInterval( stopShowTimer, 10 );
    }

    function stop_stop_clock(){
        if( !clockInter ) return;

        stop.find(".btns input#continue").show();
        stop.find(".btns input#stop").hide();

        clearInterval( clockInter );
        clockInter = false;
    }

    function stop_reset_clock(){

        stop.find(".btns input").hide();
        stop.find(".btns input#start").show();
        
        if( clockInter ){
            clearInterval( clockInter );
            clockInter = false;
        }

        rec_list = last_rec = stopTS = h = m = s = t = 0;
        stop_set_timer_box();
        list_box.text('');
        zero_list.fadeIn();

    }


    var stopTS = h = m = s = t = 0;
    // var title = '';
    var hbx = stopTimer.find("#h");
    var mbx = stopTimer.find("#m");
    var sbx = stopTimer.find("#s");
    var tbx = stopTimer.find("#t");

    function stopShowTimer() {
        
        h = Math.floor((stopTS % 86400000 ) / 3600000 );
        m = Math.floor((stopTS % 3600000 ) / 60000 );
        s = Math.floor((stopTS % 60000) / 1000);
        t = Math.floor((stopTS % 1000) / 10 );

        stop_set_timer_box();
        stopTS += 10 ;
    }

    function stop_leading_zeros() { 
        h = (h < 10 ? '0' : '') + h;
        m = (m < 10 ? '0' : '') + m;
        s = (s < 10 ? '0' : '') + s;
        t = (t < 10 ? '0' : '') + t;
    }

    function stop_set_timer_box(){
        stop_leading_zeros();
        hbx.text( h );
        mbx.text( m );
        sbx.text( s );
        tbx.text( t );
        if( t == '00' )
            top.document.title = h +":"+ m +":"+ s;
    }

});


