<?
include_once "inc/head.php";

if( !$_POST ){ ?>

    <div class="box1">
        <div id="title">
        <?=$lang[0]?>
        </div>
        <div id="line">
            <div id="clock" data-ts='0'>
                <span id='h'>00</span> : 
                <span id='m'>00</span> : 
                <span id='s'>00</span> : 
                <span id='t'>00</span>
            </div>
        </div>
        <div id="line" class="btns">
            <input type="button" id="save" value="<?=$lang[1]?>">
            <input type="button" id="start" value="<?=$lang[2]?>">
            <input type="button" id="continue" value="<?=$lang[3]?>">
            <input type="button" id="stop" value="<?=$lang[4]?>">
            <input type="button" id="reset" class="hide" value="<?=$lang[5]?>">
        </div>
    </div>

    <div class="box1 striped stopwatch">
        <div id="title">
            <?=$lang[6]?>
        </div>
        <div id="line">
            <div>
                <?=$lang[7]?>
            </div>
            <div>
                <?=$lang[8]?>
            </div>
        </div>
        <span id="res"></span>
        <div id="line" class="zero">
            <div id="desc">
                <?=$lang[9]?>
            </div>
        </div>
    </div>


<? } //Only first time -> not for ajax

