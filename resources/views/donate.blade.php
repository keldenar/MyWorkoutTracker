@extends('home')

@section('display')

    <div class="panel panel-default">
        <div class="panel-heading">Donate to the developer.</div>
        <div class="panel-body">
            <div class="text-center">
                <div style="padding-bottom: 50px; padding-top: 40px;"><strong>We greatly appreciate your support in keeping this site running.</strong></div>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="YVZ5A6CB2KF3W">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
            </div>
        </div>
    </div>

@endsection