<h3 class="ct">線上訂票</h3>
<div class="order">
    <form action="">
        <table style="margin: auto;">
            <tr>
                <td>電影：</td>
                <td><select name="movie" id="movie" onchange="getDays()"></select></td>
            </tr>
            <tr>
                <td>日期：</td>
                <td><select name="date" id="date" onchange="getSessions()"></select></td>
            </tr>
            <tr>
                <td>場次：</td>
                <td><select name="session" id="session"></select></td>
            </tr>
        </table>
        <div class="ct">
            <input type="button" value="確定" onclick="booking()">
            <input type="reset" value="重置">
        </div>
    </form>
</div>
<div class="booking" style="display: none;">
asdasd
</div>
<script>
    getMovies(<?=isset($_GET['id'])?$_GET['id']:'';?>)
    function getMovies(id){
        let movie;
        if(id!=undefined){
            movie=id;
        }else{
            movie='all';
        }
        $.get("api/get_movies.php",{movie},function(movies){
            $("#movie").html(movies);
            getDays();
        })
    }
    function getDays(){
        let movie=$("#movie").val();

        $.get("api/get_days.php",{movie},(days)=>{
            $("#date").html(days);
            getSessions();
        })
    }

    function getSessions(){
        let movie=$("#movie").val();
        let date=$("#date").val();
        $.get("api/get_sessions.php",{movie,date},(sessions)=>{
            $("#session").html(sessions);
        })
    }

    function booking(){
        $(".order,.booking").toggle();
        let movie=$("#movie").val();
        let date=$("#date").val();
        let session=$("#session").val();
        $.get("api/get_bookings.php",{movie,date,session},function(booking){
        $(".booking").html(booking)
    })
    }
</script>