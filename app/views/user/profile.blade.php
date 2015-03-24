<div class="hero-unit">
    <center><h3 class="_title">{{$user->username}}</h3></center>

    <p> ACTIVE VIDEO</p>
    <div id='active-video'>
        @if(count($active_videos) == 0)
        No active video
        @else
        <table class="table table-bordered">
            <tr>
                <th style="width:15%;">ID</th>
                <th>Title</th>	  
            </tr>

            @for($i = 0; $i < count($active_videos) ; $i++)
            <tr>
                <td>{{$active_videos[$i]->id}}</td>
                <td>{{ HTML::linkAction('VideoController@showVideo', $active_videos[$i]->title , array($active_videos[$i]->id), array('class' => '')) }}</td>		  
            </tr>
            @endfor
        </table>
        @endif

    </div>
</div>